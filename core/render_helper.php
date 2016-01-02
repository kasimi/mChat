<?php
/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2015 dmzx - http://www.dmzx-web.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\core;

class render_helper
{
	/** @var \dmzx\mchat\core\functions_mchat */
	protected $functions_mchat;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\log\log_interface */
	protected $log;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\pagination */
	protected $pagination;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\event\dispatcher_interface */
	protected $dispatcher;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $phpEx;

	/** @var string */
	protected $mchat_table;

	/** @var boolean */
	public $is_mchat_rendered = false;

	/**
	* Constructor
	*
	* @param \dmzx\mchat\core\functions_mchat	$functions_mchat
	* @param \phpbb\config\config				$config
	* @param \phpbb\controller\helper			$helper
	* @param \phpbb\template\template			$template
	* @param \phpbb\log\log_interface			$log
	* @param \phpbb\user						$user
	* @param \phpbb\auth\auth					$auth
	* @param \phpbb\db\driver\driver_interface	$db
	* @param \phpbb\pagination					$pagination
	* @param \phpbb\request\request				$request
	* @param \phpbb\event\dispatcher_interface	$dispatcher
	* @param string								$phpbb_root_path
	* @param string								$phpEx
	* @param string								$mchat_table
	*/
	public function __construct(\dmzx\mchat\core\functions_mchat $functions_mchat, \phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\log\log_interface $log, \phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\db\driver\driver_interface $db, \phpbb\pagination $pagination, \phpbb\request\request $request, \phpbb\event\dispatcher_interface $dispatcher, $phpbb_root_path, $phpEx, $mchat_table)
	{
		$this->functions_mchat	= $functions_mchat;
		$this->config			= $config;
		$this->helper			= $helper;
		$this->template			= $template;
		$this->log				= $log;
		$this->user				= $user;
		$this->auth				= $auth;
		$this->db				= $db;
		$this->pagination		= $pagination;
		$this->request			= $request;
		$this->dispatcher		= $dispatcher;
		$this->phpbb_root_path	= $phpbb_root_path;
		$this->phpEx			= $phpEx;
		$this->mchat_table		= $mchat_table;
	}

