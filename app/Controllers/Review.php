<?php

namespace App\Controllers;

use App\Models\ReviewModel;
use CodeIgniter\Controller;

class Review extends Controller
{
    public function index()
    {
        $reviewModel = new ReviewModel();
        
        $data = [
            'title' => 'Customer Reviews - Tour Explorer Tz',
            'reviews' => $reviewModel->orderBy('created_at', 'DESC')->findAll()
        ];

        return view('reviews', $data);
    }
}