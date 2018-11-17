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
	'MCHAT_ADD'						=> 'Wyślij',
	'MCHAT_ARCHIVE'					=> 'Archiwum',
	'MCHAT_ARCHIVE_PAGE'			=> 'Archiwum mChat',
	'MCHAT_CUSTOM_PAGE'				=> 'mChat',
	'MCHAT_BBCODES'					=> 'Znaczniki BBCode',
	'MCHAT_CUSTOM_BBCODES'			=> 'Własne znaczniki BBCode',
	'MCHAT_DELCONFIRM'				=> 'Czy na pewno chcesz usunąć tę wiadomość?',
	'MCHAT_EDIT'					=> 'Edytuj',
	'MCHAT_EDITINFO'				=> 'Edytuj wiadomość poniżej.',
	'MCHAT_NEW_CHAT'				=> 'Nowa wiadomość czatu!',
	'MCHAT_SEND_PM'					=> 'Wyślij prywatną wiadomość',
	'MCHAT_LIKE'					=> 'Polub wiadomość',
	'MCHAT_LIKES'					=> 'lubi tę wiadomość',
	'MCHAT_FLOOD'					=> 'Nie możesz wysłać nowej wiadomości od razu po wysłaniu poprzedniej.',
	'MCHAT_FOE'						=> 'Ta wiadomość została napisana przez użytkownika <strong>%1$s</strong>, którego obecnie ignorujesz.',
	'MCHAT_RULES'					=> 'Zasady',
	'MCHAT_WHOIS_USER'				=> 'WHOIS dla IP: %1$s',
	'MCHAT_MESS_LONG'				=> 'Twoja wiadomość jest za długa. Ogranicz ją do %1$d znaków.',
	'MCHAT_NO_CUSTOM_PAGE'			=> 'Strona mChat nie jest aktywowana.',
	'MCHAT_NO_RULES'				=> 'Strona z zasadami mChat nie jest aktywowana.',
	'MCHAT_NOACCESS_ARCHIVE'		=> 'Nie masz uprawień do przeglądania archiwum mChat.',
	'MCHAT_NOJAVASCRIPT'			=> 'Zezwól na JavaScript, aby korzystać z mChat.',
	'MCHAT_NOMESSAGE'				=> 'Brak wiadomości',
	'MCHAT_NOMESSAGEINPUT'			=> 'Nie wpisano wiadomości',
	'MCHAT_MESSAGE_DELETED'			=> 'Wiadomość została usunięta.',
	'MCHAT_OK'						=> 'OK',
	'MCHAT_PAUSE'					=> 'Wstrzymano',
	'MCHAT_PERMISSIONS'				=> 'Zmień uprawnienia użytkownika',
	'MCHAT_REFRESHING'				=> 'Odświeżanie…',
	'MCHAT_RESPOND'					=> 'Odpowiedz użytkownikowi',
	'MCHAT_SMILES'					=> 'Uśmieszki',
	'MCHAT_TOTALMESSAGES'			=> 'Suma wiadomości: <strong>%1$d</strong>',
	'MCHAT_USESOUND'				=> 'Odtwórz dźwięk',
	'MCHAT_SOUND_ON'				=> 'Dźwięk jest włączony',
	'MCHAT_SOUND_OFF'				=> 'Dźwięk jest wyłączony',
	'MCHAT_ENTER'					=> 'Użyj Ctrl/Cmd + Enter, aby wykonać alternatywną operację',
	'MCHAT_ENTER_SUBMIT'			=> 'Enter wysyła wiadomość',
	'MCHAT_ENTER_LINEBREAK'			=> 'Enter wstawia nową linię',
	'MCHAT_COLLAPSE_TITLE'			=> 'Przełącz widoczność mChat',
	'MCHAT_WHO_IS_REFRESH_EXPLAIN'	=> 'Odświeżanie co <strong>%1$d</strong> sekund',
	'MCHAT_MINUTES_AGO'				=> [
		0 => 'przed chwilą',
		1 => '%1$d minutę temu',
		2 => '%1$d minut temu',
	],

	// These messages are formatted with JavaScript, hence {} and no %d
	'MCHAT_CHARACTER_COUNT'			=> '<strong>{current}</strong> znaków',
	'MCHAT_CHARACTER_COUNT_LIMIT'	=> '<strong>{current}</strong> znaków z {max} możliwych',
	'MCHAT_MENTION'					=> ' @{username} ',
]);
