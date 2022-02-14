<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\Categories;
use App\Models\Tags;
use Illuminate\Support\Facades\DB;

// handles requests to tags db table

class TagsController extends Controller
{
    // gets all tags

    public function getAllTags() {

        $allTags = Tags::all();

        return response() -> json(['data' => $allTags]);
    }

    // gets tags related to a single post

    public function getTagsPerPost($id) {
        $tags = DB::table('posts_tags') -> where('posts_id', $id) -> get();

        $tagIdList = [];

        for ($i = 0; $i < count($tags); $i++) {
            $tagIdList[$i] = $tags[$i] -> tags_id;
        }

        $tagNameList = Tags::findOrfail($tagIdList);

        return response() -> json(['data' => $tagNameList]);
    }
}
