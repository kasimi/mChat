<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{
	/** @var \dmzx\mchat\core\mchat */
	protected $mchat;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var string */
	protected $php_ext;

	/** @var int The ID of the mChat message that is quoted when composing a PM */
	private $mchat_pm_quote_message = 0;

	/**
	 * Constructor
	 *
	 * @param \dmzx\mchat\core\mchat	$mchat
	 * @param \phpbb\controller\helper	$helper
	 * @param \phpbb\user				$user
	 * @param \phpbb\request\request	$request
	 * @param string					$php_ext
	 */
	public function __construct(\dmzx\mchat\core\mchat $mchat, \phpbb\controller\helper $helper, \phpbb\user $user, \phpbb\request\request $request, $php_ext)
	{
		$this->mchat	= $mchat;
		$this->helper	= $helper;
		$this->user		= $user;
		$this->request	= $request;
		$this->php_ext	= $php_ext;
	}

	/**
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return array(
			'core.viewonline_overwrite_location'		=> 'add_page_viewonline',
			'core.user_setup'							=> 'load_language_on_setup',
			'core.page_header'							=> 'add_page_header_link',
			'core.index_modify_page_title'				=> 'display_mchat_on_index',
			'core.submit_post_end'						=> 'submit_post_end',
			'core.display_custom_bbcodes_modify_sql'	=> 'display_custom_bbcodes_modify_sql',
			'core.user_add_modify_data'					=> 'user_registration_set_default_values',
			'core.login_box_redirect'					=> 'user_login_success',
			'core.ucp_pm_compose_modify_data'			=> 'pm_compose_before',
			'core.display_custom_bbcodes_modify_sql'	=> 'pm_compose_add_quote',
		);
	}

	/**
	 * @param object $event The event object
	 */
	public function add_page_viewonline($event)
	{
		if (strrpos($event['row']['session_page'], 'app.' . $this->php_ext . '/mchat') === 0)
		{
			$event['location'] = $this->user->lang('MCHAT_TITLE');
			$event['location_url'] = $this->helper->route('dmzx_mchat_page_custom_controller');
		}
	}

	/**
	 * @param object $event The event object
	 */
	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'dmzx/mchat',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	 * Create a URL to the mchat controller file for the header linklist
	 *
	 * @param object $event The event object
	 */
	public function add_page_header_link($event)
	{
		$this->mchat->render_page_header_link();
	}

	/**
	 * Check if mchat should be displayed on index.
	 *
	 * @param object $event The event object
	 */
	public function display_mchat_on_index($event)
	{
		$this->mchat->page_index();
	}

	/**
	 * @param object $event The event object
	 */
	public function submit_post_end($event)
	{
		$this->mchat->insert_posting($event['mode'], array(
			'forum_id'		=> $event['data']['forum_id'],
			'forum_name'	=> $event['data']['forum_name'],
			'post_id'		=> $event['data']['post_id'],
			'post_subject'	=> $event['subject'],
		));
	}

	/**
	 * @param object $event The event object
	 */
	public function display_custom_bbcodes_modify_sql($event)
	{
		$event['sql_ary'] = $this->mchat->remove_disallowed_bbcodes($event['sql_ary']);
	}

	/**
	 * @param object $event The event object
	 */
	public function user_registration_set_default_values($event)
	{
		$event['sql_ary'] = $this->mchat->set_user_default_values($event['sql_ary']);
	}

	/**
	 * @param object $event The event object
	 */
	public function user_login_success($event)
	{
		if (!$event['admin'])
		{
			$this->mchat->insert_posting('login');
		}
	}

	/**
	 * @param object $event The event object
	 */
	public function pm_compose_before($event)
	{
		$this->mchat_pm_quote_message = $this->request->variable('mchat_pm_quote_message', 0);
	}

	/**
	 * @param object $event The event object
	 */
	public function pm_compose_add_quote($event)
	{
		$this->mchat->quote_message_text($this->mchat_pm_quote_message);
	}
}
