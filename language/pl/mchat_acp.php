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
	// ACP Configuration sections
	'MCHAT_SETTINGS_INDEX'							=> 'Ustawienia strony głównej forum',
	'MCHAT_SETTINGS_CUSTOM'							=> 'Ustawienia strony mChat',
	'MCHAT_SETTINGS_ARCHIVE'						=> 'Ustawienia strony z archiwum',
	'MCHAT_SETTINGS_POSTS'							=> 'Ustawienia nowych postów',
	'MCHAT_SETTINGS_MESSAGES'						=> 'Ustawienia wiadomości',
	'MCHAT_SETTINGS_PRUNE'							=> 'Usuwanie wiadomości (dostępne tylko dla założycieli)',
	'MCHAT_SETTINGS_LOG'							=> 'Ustawienia dziennika aktywności (dostępne tylko dla założycieli)',
	'MCHAT_SETTINGS_STATS'							=> 'Ustawienia Kto czatuje',

	'MCHAT_GLOBALUSERSETTINGS_EXPLAIN'				=> 'Ustawienia, co do których użytkownik <strong>nie</strong> ma uprawień do zmiany, będą zastosowane poniższe.<br>Nowi użytkownicy będą mieli domyślnie przypisane poniższe ustawienia.<br><br>Przejdź do <em>Ustawień mChat w Panelu zarządzania kontem</em> w karcie <em>Uprawnienia</em>, aby spersonalizować ustawienia dla konkretnego użytkownika.<br>Przejdź do formularza <em>Preferencji</em> w sekcji <em>zarządzania użytkownikami</em>, aby dostosować indywidalne ustawienia użytkowników.',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE'			=> 'Nadpisz ustawienia dla wszystkich użytkowników',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE_EXPLAIN'	=> 'Zastosuje ustawienia zdefiniowane powyżej do <em>wszystkich</em> kont użytkowników.',
	'MCHAT_GLOBALUSERSETTINGS_OVERWRITE_CONFIRM'	=> 'Potwierdź nadpisanie ustawień mChat dla wszystkich użytkowników',

	'MCHAT_ACP_USER_PREFS_EXPLAIN'					=> 'Poniżej wylistowane są wszystkie ustawienia mChat dla wybranego użytkownika. Ustawienia, co do których użytkownik nie ma uprawień do zmiany są wyłączone. Te ustawienia mogą być zmienione w <em>Globalnych ustawieniach użytkownika</em>., w sekcji mChat.',

	// ACP settings
	'MCHAT_ACP_CHARACTERS'							=> 'znaków',
	'MCHAT_ACP_MESSAGES'							=> 'wiadomości',
	'MCHAT_ACP_SECONDS'								=> 'sekund',
	'MCHAT_ACP_HOURS'								=> 'godzin',
	'MCHAT_ACP_DAYS'								=> 'dni',
	'MCHAT_ACP_WEEKS'								=> 'tygodni',
	'MCHAT_ACP_GLOBALSETTINGS_TITLE'				=> 'Ustawienia globalne mChat',
	'MCHAT_ACP_GLOBALUSERSETTINGS_TITLE'			=> 'Ustawienia globalne mChat dla użytkownika',
	'MCHAT_VERSION'									=> 'Wersja',
	'MCHAT_RULES'									=> 'Zasady',
	'MCHAT_RULES_EXPLAIN'							=> 'Wpisz tutaj zasady dla czatu. Kod HTML jest dozwolony. Pozostaw pole pusty, aby wyłączyć wyświetlanie zasad.<br>Zasady mogą być przetłumaczone na inne języki: edytuj zmienną MCHAT_RULES_MESSAGE w pliku /ext/dmzx/mchat/language/XX/mchat.php.',
	'MCHAT_CONFIG_SAVED'							=> 'Konfiguracja mChat została zaktualizowana',
	'MCHAT_AVATARS'									=> 'Wyświetlaj awatary',
	'MCHAT_AVATARS_EXPLAIN'							=> 'Po wybraniu opcji <em>tak</em>, przeskalowane awatary użytkowników będą wyświetlane',
	'MCHAT_INDEX'									=> 'Wyświetlaj mChat na stronie głównej forum',
	'MCHAT_INDEX_HEIGHT'							=> 'Wysokość czatu na stronie głównej',
	'MCHAT_INDEX_HEIGHT_EXPLAIN'					=> 'Ustawia wysokość okna mChat na stronie głównej forum, w pikselach.<br><em>Wysokość musi się zawierać w przedziale od 50 do 1000. Domyślna wartość to 250.</em>',
	'MCHAT_TOP_OF_FORUM'							=> 'U góry',
	'MCHAT_BOTTOM_OF_FORUM'							=> 'Na dole',
	'MCHAT_REFRESH'									=> 'Interwał odświeżania',
	'MCHAT_REFRESH_EXPLAIN'							=> 'Liczba sekund pomiędzy kolejnymi odświeżaniami czatu.<br><em>Wartość musi się zawierać w przedziale od 5 do 60 sekund. Domyślna wartość to 10.</em>',
	'MCHAT_LIVE_UPDATES'							=> 'Live updates of edited and deleted messages',
	'MCHAT_LIVE_UPDATES_EXPLAIN'					=> 'Kiedy użytkownik edytuje lub usunie wiadomość, zmiany zostaną wprowadzone na bieżąco dla wszystkich, bez konieczności odświeżania strony. Wyłacz tę opcję, jeśli doświadczas problemów z wydajnością forum.',
	'MCHAT_PRUNE'									=> 'Włącz usuwanie wiadomości',
	'MCHAT_PRUNE_GC'								=> 'Interwał okresowego usuwania wiadomości',
	'MCHAT_PRUNE_GC_EXPLAIN'						=> 'Czas w sekundach, który musi upłynąć przed uruchomieniem następnego usuwania wiadomości. Uwaga: to ustawienie kontroluje <em>kiedy</em> wiadomości są sprawdzane, czy mogą być usunięte. Nie sprawdza ono zatem, <em>które</em> wiadomości zostaną usunięte. <em>Domyślną wartością jest 86400 = 24 godziny.</em>',
	'MCHAT_PRUNE_NUM'								=> 'Wiadomości do zachowania podczas usuwania',
	'MCHAT_PRUNE_NUM_EXPLAIN'						=> 'Kiedy używasz opcję ’wiadomości’ z ustaloną liczbą wiadomości do zachowania. Przy użyciu ’godziny’, ’dni’ lub ’tygodnie’ usunięte zostaną wszystkie starsze wiadomości niż ustalony okres czasu.',
	'MCHAT_PRUNE_NOW'								=> 'Wyczyść wiadomości teraz',
	'MCHAT_PRUNE_NOW_CONFIRM'						=> 'Potwierdź czyszczenie wiadomości',
	'MCHAT_PRUNED'									=> '%1$d wiadomości zostało wyczyszczonych',
	'MCHAT_NAVBAR_LINK_COUNT'						=> 'Wyświetla liczbę aktywnych sesji czatu w linku na pasku nawigacyjnym',
	'MCHAT_MESSAGE_NUM_CUSTOM'						=> 'Początkowa liczba wiadomości do wyświetlenia na stronie mChat',
	'MCHAT_MESSAGE_NUM_CUSTOM_EXPLAIN'				=> '<em>Wartość musi się zawierać w przedziale od 5 do 50. Domyślną wartością jest 10.</em>',
	'MCHAT_MESSAGE_NUM_INDEX'						=> 'Początkowa liczba wiadomości do wyświetlenia na stronie głównej forum',
	'MCHAT_MESSAGE_NUM_INDEX_EXPLAIN'				=> '<em>Wartość musi się zawierać w przedziale od 5 do 50. Domyślną wartością jest 10.</em>',
	'MCHAT_MESSAGE_NUM_ARCHIVE'						=> 'Liczba wiadomości do wyświetlenia na stronie w archiwum',
	'MCHAT_MESSAGE_NUM_ARCHIVE_EXPLAIN'				=> 'Maksymalna liczba wiadomości, które będą pokazywane na jednej stronie w archiwum.<br><em>Wartość musi się zawierać w przedziale od 10 do 100. Domyślną wartością jest 25.</em>',
	'MCHAT_ARCHIVE_SORT'							=> 'Sortowanie wiadomości',
	'MCHAT_ARCHIVE_SORT_TOP_BOTTOM'					=> 'Sortuj od najstarszych do najnowszych',
	'MCHAT_ARCHIVE_SORT_BOTTOM_TOP'					=> 'Sortuj od najnowszych do najstarszych',
	'MCHAT_ARCHIVE_SORT_USER'						=> 'Sortuj wiadomości w zależności od indywidualnych ustawień użytkownika',
	'MCHAT_FLOOD_TIME'								=> 'Odstęp czasowy pomiędzy wysyłanymi wiadomościami',
	'MCHAT_FLOOD_TIME_EXPLAIN'						=> 'Liczba sekund, które musi użytkownik odczekać zanim będzie mógł ponownie wysłać następną wiadomość.<br><em>Wartość musi się zawierać w przedziale od 0 do 60 sekund. Domyślną wartością jest 0. Ustaw 0, aby wyłączyć opcję.</em>',
	'MCHAT_EDIT_DELETE_LIMIT'						=> 'Limit czasu na edytowanie i usuwanie wiadomości',
	'MCHAT_EDIT_DELETE_LIMIT_EXPLAIN'				=> 'Wiadomości, które są starsze niż określona tutaj liczba sekund, nie mogą być ani edytowane, ani usuwane przez autora.<br>Użytkownicy, którzy mają nadane <em>uprawnienia do edycji/usuwania wiadomości (np. moderatorzy)</em> nie są objęci tym limitem.<br>Ustaw 0, aby zezwolić na nielimitowane w czasie edytowanie i usuwanie wiadomości.',
	'MCHAT_MAX_MESSAGE_LENGTH'						=> 'Maksymalna długość wiadomości',
	'MCHAT_MAX_MESSAGE_LENGTH_EXPLAIN'				=> 'Maksymalna liczba znaków, jakie są zezwolone do użycia w jednej wiadomości.<br><em>Wartość musi się zawierać w przedziale od 0 do 1000. Domyślną wartością jest 500. Ustaw 0, aby wyłączyć opcję.</em>',
	'MCHAT_MAX_INPUT_HEIGHT'						=> 'Maksymalna wysokość pola wiadomości',
	'MCHAT_MAX_INPUT_HEIGHT_EXPLAIN'				=> 'Pole do wprowadzenia wiadomości nie będzie mogło być wyższe niż określona tutaj wartość w pikselach.<br><em>Wartość musi się zawierać w przedziale od 0 do 1000. Domyślną wartością jest 150. Ustaw 0, aby wyłączyć opcję.</em>',
	'MCHAT_CUSTOM_PAGE'								=> 'Włącz stronę mChat',
	'MCHAT_CUSTOM_HEIGHT'							=> 'Wysokość strony mChat',
	'MCHAT_CUSTOM_HEIGHT_EXPLAIN'					=> 'Wysokość okna z czatem na stronie mChat.<br><em>Wartość musi się zawierać w przedziale od 50 do 1000. Domyślną wartością jest 350.</em>',
	'MCHAT_BBCODES_DISALLOWED'						=> 'Zabronione znaczniki BBCode',
	'MCHAT_BBCODES_DISALLOWED_EXPLAIN'				=> 'Możesz tutaj wprowadzić znaczniki BBCode, które <strong>nie</strong> będą mogły być użyte w wiadomościach.<br>Kolejne znaczniki oddziel znakiem pionowej kreski (|), np.<br>b|i|u|code|list|list=|flash|quote i/lub %1$własny_znacznik_bbcode%2$s',
	'MCHAT_STATIC_MESSAGE'							=> 'Wiadomość zawsze widoczna na czacie',
	'MCHAT_STATIC_MESSAGE_EXPLAIN'					=> 'Tutaj możesz wprowadzić wiadomość, która będzie wyświetlana wszystkim użytkownikom czatu. Kod HTML jest dozwolony. Pozostaw to pole puste, aby wyłączyć opcję.<br>Wiadomość może być przetłumaczone na inne języki: edytuj zmienną MCHAT_STATIC_MESSAGE w pliku /ext/dmzx/mchat/language/XX/mchat.php.',
	'MCHAT_TIMEOUT'									=> 'Czas trwania sesji czatu',
	'MCHAT_TIMEOUT_EXPLAIN'							=> 'Ustaw liczbę sekund, na którą jest ustawiana sesja czatu.<br>Ustaw 0, aby sesja trwała nieskończoność. Uważaj, sesja wymagana na odczytywanie wiadomości nigdy nie wyagasa!<br><em>Jesteś ograniczony %1$sustawieniami forum dla sesji%2$s, które obecnie są ustawione na %3$d sekund</em>',
	'MCHAT_OVERRIDE_SMILIE_LIMIT'					=> 'Nadpisz limit możliwych uśmieszków w wiadomości',
	'MCHAT_OVERRIDE_SMILIE_LIMIT_EXPLAIN'			=> 'Ustaw tak, jeśli chcesz nadpisać globalne ustawienia dla forum w ilości uśmieszków w postach dla wiadomości czatu',
	'MCHAT_OVERRIDE_MIN_POST_CHARS'					=> 'Nadpisz minimalną liczbę znaków',
	'MCHAT_OVERRIDE_MIN_POST_CHARS_EXPLAIN'			=> 'Ustaw tak, jeśli chcesz nadpisać globalne ustawienia dla forum w ilości znaków w postach dla wiadomości czatu',
	'MCHAT_LOG_ENABLED'								=> 'Dodawaj wpisy do dziennika aktywności',
	'MCHAT_LOG_ENABLED_EXPLAIN'						=> 'Akcje takie edytowanie, usuwanie, czyszczenie czy usuwanie wszystkich wiadomości będą odnotowywane w dzienniku aktywności.',

	'MCHAT_POSTS_AUTH_CHECK'						=> 'Wymagaj zezwolenia dla użytkownika',
	'MCHAT_POSTS_AUTH_CHECK_EXPLAIN'				=> 'Gdy ustawienie jest na tak, użytkownicy, którzy nie mogą korzystać z mChat, nie będą generowali żadnych wiadomości-powiadomień o napisaniu nowego posta czy zalogowaniu się.',

	'MCHAT_WHOIS_REFRESH'							=> 'Odstęp czasowy dla sekcji Kto czatuje',
	'MCHAT_WHOIS_REFRESH_EXPLAIN'					=> 'Liczba sekund, co ile sekcja Kto czatuje odświeża się.<br><em>Wartość musi zawierać się w przedziale od 10 do 300 sekund. Domyślną wartością jest 60 sekund.</em>',
	'MCHAT_SOUND'									=> 'Odtwarzaj dźwięk dla nowych, edytowanych i usuniętych wiadomości',
	'MCHAT_PURGE'									=> 'Usuń wszystkie wiadomości teraz',
	'MCHAT_PURGE_CONFIRM'							=> 'Potwierdź usunięcie wszystkich wiadomości teraz',
	'MCHAT_PURGED'									=> 'Wszystkie wiadomości w mChat zostały pomyślnie usunięte',

	// '%1$s' contains 'Retain posts' and 'Delete posts' respectively
	'MCHAT_RETAIN_MESSAGES'							=> '%1$s i zachował wiadomości mChat',
	'MCHAT_DELETE_MESSAGES'							=> '%1$s i usunął wiadomości mChat',

	// Error reporting
	'TOO_LONG_MCHAT_BBCODE_DISALLOWED'				=> 'Wartość zabrodnionych znaczników BBCode jest za długa.',
	'TOO_SMALL_MCHAT_CUSTOM_HEIGHT'					=> 'Wartość wysokości strony mChat jest za mała.',
	'TOO_LARGE_MCHAT_CUSTOM_HEIGHT'					=> 'Wartość wysokości strony mChat jest za duża.',
	'TOO_LONG_MCHAT_DATE'							=> 'Wartość formatu daty, jaką wprowdzono, jest za długa.',
	'TOO_SHORT_MCHAT_DATE'							=> 'Wartość formatu daty, jaką wprowdzono, jest za krótka.',
	'TOO_LARGE_MCHAT_FLOOD_TIME'					=> 'Wartość odstępu czasowego pomiędzy wysyłanymi wiadomości jest za duża.',
	'TOO_SMALL_MCHAT_INDEX_HEIGHT'					=> 'Wartość wysokości czatu na stronie głównej forum jest za mała.',
	'TOO_LARGE_MCHAT_INDEX_HEIGHT'					=> 'Wartość wysokości czatu na stronie głównej forum jest za duża.',
	'TOO_LARGE_MCHAT_MAX_MESSAGE_LNGTH'				=> 'Wartość długości maksymalnej wiadomości jest za duża.',
	'TOO_LARGE_MCHAT_MAX_INPUT_HEIGHT'				=> 'Wartość maksymalnej wysokości pola do wprowadzenia wiadomości jest za duża.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_CUSTOM'			=> 'Liczba wiadomości wyświetlanych na stronie mChat jest za mała.',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_CUSTOM'			=> 'Liczba wiadomości wyświetlanych na stronie mChat jest za duża.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_INDEX'				=> 'Liczba wiadomości wyświetlanych na stronie głównej forum jest za mała.',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_INDEX'				=> 'Liczba wiadomości wyświetlanych na stronie głównej forum jest za duża.',
	'TOO_SMALL_MCHAT_MESSAGE_NUM_ARCHIVE'			=> 'Liczba wiadomości wyświetlanych na stronie archiwum mChat jest za mała.',
	'TOO_LARGE_MCHAT_MESSAGE_NUM_ARCHIVE'			=> 'Liczba wiadomości wyświetlanych na stronie archiwum mChat jest za duża.',
	'TOO_SMALL_MCHAT_REFRESH'						=> 'Wartość odświeżania jest za mała.',
	'TOO_LARGE_MCHAT_REFRESH'						=> 'Wartość odświeżania jest za duża.',
	'TOO_SMALL_MCHAT_TIMEOUT'						=> 'Wartość długości sesji użytkownika jest za mała.',
	'TOO_LARGE_MCHAT_TIMEOUT'						=> 'Wartość długości sesji użytkownika jest za duża.',
	'TOO_SMALL_MCHAT_WHOIS_REFRESH'					=> 'Wartość odświeżania informacji WHOIS jest za mała.',
	'TOO_LARGE_MCHAT_WHOIS_REFRESH'					=> 'Wartość odświeżania informacji WHOIS jest za duża.',

	'MCHAT_30X_REMNANTS'							=> 'Instalacja została przerwana.<br>Znajdują się pewne pozostałe moduły po rozszerzeniu mChat dla phpBB 3.0.x w bazie danych. Rozszerzenie mChat nie będzie działało poprawnie z tymi modułami.<br>Musisz całkowicie usunąć rozszerzenie mChat przed ponowną instalacją. Konkretnie, moduły z następującymi identyfikatorami muszą być usunięte z %1$stabeli bazy danych: %2$s',
]);
