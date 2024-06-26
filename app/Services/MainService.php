<?php

namespace App\Services;

use App\Models\Master;
use App\Models\Review;
use App\Models\Work;

class MainService
{
    /**
     * Create a new class instance.
     */
    public function index()
    {
        $reviews = Review::with('master')->get();
        $masters = Master::with('companies')->get();
        $service = Work::all();

        return   [
            "reviews" => $reviews,
            "masters" => $masters,
            "service" => $service
        ];

    }

    public function services()
    {
        $review = Review::all();
        $master = Master::all();
        $service = Work::all();
        return  [
            'review' => $review,
            'master' => $master,
            'service' => $service
        ];
    }


}
