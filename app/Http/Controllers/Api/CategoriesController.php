<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\Categories;
use App\Models\Tags;
use Illuminate\Support\Facades\DB;

// handles requests to categories db table

class CategoriesController extends Controller
{

    // gets all categories

    public function getAllCategories() {
        $allCategories = Categories::all();

        return response()->json(['data' => $allCategories]);
    }

    // gets category related to a single post

    public function getPostCategory($id) {
        $singleCategory = Categories::findOrFail($id);

        return response()->json(['data' => $singleCategory]);
    }

}
