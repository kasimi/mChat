<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2016 dmzx - http://www.dmzx-web.net
 * @copyright (c) 2016 kasimi - https://kasimi.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters for use
// ’ » “ ” …

$lang = array_merge($lang, [
	'MCHAT_TITLE'					=> 'mChat',
	'MCHAT_TITLE_COUNT'				=> [
		0 => 'mChat',
		1 => 'mChat [<strong>%1$d</strong>]',
	],
	'MCHAT_NAVBAR_CUSTOM_PAGE'		=> 'Strona mChat',
	'MCHAT_NAVBAR_ARCHIVE'			=> 'Archiwum',
	'MCHAT_NAVBAR_RULES'			=> 'Zasady',

	// Who is chatting
	'MCHAT_WHO_IS_CHATTING'			=> 'Kto czatuje',
	'MCHAT_ONLINE_USERS_TOTAL'		=> [
		0 => 'Nikt nie czatuje',
		1 => '<strong>%1$d</strong> użytkownik czatuje',
		2 => '<strong>%1$d</strong> użytkowników czatuje',
	],
	'MCHAT_ONLINE_EXPLAIN'			=> 'Według danych z ostatniej(ich) %1$s',
	'MCHAT_HOURS'					=> [
		1 => '%1$d godziny',
		2 => '%1$d godzin',
	],
	'MCHAT_MINUTES'					=> [
		1 => '%1$d minuty',
		2 => '%1$d minut',
	],
	'MCHAT_SECONDS'					=> [
		1 => '%1$d sekundy',
		2 => '%1$d sekund',
	],

	// Custom translations for administrators
	'MCHAT_RULES_MESSAGE'			=> '',
	'MCHAT_STATIC_MESSAGE'			=> '',

	// Post notification messages (%1$s is replaced with a link to the new/edited post, %2$s is replaced with a link to the forum)
	'MCHAT_NEW_POST'				=> 'napisał(a) nowy temat: %1$s w %2$s',
	'MCHAT_NEW_POST_DELETED'		=> 'napisał(a) nowy temat, który został usunięty',
	'MCHAT_NEW_REPLY'				=> 'napisał(a) odpowiedź: %1$s w %2$s',
	'MCHAT_NEW_REPLY_DELETED'		=> 'napisał(a) odpowiedź, która została usunięta',
	'MCHAT_NEW_QUOTE'				=> 'zacytował(a): %1$s w %2$s',
	'MCHAT_NEW_QUOTE_DELETED'		=> 'napisał(a) odpowiedź, która została usunięta',
	'MCHAT_NEW_EDIT'				=> 'edytował(a) post: %1$s w %2$s',
	'MCHAT_NEW_EDIT_DELETED'		=> 'edytował(a) post, który został usunięty',
	'MCHAT_NEW_LOGIN'				=> 'zalogował(a) się',
]);
