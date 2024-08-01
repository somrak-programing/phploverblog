<?php

/**
 * For The Date
 */
function formatDate($date){
    return date('d/m/Y H:i', strtotime($date));
}

function shortenText($text, $chars = 450) {
    $text = $text. " ";
    $text = substr($text, 0, $chars);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text. "...";
    return $text;
}