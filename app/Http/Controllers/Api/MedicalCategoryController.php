<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\MedicalCategory;
use App\Http\Controllers\Controller;

use App\Http\Resources\MedicalCategoryCollection;

use Symfony\Component\HttpFoundation\Response;

class MedicalCategoryController extends Controller
{
    /**
     * Get all medical categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $medicalCategories = MedicalCategory::all();
        return response()->json(new MedicalCategoryCollection($medicalCategories), Response::HTTP_OK);
    }
}
