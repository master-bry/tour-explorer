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

        // Basic filtering
        if ($category) {
            $tours = $tourModel->where('category', $category)->findAll();
        } else {
            $tours = $tourModel->findAll();
        }

        // Basic search
        if ($search) {
            $tours = array_filter($tours, function($tour) use ($search) {
                return stripos($tour['title'], $search) !== false || 
                       stripos($tour['description'], $search) !== false;
            });
        }

        $data = [
            'title' => 'Our Tours - Tour Explorer Tz',
            'tours' => $tours,
            'category' => $category,
            'search' => $search
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

        $data = [
            'title' => $tour['title'] . ' - Tour Explorer Tz',
            'tour' => $tour
        ];

        return view('tours/show', $data);
    }
}