<?php
/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2015 dmzx - http://www.dmzx-web.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\controller;

class whois_controller
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	* Constructor
	*
	* @param \phpbb\auth\auth				$auth
	* @param \phpbb\template\template		$template
	* @param \phpbb\user					$user
	* @param \phpbb\controller\helper		$helper
	* @param string							$phpbb_root_path
	* @param string							$php_ext
	*/
	public function __construct(\phpbb\auth\auth $auth, \phpbb\template\template $template, \phpbb\user $user, \phpbb\controller\helper $helper, $phpbb_root_path, $php_ext)
	{
		$this->auth				= $auth;
		$this->template			= $template;
		$this->user				= $user;
		$this->helper			= $helper;
		$this->phpbb_root_path	= $phpbb_root_path;
		$this->php_ext			= $php_ext;
	}

	/**
	* Controller for mChat IP WHOIS
	*
	* @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	*/
	public function handle($ip)
	{
		if (!$this->auth->acl_get('u_mchat_ip'))
		{
			throw new \phpbb\exception\http_exception(403, 'NO_AUTH_OPERATION');
		}

		if (!function_exists('user_ipwhois'))
		{
			include($this->phpbb_root_path . 'includes/functions_user.' . $this->php_ext);
		}

		$this->template->assign_var('WHOIS', user_ipwhois($ip));

		return $this->helper->render('viewonline_whois.html', $this->user->lang('WHO_IS_ONLINE'));
	}
}
