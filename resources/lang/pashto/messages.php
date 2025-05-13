<?php

// Return the translations from the main language file
$translations = include __DIR__ . '/../pashto.php';

// Ensure we're returning an array
if (!is_array($translations)) {
    return [];
}

return $translations;
