<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\migrations;

class mchat_2_0_0_rc6 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array(
			'\dmzx\mchat\migrations\mchat_2_0_0_rc5',
		);
	}

	public function update_data()
	{
		return array(
			array('config.update', array('mchat_version', '2.0.0-RC6')),

			array('config.add', array('mchat_prune_gc', strtotime('1 day', 0))),
			array('config.add', array('mchat_prune_last_gc', 0, true)), // Dynamic, do not cache
		);
	}
}