	/**
	* Method to render the page data
	*
	* @var bool					Bool if the rendering is only for index
	* @return null|array|string	If we are rendering for the index, null is returned. For modes that are only
	*							called via AJAX, an array is returned, otherwise the rendered content is returned.
	*/
	public function render_data_for_page($page)
	{
		// If mChat is used on the index by a user without an avatar, a default avatar is used.
		// However, T_THEME_PATH points to ./../styles/... because the controller at /mchat is called, but we need it to be ./styles...
		// Setting this value to true solves this.
		if (!defined('PHPBB_USE_BOARD_URL_PATH'))
		{
			define('PHPBB_USE_BOARD_URL_PATH', true);
		}

		$this->assign_whois();

		$mchat_view = $this->auth->acl_get('u_mchat_view');
		if ($page == 'index' && (!$this->config['mchat_on_index'] || !$mchat_view))
		{
			return;
		}

		if (!$mchat_view)
		{
			// Forbidden
			throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
		}

		// Add lang file
		$this->user->add_lang('posting');

		// Access rights
		$mchat_allow_bbcode		= $this->config['allow_bbcode'] && $this->auth->acl_get('u_mchat_bbcode');
		$mchat_smilies			= $this->config['allow_smilies'] && $this->auth->acl_get('u_mchat_smilies');
		$mchat_use				= $this->auth->acl_get('u_mchat_use');
		$mchat_read_archive		= $this->auth->acl_get('u_mchat_archive');
		$mchat_founder			= $this->user->data['user_type'] == USER_FOUNDER;


		$mchat_mode	= $this->request->variable('mode', '');
		$in_archive = $page == 'archive';

		$foes_array = $this->functions_mchat->mchat_foes();

		// If the static message is defined in the language file use it, else the entry in the database is used
		if (isset($this->user->lang['STATIC_MESSAGE']))
		{
			$this->config['mchat_static_message'] = $this->user->lang('STATIC_MESSAGE');
		}

		$this->template->assign_vars(array(
			'MCHAT_FILE_NAME'				=> $this->helper->route('dmzx_mchat_controller'),
			'MCHAT_REFRESH_JS'				=> 1000 * $this->config['mchat_refresh'],
			'MCHAT_ARCHIVE_MODE'			=> $in_archive,
			'MCHAT_INPUT_TYPE'				=> $this->user->data['user_mchat_input_area'],
			'MCHAT_RULES'					=> !empty($this->user->lang['MCHAT_RULES']) || !empty($this->config['mchat_rules']),
			'MCHAT_ALLOW_USE'				=> $mchat_use,
			'MCHAT_ALLOW_SMILES'			=> $mchat_smilies,
			'MCHAT_ALLOW_IP'				=> $this->auth->acl_get('u_mchat_ip'),
			'MCHAT_ALLOW_PM'				=> $this->auth->acl_get('u_mchat_pm'),
			'MCHAT_ALLOW_LIKE'				=> $mchat_use && $this->auth->acl_get('u_mchat_like'),
			'MCHAT_ALLOW_QUOTE'				=> $mchat_use && $this->auth->acl_get('u_mchat_quote'),
			'MCHAT_ALLOW_BBCODES'			=> $mchat_allow_bbcode,
			'MCHAT_MESSAGE_TOP'				=> $this->config['mchat_message_top'],
			'MCHAT_ARCHIVE_URL'				=> $this->helper->route('dmzx_mchat_archive_controller'),
			'MCHAT_CUSTOM_PAGE'				=> $page == 'custom',
			'MCHAT_INDEX_HEIGHT'			=> $this->config['mchat_index_height'],
			'MCHAT_CUSTOM_HEIGHT'			=> $this->config['mchat_custom_height'],
			'MCHAT_READ_ARCHIVE_BUTTON'		=> $mchat_read_archive,
			'MCHAT_FOUNDER'					=> $mchat_founder,
			'MCHAT_STATIC_MESS'				=> !empty($this->config['mchat_static_message']) ? htmlspecialchars_decode($this->config['mchat_static_message']) : '',
			'L_MCHAT_COPYRIGHT'				=> base64_decode('PGEgaHJlZj0iaHR0cDovL3JtY2dpcnI4My5vcmciPlJNY0dpcnI4MzwvYT4gJmNvcHk7IDxhIGhyZWY9Imh0dHA6Ly93d3cuZG16eC13ZWIubmV0IiB0aXRsZT0id3d3LmRtengtd2ViLm5ldCI+ZG16eDwvYT4='),
			'MCHAT_MESSAGE_LNGTH'			=> $this->config['mchat_max_message_lngth'],
			//'MCHAT_MESSAGE_LNGTH_EXPLAIN'	=> $this->config['mchat_max_message_lngth']) ? sprintf($this->user->lang('MCHAT_MESSAGE_LNGTH_EXPLAIN'), $this->config['mchat_max_message_lngth']) : '', TODO not used
			'MCHAT_MESS_LONG'				=> sprintf($this->user->lang('MCHAT_MESS_LONG'), $this->config['mchat_max_message_lngth']),
			'MCHAT_USER_TIMEOUT'			=> 1000 * $this->config['mchat_timeout'],
			'MCHAT_USER_TIMEOUT_TIME'		=> gmdate('H:i:s', $this->config['mchat_timeout']),
			'MCHAT_WHOIS_REFRESH'			=> $this->config['mchat_whois'] ? 1000 * $this->config['mchat_whois_refresh'] : 0,
			'MCHAT_PAUSE_ON_INPUT'			=> $this->config['mchat_pause_on_input'],
			'MCHAT_REFRESH_YES'				=> sprintf($this->user->lang('MCHAT_REFRESH_YES'), $this->config['mchat_refresh']),
			'MCHAT_WHOIS_REFRESH_EXPLAIN'	=> sprintf($this->user->lang('WHO_IS_REFRESH_EXPLAIN'), $this->config['mchat_whois_refresh']),
			'S_MCHAT_AVATARS'				=> !empty($this->config['mchat_avatars']) && $this->user->optionget('viewavatars') && $this->user->data['user_mchat_avatars'],
			'S_MCHAT_LOCATION'				=> $this->config['mchat_location'],
			'S_MCHAT_SOUND_YES'				=> $this->user->data['user_mchat_sound'],
			'U_MORE_SMILIES'				=> append_sid("{$this->phpbb_root_path}posting.{$this->phpEx}", 'mode=smilies'),
			'U_MCHAT_RULES'					=> $this->helper->route('dmzx_mchat_rules_controller'),
			'S_MCHAT_ON_INDEX'				=> $this->config['mchat_on_index'] && !empty($this->user->data['user_mchat_index']),
			'EXT_URL'						=> generate_board_url() . '/ext/dmzx/mchat/',
			'STYLE_PATH'					=> generate_board_url() . '/styles/' . $this->user->style['style_path'],
		));

		if ($page != 'index')
		{
			$this->template->assign_block_vars('navlinks', array(
				'FORUM_NAME'	=> $this->user->lang('MCHAT_TITLE'),
				'U_VIEW_FORUM'	=> $this->helper->route('dmzx_mchat_controller'),
			));
		}

		// Request mode
		switch ($mchat_mode)
		{
			case 'clean':
				if (!$mchat_founder || !check_form_key('mchat', -1))
				{
					throw new \phpbb\exception\http_exception(403, 'NO_AUTH_OPERATION');
				}

				$this->functions_mchat->mchat_truncate_messages();

				return array('clean' => true);

			case 'refresh':
				// Request new messages
				$mchat_message_last_id = $this->request->variable('message_last_id', 0);
				$sql_where = 'm.message_id > ' . (int) $mchat_message_last_id . ($this->user->data['user_mchat_topics'] ? '' : ' AND m.forum_id = 0');
				$limit = (int) $this->config['mchat_message_limit'];
				$rows = $this->functions_mchat->mchat_messages($sql_where, $limit);
				$this->assign_messages($rows, $foes_array, $in_archive);

				return array(
					'refresh' => $this->render('mchat_messages.html'),
				);

			case 'whois':
				if (!$this->config['mchat_whois'])
				{
					throw new \phpbb\exception\http_exception(403, 'NO_AUTH_OPERATION');
				}

				$this->assign_whois();

				return array('whois' => $this->render('mchat_whois.html'));

			case 'add':
				if (!$mchat_use || !check_form_key('mchat', -1))
				{
					// Forbidden (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
				}

				// Flood control
				if ($this->functions_mchat->is_flooding())
				{
					throw new \phpbb\exception\http_exception(400, 'MCHAT_BAD_REQUEST');
				}

				$message = utf8_ucfirst($this->request->variable('message', '', true));

				// Must have something other than bbcode in the message
				$message_chars = trim(preg_replace('#\[/?[^\[\]]+\]#mi', '', $message));
				if (!$message || !utf8_strlen($message_chars))
				{
					// Not Implemented
					throw new \phpbb\exception\http_exception(501, 'MCHAT_ERROR_NOT_IMPLEMENTED');
				}

				// Insert user into the mChat sessions table
				$this->functions_mchat->mchat_sessions();

				/**
				* Event render_helper_add
				*
				* @event dmzx.mchat.core.render_helper_add
				* @since 0.1.2
				*/
				$this->dispatcher->trigger_event('dmzx.mchat.core.render_helper_add');

				$sql_ary = array_merge($this->sql_ary_message($message), array(
					'forum_id'			=> 0,
					'post_id'			=> 0,
					'user_id'			=> $this->user->data['user_id'],
					'user_ip'			=> $this->user->data['session_ip'],
					'message_time'		=> time(),
				));

				$sql = 'INSERT INTO ' . $this->mchat_table . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
				$this->db->sql_query($sql);

				return array('add' => true);

			case 'edit':
				$message_id = $this->request->variable('message_id', 0);

				if (!$message_id || !check_form_key('mchat', -1))
				{
					// Forbidden
					throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
				}

				// Check for the correct user
				$sql = 'SELECT u.user_id, u.username
					FROM ' . $this->mchat_table . ' m
					LEFT JOIN ' . USERS_TABLE . ' u ON m.user_id = u.user_id
					WHERE m.message_id = ' . (int) $message_id;
				$result = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				if (!$this->auth_message('u_mchat_edit', $row['user_id']))
				{
					// Forbidden
					throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
				}

				$message = $this->request->variable('message', '', true);

				// Must have something other than bbcode in the message
				$message_chars = trim(preg_replace('#\[/?[^\[\]]+\]#mi', '', $message));
				if (!$message || !utf8_strlen($message_chars))
				{
					// Not Implemented (for jQ AJAX request)
					throw new \phpbb\exception\http_exception(501, 'MCHAT_ERROR_NOT_IMPLEMENTED');
				}

				// Message limit
				$message = $this->config['mchat_max_message_lngth'] && utf8_strlen($message) >= $this->config['mchat_max_message_lngth'] + 3 ? utf8_substr($message, 0, $this->config['mchat_max_message_lngth']) . '...' : $message;

				$sql_ary = $this->sql_ary_message($message);

				$sql = 'UPDATE ' . $this->mchat_table . ' SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . '
					WHERE message_id = ' . (int) $message_id;
				$this->db->sql_query($sql);

				// Message edited...now read it
				$sql_where = 'm.message_id = ' . (int) $message_id;
				$rows = $this->functions_mchat->mchat_messages($sql_where, 1);
				$this->assign_messages($rows, $foes_array, $in_archive);

				// Add a log
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_EDITED_MCHAT', false, array($row['username']));

				$this->functions_mchat->mchat_sessions();

				/**
				* Event render_helper_edit
				*
				* @event dmzx.mchat.core.render_helper_edit
				* @since 0.1.4
				*/
				$this->dispatcher->trigger_event('dmzx.mchat.core.render_helper_edit');

				return array('edit' => $this->render('mchat_messages.html'));

			case 'del':
				$message_id = $this->request->variable('message_id', 0);

				if (!$message_id || !check_form_key('mchat', -1))
				{
					// Forbidden
					throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
				}

				// Check for the correct user
				$sql = 'SELECT u.user_id, u.username
					FROM ' . $this->mchat_table . ' m
					LEFT JOIN ' . USERS_TABLE . ' u ON m.user_id = u.user_id
					WHERE m.message_id = ' . (int) $message_id;
				$result = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				if (!$this->auth_message('u_mchat_delete', $row['user_id']))
				{
					// Forbidden
					throw new \phpbb\exception\http_exception(403, 'MCHAT_NOACCESS');
				}

				/**
				* Event render_helper_delete
				*
				* @event dmzx.mchat.core.render_helper_delete
				* @since 0.1.4
				*/
				$this->dispatcher->trigger_event('dmzx.mchat.core.render_helper_delete');

				// Run delete
				$sql = 'DELETE FROM ' . $this->mchat_table . '
					WHERE message_id = ' . (int) $message_id;
				$this->db->sql_query($sql);

				// Add a log
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_DELETED_MCHAT', false, array($row['username']));

				$this->functions_mchat->mchat_sessions();

				return array('del' => true);
		}

		// If not include in index.php set mchat.php page true
		if ($page != 'index')
		{
			if ($page == 'custom')
			{
				// If custom page false mchat.php page redirect to index...
				if (!$this->config['mchat_custom_page'])
				{
					$mchat_redirect = append_sid("{$this->phpbb_root_path}index.{$this->phpEx}");
					meta_refresh(3, $mchat_redirect);
					trigger_error($this->user->lang('MCHAT_NO_CUSTOM_PAGE'). '<br /><br />' . sprintf($this->user->lang('RETURN_PAGE'), '<a href="' . $mchat_redirect . '">', '</a>'));
				}

				$this->functions_mchat->mchat_sessions();
			}

			if ($this->config['mchat_whois'])
			{
				$legend = $this->functions_mchat->mchat_legend();
				$this->template->assign_var('LEGEND', implode(', ', $legend));
			}
		}

		$sql_where = $this->user->data['user_mchat_topics'] ? '' : 'm.forum_id = 0';
		$limit = $in_archive ? $this->config['mchat_archive_limit'] : $this->config[$page == 'index' ? 'mchat_message_num' : 'mchat_message_limit'];
		$start = $in_archive ? $this->request->variable('start', 0) : 0;
		$rows = $this->functions_mchat->mchat_messages($sql_where, $limit, $start);

		$this->assign_messages($rows, $foes_array, $in_archive);

		if ($in_archive)
		{
			if (!$mchat_read_archive)
			{
				// Redirect to correct page
				$mchat_redirect = append_sid("{$this->phpbb_root_path}index.{$this->phpEx}");

				// Redirect to previous page
				meta_refresh(3, $mchat_redirect);
				trigger_error($this->user->lang('MCHAT_NOACCESS_ARCHIVE'). '<br /><br />' . sprintf($this->user->lang('RETURN_PAGE'), '<a href="' . $mchat_redirect . '">', '</a>'));
			}

			// Prune the chats
			if ($this->config['mchat_prune'] && $this->config['mchat_prune_num'] > 0)
			{
				$this->functions_mchat->mchat_prune($this->config['mchat_prune_num']);
			}

			// Run query again to get the total number of message for pagination
			$total_messages = $this->functions_mchat->get_total_message_count();

			$pagination_url = $this->helper->route('dmzx_mchat_archive_controller');
			$this->pagination->generate_template_pagination($pagination_url, 'pagination', 'start', $total_messages, $limit, $start);

			$this->template->assign_var('MCHAT_TOTAL_MESSAGES', sprintf($this->user->lang('MCHAT_TOTALMESSAGES'), $total_messages));

			// Add to navlinks
			$this->template->assign_block_vars('navlinks', array(
				'FORUM_NAME'	=> $this->user->lang('MCHAT_ARCHIVE'),
				'U_VIEW_FORUM'	=> $pagination_url,
			));
		}
		else
		{
			// Display custom bbcodes
			if ($mchat_allow_bbcode)
			{
				if (!function_exists('display_custom_bbcodes'))
				{
					include($this->phpbb_root_path . 'includes/functions_display.' . $this->phpEx);
				}
				$this->functions_mchat->display_mchat_bbcodes();
			}

			// Smile row
			if ($mchat_smilies)
			{
				if (!function_exists('generate_smilies'))
				{
					include($this->phpbb_root_path . 'includes/functions_posting.' . $this->phpEx);
				}
				generate_smilies('inline', 0);
			}

			add_form_key('mchat');
		}

		/**
		* Event render_helper_aft
		*
		* @event dmzx.mchat.core.render_helper_aft
		* @since 0.1.2
		*/
		$this->dispatcher->trigger_event('dmzx.mchat.core.render_helper_aft');

		// If we're on the index, we must not render anything
		// here, only for the custom page and the archive
		if ($page != 'index')
		{
			return $this->helper->render('mchat_body.html', $this->user->lang($in_archive ? 'MCHAT_ARCHIVE_PAGE' : 'MCHAT_TITLE'));
		}
	}

