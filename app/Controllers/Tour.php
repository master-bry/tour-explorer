<?php

namespace App\Controllers;

use App\Models\TourModel;
use CodeIgniter\Controller;

class Tour extends Controller
{
    public function index()
    {
        $tourModel = new TourModel();
        $category = $this->request->getGet('category') ?? null;
        $search = $this->request->getGet('search') ?? null;

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
            return redirect()->to('/tours');
        }

        $data = ['tour' => $tour];
        return view('tours/show', $data);
    }
}