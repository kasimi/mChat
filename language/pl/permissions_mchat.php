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
	'ACL_U_MCHAT_USE'						=> 'Może korzystać z mChat',
	'ACL_U_MCHAT_VIEW'						=> 'Może wyświetlać mChat',
	'ACL_U_MCHAT_EDIT'						=> 'Może edytować własne wiadomości',
	'ACL_U_MCHAT_DELETE'					=> 'Może usuwać własne wiadomości',
	'ACL_U_MCHAT_MODERATOR_EDIT'			=> 'Może edytować wiadomości innych użytkowników',
	'ACL_U_MCHAT_MODERATOR_DELETE'			=> 'Może usuwać wiadomości innych użytkowników',
	'ACL_U_MCHAT_IP'						=> 'Może wyświetlać adresy IP innych użytkowników',
	'ACL_U_MCHAT_PM'						=> 'Może korzystać z prywatnych wiadomości',
	'ACL_U_MCHAT_LIKE'						=> 'Może widzieć ikonę polubienia (wymagane pozwolenie na znaczniki BBCode)',
	'ACL_U_MCHAT_QUOTE'						=> 'Może widzieć ikonę cytowania (wymagane pozwolenie na znaczniki BBCode)',
	'ACL_U_MCHAT_FLOOD_IGNORE'				=> 'Może igonorować limit wysyłania wiadomości pod rząd (flooding)',
	'ACL_U_MCHAT_ARCHIVE'					=> 'Może wyświetlać archiwum',
	'ACL_U_MCHAT_BBCODE'					=> 'Może korzystać ze znaczników BBCode',
	'ACL_U_MCHAT_SMILIES'					=> 'Może korzystać z uśmieszków',
	'ACL_U_MCHAT_URLS'						=> 'Może wysyłać wiadomości z automatycznie sparsowanymi adresami URL',

	'ACL_U_MCHAT_AVATARS'					=> 'Może dostosowywać <em>Wyświetlanie awatarów</em>',
	'ACL_U_MCHAT_CAPITAL_LETTER'			=> 'Może dostosowywać <em>Opcje pisania z wielkiej litery</em>',
	'ACL_U_MCHAT_CHARACTER_COUNT'			=> 'Może dostosowywać <em>Wyświetlanie ilości znaków</em>',
	'ACL_U_MCHAT_DATE'						=> 'Może dostosowywać <em>Format daty</em>',
	'ACL_U_MCHAT_INDEX'						=> 'Może dostosowywać <em>Wyświetlanie czatu na stronie głównej forum</em>',
	'ACL_U_MCHAT_LOCATION'					=> 'Może dostosowywać <em>Umiejcowienie czatu na stronie głównej forum</em>',
	'ACL_U_MCHAT_MESSAGE_TOP'				=> 'Może dostosowywać <em>Umiejcowienie nowych wiadomości czatu</em>',
	'ACL_U_MCHAT_POSTS'						=> 'Może dostosowywać <em>Wyświetlanie nowych postów</em>',
	'ACL_U_MCHAT_RELATIVE_TIME'				=> 'Może dostosowywać <em>Wyświetlanie względnego czasu wiadomości</em>',
	'ACL_U_MCHAT_SOUND'						=> 'Może dostosowywać <em>Opcje odtwarzania dźwięku przy nowej wiadomości</em>',
	'ACL_U_MCHAT_WHOIS_INDEX'				=> 'Może dostosowywać <em>Wyświetlanie Kto czatuje poniżej czatu</em>',
	'ACL_U_MCHAT_STATS_INDEX'				=> 'Może dostosowywać <em>Wyświetlanie Kto czatuje w sekcji statystyk forum</em>',

	'ACL_A_MCHAT'							=> 'Może zarządzać ustawieniami mChat',
]);
