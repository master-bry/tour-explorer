<?php

namespace App\Controllers;

use App\Models\TourModel;
use CodeIgniter\Controller;

class Tour extends Controller
{
    public function index()
    {
        $tourModel = new TourModel();
        $category = $this->request->getGet('category');
        $search = $this->request->getGet('search');

        $data = [
            'tours' => $tourModel->getTours($category, $search),
            'category' => $category,
            'search' => $search,
        ];

        return view('tours/index', $data);
    }

    public function show($id)
    {
        $tourModel = new TourModel();
        $tour = $tourModel->find($id);

        if (!$tour) {
            session()->setFlashdata('error', 'Tour not found.');
            return redirect()->to('/tours');
        }

        // Get related tours (same category)
        $relatedTours = $tourModel->where('category', $tour['category'])
                                 ->where('id !=', $id)
                                 ->limit(3)
                                 ->findAll();

        $data = [
            'tour' => $tour,
            'relatedTours' => $relatedTours
        ];
        
        return view('tours/show', $data);
    }
}