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
//
// Some characters for use
// ’ » “ ” …

$lang = array_merge($lang, array(
	'ACP_MCHAT_CONFIG'						=> 'Konfiguration',
	'ACP_CAT_MCHAT'							=> 'mChat',
	'ACP_MCHAT_TITLE'						=> 'mChat Extension für phpBB 3.1',
	'ACP_MCHAT_VERSION'						=> 'Version',
	'UCP_CAT_MCHAT'							=> 'mChat Präferenzen',
	'UCP_MCHAT_CONFIG'						=> 'mChat Benutzerpräferenzen',

	// ACP configuration sections
	'MCHAT_SETTINGS_INDEX'					=> 'Einstellung Index Seite',
	'MCHAT_SETTINGS_CUSTOM'					=> 'Benutzerdefinierte Seiteneinstellungen ',
	'MCHAT_SETTINGS_ARCHIVE'				=> 'Einstellungen Archiv Seite',
	'MCHAT_SETTINGS_POSTS'					=> 'Einstellung neue Beiträge',
	'MCHAT_SETTINGS_MESSAGES'				=> 'Einstellung Mitteilung',
	'MCHAT_SETTINGS_PRUNE'					=> 'Befehls Einstellung',
	'MCHAT_SETTINGS_STATS'					=> 'Einstellung Wer ist im Chat',

	// ACP entries
	'ACP_MCHAT_RULES'						=> 'Regeln',
	'ACP_MCHAT_RULES_EXPLAIN'				=> 'Gib deine Regeln hier ein. Jeder Regel in eine neue Zeile.<br />Lass das Feld frei um die Anzeige zu deaktivieren. Das Limit liegt bei 255 Zeichen.<br /><strong>Diese Nachricht kann übersetzt werden.</strong> (editiere hierzu die Datei: mchat_lang.php und lies die Anweisungen).',
	'LOG_MCHAT_CONFIG_UPDATE'				=> '<strong>mChat-Konfiguration erfolgreich geändert</strong>',
	'MCHAT_CONFIG_SAVED'					=> 'Die mChat-Konfiguration wurde erfolgreich geändert',
	'MCHAT_TITLE'							=> 'Mini-Chat',
	'MCHAT_AVATARS'							=> 'Avatare anzeigen',
	'MCHAT_AVATARS_EXPLAIN'					=> 'Wenn ja gesetzt ist, wird ein in der Größe verändertes Benutzer Avatare angezeigt',
	'MCHAT_ON_INDEX'						=> 'mChat im Index',
	'MCHAT_INDEX_HEIGHT'					=> 'Index Seiten Höhe',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'			=> 'Die Höhe der Chat Box in Pixeln auf der Index-Seite des Forums.<br /><em>Du kannst nur von 50 bis 1000 Pixel einstellen</em>',
	'MCHAT_LOCATION'						=> 'Platzierung im Forum',
	'MCHAT_TOP_OF_FORUM'					=> 'Oberhalb des Forums',
	'MCHAT_BOTTOM_OF_FORUM'					=> 'Unterhalb des Forums',
	'MCHAT_REFRESH'							=> 'Aktualisieren',
	'MCHAT_REFRESH_EXPLAIN'					=> 'Anzahl der Sekunden, bevor Chat automatisch aktualisiert wird.<br /><em>Sie sind von 5 bis 60 Sekunden begrenzt</em>',
	'MCHAT_LIVE_UPDATES'					=> 'Live Updates von bearbeiteten und gelöschten Nachrichten',
	'MCHAT_LIVE_UPDATES_EXPLAIN'			=> 'Wenn ein Benutzer Nachrichten bearbeitet oder löscht, werden die Änderungen für alle anderen live aktualisiert, ohne dass sich die Seite zu aktualisiert. Deaktivieren Sie diese Option, wenn Leistungsprobleme auftreten.',
	'MCHAT_PRUNE'							=> 'Automatisches Löschen erlauben',
	'MCHAT_PRUNE_EXPLAIN'					=> 'Only occurs if a user views the custom or archive pages.',
	'MCHAT_PRUNE_NUM'						=> 'Anzahl verbleibender Nachrichten nach dem automatischem Löschen',
	'MCHAT_MESSAGE_LIMIT'					=> 'Anzahl der Nachrichten, die auf der kundenspezifischen Seite angezeigt werden',
	'MCHAT_MESSAGE_LIMIT_EXPLAIN'			=> 'Die maximale Anzahl der Nachrichten, die auf der Hauptseite des Forums angezeigt werden soll.<br /><em>Empfohlen sind zwischen 10 und 30</em>',
	'MCHAT_MESSAGE_NUM'						=> 'Anzahl der Nachrichten, die auf der Indexseite angezeigt werden',
	'MCHAT_MESSAGE_NUM_EXPLAIN'				=> 'Die maximale Anzahl von Nachrichten im Chat-Bereich die auf der Indexseite angezeigt werden. <br /> <Em> Empfohlen von 10 bis 50 </ em>',
	'MCHAT_ARCHIVE_LIMIT'					=> 'Anzahl der Meldungen, die auf der Archivseite angezeigt werden',
	'MCHAT_ARCHIVE_LIMIT_EXPLAIN'			=> 'Die maximale Anzahl Nachrichten pro Seite im Archiv.<br /> <em>Empfohlen sind 25 bis 50</em>',
	'MCHAT_FLOOD_TIME'						=> 'Flood Intervall',
	'MCHAT_FLOOD_TIME_EXPLAIN'				=> 'Die Zeit in Sekunden, die ein Benutzer warten muß, bis er eine neue Nachricht im mChat absenden kann.<br /><em>Empfohlen sind 5 bis 30, stelle 0 ein, um die Funktion zu deaktivieren</.',
	'MCHAT_EDIT_DELETE_LIMIT'				=> 'Frist für die Bearbeitung und das Löschen von Nachrichten',
	'MCHAT_EDIT_DELETE_LIMIT_EXPLAIN'		=> 'Nachrichten, die älter als die angegebene Anzahl von Sekunden können vom Autor nicht mehr bearbeitet oder gelöscht werden.<br />Benutzer, die bearbeiten/löschen dürfen und von der <em>Moderator Genehmigung befreit sind</ me> von dieser Frist. <br /> Bei 0 wird unbegrenztes Bearbeiten und Löschen ermöglicht.',
	'MCHAT_MAX_MESSAGE_LENGTH'				=> 'Maximale Nachrichtenlänge',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'		=> 'Die maximal erlaubte Anzahl von Zeichen pro Nachricht.<br /><em>Empfohlen sind 100 bis 500, stelle 0 ein, um die Funktion zu deaktivieren</em>.',
	'MCHAT_CUSTOM_PAGE'						=> 'Eigenständige Seite',
	'MCHAT_CUSTOM_PAGE_EXPLAIN'				=> 'Erlaubt die Benutzung des Chats auf einer eigenständigen Seite.',
	'MCHAT_CUSTOM_HEIGHT'					=> 'Höhe der eigenen mChat Seite',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'			=> 'Die Höhe der Chat-Box in Pixeln auf der eigenen mChat Seite.<br /><em>Du kannst nur von 50 bis 1000 Pixel einstellen</em>.',
	'MCHAT_DATE_FORMAT'						=> 'Datums-Format',
	'MCHAT_DATE_FORMAT_EXPLAIN'				=> 'Die Syntax entspricht der der date()-Funktion von PHP <a href="http://www.php.net/date">date()</a>',
	'MCHAT_CUSTOM_DATEFORMAT'				=> 'Eigenes…',
	'MCHAT_BBCODES_DISALLOWED'				=> 'Nicht erlaubte BBcodes',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'		=> 'Hier kann man BBcodes eintragen, die <strong>nicht</strong> in einer Nachricht verwendet werden dürfen.<br />BBcodes mit einem senkrechten Strich trennen, beispielsweise: b|u|code',
	'MCHAT_STATIC_MESSAGE'					=> 'Permanente Nachricht in der Chatbox',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'			=> 'Hier kannst du eine permanente Nachricht für die Benutzer des mChats eingeben.<br />Lass es frei um keine Nachricht anzuzeigen. Deine Nachricht kann 255 Zeichen umfassen.<br /><strong>Diese Nachricht kann auch übersetzt werden.</strong>	(Editiere hierzu die Datei mchat_lang.php file und lies die Anweisungen.).',
	'MCHAT_USER_TIMEOUT'					=> 'Zeitüberschreitung für Benutzer',
	'MCHAT_USER_TIMEOUT_EXPLAIN'			=> 'Stelle einen Wert für die Zeitüberschreitung in Sekunden ein, nach der die Sitzung für einen Benutzer im mChat endet. Stelle 0 ein für kein Timeout Limit.<br /><em>Das Limit ist das Selbe, wie in deinen %sForum Einstellungen für Sitzungen%s. Derzeit beträgt dieser Wert %s Sekunden.</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'			=> 'Smilielimit überschreiben?',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'	=> 'Falls JA eingestellt ist, wird das eingestellte Limit im Forum für Smilies im mChat aufgehoben.',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'			=> 'Minimale Anzahl von Zeichen aufheben?',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'	=> 'Falls ja eingestellt ist, wird das Limit für die minimale Anzahl an Zeichen für mChat-Nachrichten aufgehoben.',
	'MCHAT_NEW_POSTS_TOPIC'					=> 'Zeige New Topic Beiträge an',
	'MCHAT_NEW_POSTS_TOPIC_EXPLAIN'			=> 'Stelle auf Ja, damit neue Themen und Beiträge aus dem Forum im Chat Nachrichtenbereich angezeigt werden.',
	'MCHAT_NEW_POSTS_REPLY'					=> 'Zeige neue Antworten in Beiträgen an',
	'MCHAT_NEW_POSTS_REPLY_EXPLAIN'			=> 'Stelle auf Ja, damit beantwortete Beiträge aus dem Forum im Chat Nachrichtenbereich angezeigt werden.',
	'MCHAT_NEW_POSTS_EDIT'					=> 'Zeige editierte Beiträge an',
	'MCHAT_NEW_POSTS_EDIT_EXPLAIN'			=> 'Stelle auf Ja, damit bearbeitete Beiträge aus dem Forum	im Chat Nachrichtenbereich angezeigt werden.',
	'MCHAT_NEW_POSTS_QUOTE'					=> 'Zeige zitierte Beiträge an',
	'MCHAT_NEW_POSTS_QUOTE_EXPLAIN'			=> 'Stelle auf Ja, damit die zitierten Beiträge aus dem Forum im Chat Nachrichtenbereich angezeigt werden.',
	'MCHAT_WHOIS'							=> 'Anzeige <em>Wer ist im Chat</em> unter dem Chat',
	'MCHAT_STATS_INDEX'						=> 'Anzeige <em>Wer chattet</em> im Statistikbereich',
	'MCHAT_STATS_INDEX_EXPLAIN'				=> 'Zeigt an, wer im Chat <em>Wer ist online</em> Bereich auf der Indexseite ist',
	'MCHAT_WHOIS_REFRESH'					=> 'Wer ist im Chat Aktualisierungsintervall ',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'			=> 'Die Anzahl Sekunden, bis die Whois-anzeige aktualisiert wird.<br /><strong>Nicht unter 30 Sekunden einstellen!</strong>',
	'MCHAT_MESSAGE_TOP'						=> 'Ort neuer Chat-Nachrichten',
	'MCHAT_MESSAGE_TOP_EXPLAIN'				=> 'Neue Nachrichten werden am oberen oder am unteren Rand im Chat erscheinen.',
	'MCHAT_BOTTOM'							=> 'Unten',
	'MCHAT_TOP'								=> 'Oben',
	'MCHAT_PAUSE_ON_INPUT'					=> 'Den Chat während einer Nachrichteneingabe nicht aktualisieren',
	'MCHAT_PAUSE_ON_INPUT_EXPLAIN'			=> 'Falls JA eingestellt ist, ist das automatische Aktualisieren während der Eingabe einer Nachricht deaktiviert',
	'MCHAT_PURGE'							=> 'Lösche jetzt alle Nachrichten',
	'MCHAT_PURGE_CONFIRM'					=> 'Bestätige alle Nachrichten werden gelöscht',
	'MCHAT_PURGED'							=> 'Alle mChat Nachrichten wurden erfolgreich gelöscht',

	// Error reporting
	'TOO_SMALL_MCHAT_ARCHIVE_LIMIT'			=> 'Der Archiv Grenzwert ist zu klein.',
	'TOO_LARGE_MCHAT_ARCHIVE_LIMIT'			=> 'Der Archiv Grenzwert ist zu groß.',
	'TOO_LONG_MCHAT_BBCODE_DISALLOWED'		=> 'Der verbotene bbcodes Wert ist zu lang.',
	'TOO_SMALL_MCHAT_CUSTOM_HEIGHT'			=> 'Der individuelle Höhenwert ist zu klein.',
	'TOO_LARGE_MCHAT_CUSTOM_HEIGHT'			=> 'Der individuelle Höhenwert ist zu groß.',
	'TOO_LONG_MCHAT_DATE'					=> 'Das eingegebene Datumsformat ist zu lang.',
	'TOO_SHORT_MCHAT_DATE'					=> 'Das eingegebene Datumsformat ist zu kurz.',
	'TOO_SMALL_MCHAT_FLOOD_TIME'			=> 'Das Flood-Intervall ist zu kurz.',
	'TOO_LARGE_MCHAT_FLOOD_TIME'			=> 'Das Flood-Intervall ist zu lang.',
	'TOO_SMALL_MCHAT_INDEX_HEIGHT'			=> 'Der Index Höhenwert ist zu klein.',
	'TOO_LARGE_MCHAT_INDEX_HEIGHT'			=> 'Der Index Höhenwert ist zu groß.',
	'TOO_SMALL_MCHAT_MAX_MESSAGE_LNGTH'		=> 'Der maximale Nachrichtenlänge Wert ist zu klein.',
	'TOO_LARGE_MCHAT_MAX_MESSAGE_LNGTH'		=> 'Der maximale Nachrichtenlänge Wert ist zu groß.',
	'TOO_SMALL_MCHAT_MESSAGE_LIMIT'			=> 'Der Nachrichten Grenzwert ist zu klein.',
	'TOO_LARGE_MCHAT_MESSAGE_LIMIT'			=> 'Der Nachrichten Grenzwert ist zu groß.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM'			=> 'Die angezeigte Anzahl der Nachrichten auf der Indexseite ist zu klein.',
	'TOO_LARGE_MCHAT_MESSAGE_NUM'			=> 'Die angezeigte Anzahl der Nachrichten auf der Indexseite ist zu groß.',
	'TOO_SMALL_MCHAT_REFRESH'				=> 'Der Aktualisierungs Wert ist zu klein.',
	'TOO_LARGE_MCHAT_REFRESH'				=> 'Der Aktualisierungs Wert ist zu groß.',
	'TOO_LONG_MCHAT_STATIC_MESSAGE'			=> 'Der statische Nachrichtenwert ist zu lang.',
	'TOO_SMALL_MCHAT_TIMEOUT'				=> 'Der Benutzer Timeout Wert ist zu klein.',
	'TOO_LARGE_MCHAT_TIMEOUT'				=> 'Der Benutzer Timeout Wert ist zu groß.',
	'TOO_SMALL_MCHAT_WHOIS_REFRESH'			=> 'Der Whois Refresh-Wert ist zu klein.',
	'TOO_LARGE_MCHAT_WHOIS_REFRESH'			=> 'Der Whois Refresh-Wert ist zu groß.',

	// User perms
	'ACL_U_MCHAT_USE'						=> 'Kann mChat benutzen',
	'ACL_U_MCHAT_VIEW'						=> 'Kann mChat sehen',
	'ACL_U_MCHAT_EDIT'						=> 'Kann mChat bearbeiten',
	'ACL_U_MCHAT_DELETE'					=> 'Kann mChat Nachricht löschen',
	'ACL_U_MCHAT_IP'						=> 'Kann mChat IP sehen',
	'ACL_U_MCHAT_PM'						=> 'Kann Private Nachricht im mChat verwenden',
	'ACL_U_MCHAT_LIKE'						=> 'Kann "gefällt mir" Nachrichten im mChat verwenden',
	'ACL_U_MCHAT_QUOTE'						=> 'Kann Zitate im mChat verwenden',
	'ACL_U_MCHAT_FLOOD_IGNORE'				=> 'Kann den mChat Flood ignorieren',
	'ACL_U_MCHAT_ARCHIVE'					=> 'Kann das mChat Archiv sehen',
	'ACL_U_MCHAT_BBCODE'					=> 'Kann BBCode im mChat verwenden',
	'ACL_U_MCHAT_SMILIES'					=> 'Kann Smilies im mChat verwenden',
	'ACL_U_MCHAT_URLS'						=> 'Kann Url im mChat posten',

	// Admin perms
	'ACL_A_MCHAT'							=> 'Kann mChat Einstellung managen',
));
