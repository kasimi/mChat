<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 kasimi
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace dmzx\mchat\migrations;

use phpbb\db\migration\migration;

class mchat_2_0_0_rc7 extends migration
{
	static public function depends_on()
	{
		return array(
			'\dmzx\mchat\migrations\mchat_2_0_0_rc6',
		);
	}

	public function update_data()
	{
		return array(
			array('config.update', array('mchat_version', '2.0.0-RC7')),

			array('config.update', array('mchat_prune', 0)),
			array('config.add', array('mchat_prune_mode', 0)),
		);
	}
}
