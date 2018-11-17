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
	'MCHAT_PREFERENCES'				=> 'Preferencje mChat',
	'MCHAT_NO_SETTINGS'				=> 'Nie masz uprawnień do wprowadzania zmian w ustawieniach.',

	'MCHAT_INDEX'					=> 'Wyświetlaj na stronie głównej forum',
	'MCHAT_SOUND'					=> 'Włącz dźwięk',
	'MCHAT_WHOIS_INDEX'				=> 'Pokazuj <em>Kto czatuje</em> poniżej czatu',
	'MCHAT_STATS_INDEX'				=> 'Pokazuj <em>Kto czatuje</em> w sekcji statystyk forum',
	'MCHAT_STATS_INDEX_EXPLAIN'		=> 'Pokazuje Kto czatuje poniżej sekcji <em>Kto jest online</em> na stronie głównej forum.',
	'MCHAT_AVATARS'					=> 'Pokazuj awatary',
	'MCHAT_CAPITAL_LETTER'			=> 'Wiadomości z wielkiej litery',
	'MCHAT_POSTS'					=> 'Pokazuj nowe posty (obecnie wyłączone, może być włączone w sekcji globalnych ustawieniach mChat w Panelu administracji)',
	'MCHAT_DISPLAY_CHARACTER_COUNT'	=> 'Pokazuj liczbę znaków podczas wpisywania wiadomości',
	'MCHAT_RELATIVE_TIME'			=> 'Pokazuj względny czas dla nowych wiadomości',
	'MCHAT_RELATIVE_TIME_EXPLAIN'	=> 'Pokazuje “właśnie teraz”, “1 minutę temu” itp. dla każdej wiadomości. Zaznacz <em>Nie</em>, aby zawsze pokazywać pełną datę.',
	'MCHAT_MESSAGE_TOP'				=> 'Pojawianie się nowych wiadomości',
	'MCHAT_MESSAGE_TOP_EXPLAIN'		=> 'Nowe wiadomości będą się pojawiały u góry lub na dole czatu.',
	'MCHAT_LOCATION'				=> 'Umiejscowienie na stronie głównej forum',
	'MCHAT_BOTTOM'					=> 'U góry',
	'MCHAT_TOP'						=> 'Na dole',

	'MCHAT_POSTS_TOPIC'				=> 'Wyświetlaj nowe tematy',
	'MCHAT_POSTS_REPLY'				=> 'Wyświetlaj nowe odpowiedzi',
	'MCHAT_POSTS_EDIT'				=> 'Wyświetlaj edytowane posty',
	'MCHAT_POSTS_QUOTE'				=> 'Wyświetlaj zacytowane posty',
	'MCHAT_POSTS_LOGIN'				=> 'Wyświetlaj użytkowników, którzy się właśnie zalogowali',

	'MCHAT_DATE_FORMAT'				=> 'Format daty',
	'MCHAT_DATE_FORMAT_EXPLAIN'		=> 'Składnia jest identyczna jak w przypadku funkcji <a href="http://www.php.net/date">date()</a> w języku PHP.',
	'MCHAT_CUSTOM_DATEFORMAT'		=> 'Własna…',
]);
