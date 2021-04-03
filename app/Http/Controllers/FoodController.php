<?php

namespace App\Http\Controllers;

use App\Repositories\FoodRepositoryInterface;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    private $repository;

    public function __construct(FoodRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index() {
        $data = $this->repository->getAll();
        dd($data);
    }
}
