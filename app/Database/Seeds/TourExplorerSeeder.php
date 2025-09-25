<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TourExplorerSeeder extends Seeder
{
    public function run()
    {
        // Seed tours
        $tours = [
            [
                'title' => 'Serengeti Safari Adventure', 
                'category' => 'Safari', 
                'description' => 'Experience the great migration in Serengeti National Park with expert guides.', 
                'price' => 2500.00, 
                'itinerary' => "Day 1: Arrival and welcome at Arusha\nDay 2: Game drive in Serengeti\nDay 3: Balloon safari and cultural visit", 
                'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'duration' => 5,
                'max_people' => 8
            ],
            [
                'title' => 'Mount Kilimanjaro Climb', 
                'category' => 'Kilimanjaro', 
                'description' => 'Conquer Africa\'s highest peak with our experienced mountain guides.', 
                'price' => 4500.00, 
                'itinerary' => "Day 1: Start climb from Machame Gate\nDay 2: Hike to Shira Camp\nDay 3-6: Continue ascent\nDay 7: Summit and descend", 
                'image' => 'https://images.unsplash.com/photo-1516487106395-f3f7b15097db?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'duration' => 7,
                'max_people' => 12
            ]
        ];
        $this->db->table('tours')->insertBatch($tours);

        // Seed reviews
        $reviews = [
            [
                'name' => 'Island H', 
                'review_text' => 'Amazing safari experience! The guides were incredibly knowledgeable.', 
                'rating' => 5, 
                'date' => '2025-09-01'
            ],
            [
                'name' => 'Sarah B', 
                'review_text' => 'Successful Kilimanjaro climb thanks to the excellent support team.', 
                'rating' => 5, 
                'date' => '2025-09-10'
            ]
        ];
        $this->db->table('reviews')->insertBatch($reviews);

        echo "Tour Explorer data seeded successfully!\n";
    }
}