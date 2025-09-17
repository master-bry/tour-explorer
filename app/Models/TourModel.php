<?php

namespace App\Models;

use CodeIgniter\Model;

class TourModel extends Model
{
    protected $table = 'tours';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'category', 'description', 'price', 'itinerary', 'image'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    // Advanced: Filter by category and search
    public function getTours($category = null, $search = null)
    {
        $builder = $this->builder();
        if ($category) {
            $builder->where('category', $category);
        }
        if ($search) {
            $builder->like('title', $search)->orLike('description', $search);
        }
        return $builder->get()->getResultArray();
    }
}