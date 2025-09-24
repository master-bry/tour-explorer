<?php

namespace App\Models;

use CodeIgniter\Model;

class TourModel extends Model
{
    protected $table = 'tours';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'category', 'description', 'price', 'itinerary', 'image', 'duration', 'max_people'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Get tours with filtering and pagination
    public function getTours($category = null, $search = null, $limit = null, $offset = 0)
    {
        $builder = $this->builder();
        
        if ($category && $category !== 'All') {
            $builder->where('category', $category);
        }
        
        if ($search) {
            $builder->groupStart()
                    ->like('title', $search)
                    ->orLike('description', $search)
                    ->orLike('itinerary', $search)
                    ->groupEnd();
        }
        
        $builder->orderBy('created_at', 'DESC');
        
        if ($limit) {
            $builder->limit($limit, $offset);
        }
        
        return $builder->get()->getResultArray();
    }

    // Get featured tours (for homepage)
    public function getFeaturedTours($limit = 6)
    {
        return $this->orderBy('created_at', 'DESC')
                   ->limit($limit)
                   ->findAll();
    }

    // Get tours by category
    public function getToursByCategory($category, $limit = null)
    {
        $builder = $this->where('category', $category)
                       ->orderBy('created_at', 'DESC');
        
        if ($limit) {
            $builder->limit($limit);
        }
        
        return $builder->findAll();
    }

    // Search tours
    public function searchTours($keyword)
    {
        return $this->groupStart()
                   ->like('title', $keyword)
                   ->orLike('description', $keyword)
                   ->orLike('itinerary', $keyword)
                   ->groupEnd()
                   ->orderBy('created_at', 'DESC')
                   ->findAll();
    }
}