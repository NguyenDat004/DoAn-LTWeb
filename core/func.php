<?php
function checkcode($input) {
    $lowercase = strtolower($input);
    $noSpecialChars = preg_replace('/[^a-z0-9\s]/', '', $lowercase);
    $noSpaces = str_replace(' ', '', $noSpecialChars);
    return $noSpaces;
}
?>
