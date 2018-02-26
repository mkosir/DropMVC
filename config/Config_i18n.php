<?php
//clearstatcache();

// Set language
$locale = "en_US.UTF-8";
//$locale = "sl_SI.UTF-8";
// Set language on Windows
//$locale = "English_United States.1252";
//$locale = "Slovenian_Slovenia.1250";

// Set domain
$domain = "messages";
// Set codeset
$codeset = "UTF-8";

//setlocale(LC_ALL, $locale);

// Debug
//echo setlocale(LC_ALL, $locale) ? "true" : "false";

// Debug
// Set both version of locals and see which one comes trough
//if ($newLocale = setLocale(LC_CTYPE, 'ru_RU.UTF-8', 'Russian_Russia.1251'))
//{
//    echo 'Locale is now set to: ' . $newLocale;
//} else {
//    echo 'Locale not found.';
//}

// Specify location of translation tables
bindtextdomain("messages", "../locale");
// Choose domain
textdomain("messages");
// Indicates in what encoding the file should be read
bind_textdomain_codeset("messages", $codeset);