<?php
$module = 'mod_qlquicklink';

// generate basic parameters
$manifest_path = $module . '.xml';
$language_file_path_de = sprintf(__DIR__ . '/language/de-DE/de-DE.%s.ini', $module);
$language_file_path_de_sys = sprintf(__DIR__ . '/language/de-DE/de-DE.%s.sys.ini', $module);
$language_file_path_en = sprintf(__DIR__ . '/language/en-GB/en-GB.%s.ini', $module);
$language_file_path_en_sys = sprintf(__DIR__ . '/language/en-GB/en-GB.%s.sys.ini', $module);
$placeholder = strtoupper($module) . '_';
$manifest = file_get_contents(__DIR__ . '/'. $manifest_path);
$placesholderDescription = sprintf('%s_XML_DESCRIPTION', strtoupper($module));

// get all placeholders
$regex = sprintf('/%s([A-Z0-9_]+)/', $placeholder);
preg_match_all($regex, $manifest, $matches);
$matchesPlaceholders = array_unique($matches[0] ?? []);
sort($matchesPlaceholders);
if (isset($matchesPlaceholders[$placesholderDescription])) unset($matchesPlaceholders[$placesholderDescription]);
// prepare texts to be filled, at least roughly
array_walk($matchesPlaceholders, function (&$item) { $item .= sprintf('="%s"', strtolower(str_replace('_', ' ', $item))); });

// get fieldsets
$regex = '/\<fieldset name="([a-zA-Z0-9_]*)"/';
preg_match_all($regex, $manifest, $matches);
$matchesFieldset = array_unique($matches[1] ?? []);
sort($matchesFieldset);
// prepare texts to be filled, at least roughly
array_walk($matchesFieldset, function (&$item) {
    $item = sprintf('COM_MODULES_%s_FIELDSET_LABEL="%s"', strtoupper($item), strtolower(str_replace('_', ' ', $item)));
});

// preamble
$preamble = sprintf('; @package		%s
; @copyright	Copyright (C) %s ql.de All rights reserved.
; @author 		Mareike Riegel info@ql.de
; @license		GNU General Public License version 2 or later; see LICENSE.txt',
    $module, date('Y')
);

// title and description
$title = sprintf('%s="%s"', strtoupper($module), $module);
$description = sprintf('%s="This module"', $placesholderDescription);

// generate File
$language_file_content = $preamble;
$language_file_content .= "\n\n";
$language_file_content .= $title;
$language_file_content .= "\n";
$language_file_content .= $description;
$language_file_content .= "\n";
file_put_contents($language_file_path_en_sys, $language_file_content);
file_put_contents($language_file_path_de_sys, $language_file_content);
$language_file_content .= "\n";
$language_file_content .= implode("\n", $matchesFieldset);
$language_file_content .= "\n\n";
$language_file_content .= implode("\n", $matchesPlaceholders);
$language_file_content .= "\n";

// write files
file_put_contents($language_file_path_en, $language_file_content);
file_put_contents($language_file_path_de, $language_file_content);

echo 'language files have been generated';
