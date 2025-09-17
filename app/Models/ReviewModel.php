<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'review_text', 'rating', 'date'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}