	/**
	* Renders the statistics for whois and at the bottom of the index page
	*/
	public function assign_whois()
	{
		if ($this->auth->acl_get('u_mchat_view') && !$this->is_mchat_rendered)
		{
			$this->is_mchat_rendered = true;
			$mchat_stats = $this->functions_mchat->mchat_users();
			$this->template->assign_vars(array(
				'MCHAT_INDEX_STATS'		=> $this->config['mchat_stats_index'] && $this->user->data['user_mchat_stats_index'],
				'MCHAT_USERS_COUNT'		=> $mchat_stats['mchat_users_count'],
				'MCHAT_USERS_LIST'		=> !empty($mchat_stats['online_userlist']) ? $mchat_stats['online_userlist'] : '',
				'MCHAT_ONLINE_EXPLAIN'	=> $mchat_stats['refresh_message'],
			));
		}
	}

	/**
	* Assigns all messages to the template
	*/
	public function assign_messages($rows, $foes, $in_archive)
	{
		// Reverse the array if messages appear at the bottom
		if (!$this->config['mchat_message_top'] && !$in_archive)
		{
			$rows = array_reverse($rows);
		}

		foreach ($rows as $i => $row)
		{
			// Auth checks
			if ($row['forum_id'] != 0 && !$this->auth->acl_get('f_read', $row['forum_id']))
			{
				continue;
			}

			$message_edit = $row['message'];
			decode_message($message_edit, $row['bbcode_uid']);
			$message_edit = str_replace('"', '&quot;', $message_edit);
			$message_edit = mb_ereg_replace("'", '&#146;', $message_edit);

			if (in_array($row['user_id'], $foes))
			{
				$row['message'] = sprintf($this->user->lang('MCHAT_FOE'), get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')));
			}

			$row['username'] = mb_ereg_replace("'", "&#146;", $row['username']);
			$message = str_replace("'", '&rsquo;', $row['message']);

			$this->template->assign_block_vars('mchatrow', array(
				'S_ROW_COUNT'			=> $i,
				'MCHAT_ALLOW_BAN'		=> $this->auth->acl_get('a_authusers'),
				'MCHAT_ALLOW_EDIT'		=> $this->auth_message('u_mchat_edit', $row['user_id']),
				'MCHAT_ALLOW_DEL'		=> $this->auth_message('u_mchat_delete', $row['user_id']),
				'MCHAT_USER_AVATAR'		=> $row['user_avatar'] ? $this->functions_mchat->mchat_avatar($row) : '',
				'U_VIEWPROFILE'			=> $row['user_id'] != ANONYMOUS ? append_sid("{$this->phpbb_root_path}memberlist.{$this->phpEx}", 'mode=viewprofile&amp;u=' . $row['user_id']) : '',
				'MCHAT_IS_POSTER'		=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] == $row['user_id'],
				'MCHAT_PM'				=> $row['user_id'] != ANONYMOUS && $this->user->data['user_id'] != $row['user_id'] && $this->config['allow_privmsg'] && $this->auth->acl_get('u_sendpm') && ($row['user_allow_pm'] || $this->auth->acl_gets('a_', 'm_') || $this->auth->acl_getf_global('m_')) ? append_sid("{$this->phpbb_root_path}ucp.{$this->phpEx}", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '',
				'MCHAT_MESSAGE_EDIT'	=> $message_edit,
				'MCHAT_MESSAGE_ID'		=> $row['message_id'],
				'MCHAT_USERNAME_FULL'	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_USERNAME'		=> get_username_string('username', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_USERNAME_COLOR'	=> get_username_string('colour', $row['user_id'], $row['username'], $row['user_colour'], $this->user->lang('GUEST')),
				'MCHAT_USER_IP'			=> $row['user_ip'],
				'MCHAT_U_IP'			=> $this->helper->route('dmzx_mchat_whois_controller', array('ip' => $row['user_ip'])),
				'MCHAT_U_BAN'			=> append_sid("{$this->phpbb_root_path}adm/index.{$this->phpEx}" ,'i=permissions&amp;mode=setting_user_global&amp;user_id[0]=' . $row['user_id'], true, $this->user->session_id),
				'MCHAT_MESSAGE'			=> censor_text(generate_text_for_display($row['message'], $row['bbcode_uid'], $row['bbcode_bitfield'], $row['bbcode_options'])),
				'MCHAT_TIME'			=> $this->user->format_date($row['message_time'], $this->config['mchat_date']),
			));
		}
	}

	/*
	* Checks whether an author has edit or delete permissions for a message
	*/
	protected function auth_message($permission, $author_id)
	{
		return $this->auth->acl_get($permission) && ($this->user->data['user_id'] == $author_id && $this->user->data['is_registered'] || $this->auth->acl_get('m_'));
	}

	/**
	* Generates an array containing the message and BBCode options ready to be sent to the database
	*/
	protected function sql_ary_message($message)
	{
		// We override the $this->config['min_post_chars'] entry?
		if ($this->config['mchat_override_min_post_chars'])
		{
			$old_cfg['min_post_chars'] = $this->config['min_post_chars'];
			$this->config['min_post_chars'] = 0;
		}

		// We do the same for the max number of smilies?
		if ($this->config['mchat_override_smilie_limit'])
		{
			$old_cfg['max_post_smilies'] = $this->config['max_post_smilies'];
			$this->config['max_post_smilies'] = 0;
		}

		$mchat_allow_bbcode	= $this->config['allow_bbcode'] && $this->auth->acl_get('u_mchat_bbcode');
		$mchat_urls			= $this->config['allow_post_links'] && $this->auth->acl_get('u_mchat_urls');
		$mchat_smilies		= $this->config['allow_smilies'] && $this->auth->acl_get('u_mchat_smilies');

		// Add function part code from http://wiki.phpbb.com/Parsing_text
		$uid = $bitfield = $options = '';
		generate_text_for_storage($message, $uid, $bitfield, $options, $mchat_allow_bbcode, $mchat_urls, $mchat_smilies);

		// Not allowed bbcodes
		if (!$mchat_allow_bbcode)
		{
			$message = preg_replace('#\[/?[^\[\]]+\]#Usi', '', $message);
		}

		// Disallowed bbcodes
		if ($this->config['mchat_bbcode_disallowed'])
		{
			$bbcode_replace = array(
				'#\[(' . $this->config['mchat_bbcode_disallowed'] . ')[^\[\]]+\]#Usi',
				'#\[/(' . $this->config['mchat_bbcode_disallowed'] . ')[^\[\]]+\]#Usi',
			);

			$message = preg_replace($bbcode_replace, '', $message);
		}

		// Reset the config settings
		if (isset($old_cfg['min_post_chars']))
		{
			$this->config['min_post_chars'] = $old_cfg['min_post_chars'];
		}

		if (isset($old_cfg['max_post_smilies']))
		{
			$this->config['max_post_smilies'] = $old_cfg['max_post_smilies'];
		}

		return array(
			'message'			=> str_replace('\'', '&#39;', $message),
			'bbcode_bitfield'	=> $bitfield,
			'bbcode_uid'		=> $uid,
			'bbcode_options'	=> $options,
		);
	}

	/**
	* Renders a template file and returns it
	* @return string
	*/
	protected function render($template_file)
	{
		$this->template->set_filenames(array('body' => $template_file));
		$content = $this->template->assign_display('body', '', true);

		return trim(str_replace(array("\r", "\n"), '', $content));
	}
}
