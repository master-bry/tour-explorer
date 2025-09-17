<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TourExplorerSeeder extends Seeder
{
    public function run()
    {
        // Seed tours
        $tours = [
            ['title' => 'Serengeti Safari', 'category' => 'Safari', 'description' => 'Wildlife adventure in Serengeti.', 'price' => 2500.00, 'itinerary' => 'Day 1: Arrival...', 'image' => 'serengeti.jpg'],
            ['title' => 'Kilimanjaro Climb', 'category' => 'Kilimanjaro', 'description' => 'Summit the roof of Africa.', 'price' => 4500.00, 'itinerary' => '7-day Machame route...', 'image' => 'kilimanjaro.jpg'],
        ];
        $this->db->table('tours')->insertBatch($tours);

        // Seed reviews
        $reviews = [
            ['name' => 'Island H', 'review_text' => 'Amazing safari experience!', 'rating' => 5, 'date' => '2025-09-01'],
            ['name' => 'Sarah B', 'review_text' => 'Successful Kilimanjaro climb.', 'rating' => 5, 'date' => '2025-09-10'],
        ];
        $this->db->table('reviews')->insertBatch($reviews);

        // Seed admin user
        $this->db->table('users')->insert(['username' => 'admin', 'email' => 'admin@test.com', 'password' => password_hash('admin123', PASSWORD_DEFAULT), 'role' => 'admin']);
    }
}