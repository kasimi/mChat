<?php

/**
 *
 * @package phpBB Extension - mChat
 * @copyright (c) 2015 dmzx - http://www.dmzx-web.net
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
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

$lang = array_merge($lang, array(
	'MCHAT_TITLE'					=> 'Mini Chat',
	'MCHAT_ADD'						=> 'Senden',
	'MCHAT_ANNOUNCEMENT'			=> 'Ankündigen',
	'MCHAT_ARCHIVE'					=> 'Archiv',
	'MCHAT_ARCHIVE_PAGE'			=> 'Mini Chat Archiv',
	'MCHAT_BBCODES'					=> 'BBCodes',
	'MCHAT_CUSTOM_BBCODES'			=> 'Benutzerdefinierte BBCodes',
	'MCHAT_DELCONFIRM'				=> 'Nachricht endgültig löschen?',
	'MCHAT_EDIT'					=> 'Bearbeite',
	'MCHAT_EDITINFO'				=> 'Bearbeite die Nachricht und klicke OK',
	'MCHAT_FLOOD'					=> 'Du kannst keine Nachricht so schnell nach deiner letzten Nachricht schreiben',
	'MCHAT_FOE'						=> 'Die Nachricht wurde von <strong>% 1 $ s </ strong> gemacht, der derzeit auf der Ignorieren-Liste steht.',
	'MCHAT_RULES'					=> 'Regeln',
	'MCHAT_HOURS'					=> array(
		1 => '%1$d Stunde',
		2 => '%1$d Stunden',
	),
	'MCHAT_MINUTES'					=> array(
		1 => '%1$d Minute',
		2 => '%1$d Minuten',
	),
	'MCHAT_SECONDS'					=> array(
		1 => '%1$d Sekunde',
		2 => '%1$d Sekunden',
	),
	'MCHAT_WHOIS_USER'				=> 'IP whois for %1$s',
	'MCHAT_MESS_LONG'				=> 'Your message is too long. Please limit it to %1$d characters',
	'MCHAT_NO_CUSTOM_PAGE'			=> 'The mChat custom page is not activated at this time!',
	'MCHAT_NO_RULES'				=> 'The mChat rules page is not activated at this time!',
	'MCHAT_NOACCESS'				=> 'You don’t have permission to post in the mChat',
	'MCHAT_NOACCESS_ARCHIVE'		=> 'You don’t have permission to view the archive',
	'MCHAT_NOJAVASCRIPT'			=> 'Your browser does not support JavaScript or JavaScript is disabled',
	'MCHAT_NOMESSAGE'				=> 'No messages',
	'MCHAT_NOMESSAGEINPUT'			=> 'You have not entered a message',
	'MCHAT_NOSMILE'					=> 'Smilies not found',
	'MCHAT_OK'						=> 'OK',
	'MCHAT_PAUSE'					=> 'Paused',
	'MCHAT_PERMISSIONS'				=> 'Change user’s permissions',
	'MCHAT_REFRESHING'				=> 'Refreshing...',
	'MCHAT_REFRESH_NO'				=> 'Update is off',
	'MCHAT_REFRESH_YES'				=> 'Updates every <strong>%1$d</strong> seconds',
	'MCHAT_RESPOND'					=> 'Respond to user',
	'MCHAT_RESET_QUESTION'			=> 'Clear the input area?',
	'MCHAT_SESSION_OUT'				=> 'Chat session has expired',

	'MCHAT_SESSION_ENDS'			=> 'Chat Sitzung endet in',
	'MCHAT_SMILES'					=> 'Smilies',
	'MCHAT_TOTALMESSAGES'			=> 'Nachrichten insgesamt: <strong>%1$d</strong>',
	'MCHAT_USESOUND'				=> 'Verwende Sound',
	'MCHAT_ONLINE_USERS_TOTAL'		=> array(
		0 => 'Niemand ist im Chat',
		1 => 'Insgesamt ist <strong>%1$d</strong> User im Chat',
		2 => 'Insgesamt sind <strong>%1$d</strong> User im Chat',
	),
	'MCHAT_ONLINE_EXPLAIN'			=> 'basierend auf den aktiven Besuchern bisher %1$s',
	'WHO_IS_CHATTING'				=> 'Wer chattet',
	'WHO_IS_REFRESH_EXPLAIN'		=> 'Aktualisiert alle <strong>%d</strong> Sekunden',
	'MCHAT_NEW_POST'				=> 'Schreibe ein neues Thema: %1$s in %2$s',
	'MCHAT_NEW_REPLY'				=> 'Schreibe eine Antwort: %1$s in %2$s',
	'MCHAT_NEW_QUOTE'				=> 'Antwortete mit einem Zitat: %1$s in %2$s',
	'MCHAT_NEW_EDIT'				=> 'Bearbeite eine Nachricht: %1$s in %2$s',

	// UCP
	'UCP_PROFILE_MCHAT'				=> 'mChat Einstellung',
	'DISPLAY_MCHAT'					=> 'mChat auf der Indexseite anzeigen',
	'SOUND_MCHAT'					=> 'Aktiviere Sound für mChat',
	'DISPLAY_STATS_INDEX'			=> 'Zeige die "Wer ist im mChat" Statistik auf der Indexseite an',
	'DISPLAY_NEW_TOPICS'			=> 'Zeige neue Beiträge im mChat an',
	'DISPLAY_AVATARS'				=> 'Zeige Avatare im mChat an',
	'CHAT_AREA'						=> 'Chat Umgebung',
	'CHAT_AREA_EXPLAIN'				=> 'Die Art der Umgebung zu verwenden, um Nachrichten zu schreiben ',
	'INPUT_AREA'					=> 'Eingangsbereich',
	'TEXT_AREA'						=> 'Textbereich',
	'UCP_CAT_MCHAT'					=> 'mChat',
	'UCP_MCHAT_CONFIG'				=> 'mChat',

	// Preferences
	'LOG_MCHAT_TABLE_PRUNED'		=> 'mChat Tabelle löschen',
	'ACP_USER_MCHAT'				=> 'mChat Einstellung',
	'LOG_DELETED_MCHAT'				=> '<strong>lösche mChat Nachricht</strong><br />» %1$s',
	'LOG_EDITED_MCHAT'				=> '<strong>Bearbeite mChat Nachricht</strong><br />» %1$s',
	'MCHAT_NEW_CHAT'				=> 'Neue Chat Nachricht!',
	'MCHAT_SEND_PM'					=> 'Sende Private Nachricht',
	'MCHAT_LIKE'					=> 'Like dieses Posting',
	'MCHAT_LIKES'					=> 'Likes dieses Posting',

	// Custom translations for administrators
	'MCHAT_RULES_MESSAGE'			=> '',
	'MCHAT_STATIC_MESSAGE'			=> '',
));
