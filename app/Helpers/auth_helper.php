<?php

if (!function_exists('is_admin')) {
    function is_admin() {
        return session()->get('is_admin') === true;
    }
}

if (!function_exists('require_admin')) {
    function require_admin() {
        if (!is_admin()) {
            session()->setFlashdata('error', 'Administrator access required.');
            return redirect()->to('/auth/login');
        }
    }
}