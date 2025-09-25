<?php

namespace App\Controllers;

class DebugAuth extends BaseController
{
    public function index()
    {
        $db = db_connect();
        
        echo "<h1>Database Debug Info</h1>";
        
        // Check users table
        echo "<h2>Users Table</h2>";
        try {
            $users = $db->table('users')->get()->getResultArray();
            echo "<pre>" . print_r($users, true) . "</pre>";
        } catch (\Exception $e) {
            echo "Error reading users table: " . $e->getMessage();
        }
        
        // Check groups table
        echo "<h2>Auth Groups Table</h2>";
        try {
            $groups = $db->table('auth_groups')->get()->getResultArray();
            echo "<pre>" . print_r($groups, true) . "</pre>";
        } catch (\Exception $e) {
            echo "Error reading auth_groups table: " . $e->getMessage();
        }
        
        // Check group assignments
        echo "<h2>Group Assignments</h2>";
        try {
            $assignments = $db->table('auth_groups_users')->get()->getResultArray();
            echo "<pre>" . print_r($assignments, true) . "</pre>";
        } catch (\Exception $e) {
            echo "Error reading auth_groups_users table: " . $e->getMessage();
        }
        
        // Check session configuration
        echo "<h2>Session Data</h2>";
        echo "<pre>" . print_r(session()->get(), true) . "</pre>";
    }
}