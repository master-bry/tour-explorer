<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Authorization\GroupModel;

class MythAuthSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // First, let's manually insert the groups to avoid validation issues
        $groups = [
            [
                'name' => 'admin',
                'description' => 'Administrators with full access'
            ],
            [
                'name' => 'user',
                'description' => 'Regular users'
            ]
        ];
        
        $db->table('auth_groups')->insertBatch($groups);
        echo "✓ Groups created successfully\n";

        // Now create users using the UserModel but with proper data
        $userModel = new UserModel();
        
        // Create admin user with proper structure
        $adminData = [
            'email' => 'admin@tourexplorer.com',
            'username' => 'admin',
            'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Insert admin user directly to avoid validation
        $db->table('users')->insert($adminData);
        $adminId = $db->insertID();
        echo "✓ Admin user created (ID: $adminId)\n";

        // Add admin to admin group
        $db->table('auth_groups_users')->insert([
            'group_id' => 1, // admin group
            'user_id' => $adminId
        ]);
        echo "✓ Admin added to admin group\n";

        // Create regular user
        $userData = [
            'email' => 'user@tourexplorer.com',
            'username' => 'user',
            'password_hash' => password_hash('user123', PASSWORD_DEFAULT),
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $db->table('users')->insert($userData);
        $userId = $db->insertID();
        echo "✓ Regular user created (ID: $userId)\n";

        // Add user to user group
        $db->table('auth_groups_users')->insert([
            'group_id' => 2, // user group
            'user_id' => $userId
        ]);
        echo "✓ User added to user group\n";

        echo "\n✅ Myth:Auth seeded successfully!\n";
        echo "📧 Admin login: admin@tourexplorer.com / admin123\n";
        echo "👤 User login: user@tourexplorer.com / user123\n";
    }
}