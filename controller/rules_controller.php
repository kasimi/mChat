<?php
/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2015 dmzx - http://www.dmzx-web.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\controller;

class rules_controller
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/**
	* Constructor
	*
	* @param \phpbb\config\config			$config
	* @param \phpbb\template\template		$template
	* @param \phpbb\user					$user
	* @param \phpbb\controller\helper		$helper
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user, \phpbb\controller\helper $helper)
	{
		$this->config		= $config;
		$this->template		= $template;
		$this->user			= $user;
		$this->helper		= $helper;
	}

	/**
	* Controller for mChat Rules page
	*
	* @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	*/
	public function handle()
	{
		if (empty($this->config['mchat_rules']) && empty($this->user->lang['MCHAT_RULES']))
		{
			throw new \phpbb\exception\http_exception(404, 'MCHAT_NO_RULES');
		}

		// If the rules are defined in the language file use them, else just use the entry in the database
		$mchat_rules = isset($this->user->lang['MCHAT_RULES']) ? $this->user->lang('MCHAT_RULES') : $this->config['mchat_rules'];
		$mchat_rules = explode("\n", $mchat_rules);
		$mchat_rules = array_map('utf8_htmlspecialchars', $mchat_rules);
		$mchat_rules = implode('<br />', $mchat_rules);

		$this->template->assign_var('MCHAT_RULES', $mchat_rules);

		return $this->helper->render('mchat_rules.html', $this->user->lang('MCHAT_HELP'));
	}
}
