<?php

if (!function_exists('character_limiter')) {
    function character_limiter($str, $n = 500, $end_char = '...')
    {
        if (strlen($str) < $n) {
            return $str;
        }
        
        $str = preg_replace('/\s+/', ' ', str_replace(["\r\n", "\r", "\n"], ' ', $str));
        
        if (strlen($str) <= $n) {
            return $str;
        }
        
        $out = substr($str, 0, $n);
        if ($str[$n - 1] != ' ') {
            $out = substr($out, 0, strrpos($out, ' '));
        }
        
        return $out . $end_char;
    }
}

if (!function_exists('word_limiter')) {
    function word_limiter($str, $limit = 100, $end_char = '...')
    {
        if (trim($str) === '') {
            return $str;
        }
        
        preg_match('/^\s*+(?:\S++\s*+){1,' . (int) $limit . '}/', $str, $matches);
        
        if (strlen($str) === strlen($matches[0])) {
            $end_char = '';
        }
        
        return rtrim($matches[0]) . $end_char;
    }
}