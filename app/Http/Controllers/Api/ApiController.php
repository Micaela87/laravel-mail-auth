<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Categories;
use App\Models\Tags;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getUser() {
        return Auth::guard('api')->user();
    }

    public function getAllPosts() {
        $allPosts = Posts::all();

        return response()->json(['data' => $allPosts]);
    }

    public function getAllCategories() {
        $allCategories = Categories::all();

        return response()->json(['data' => $allCategories]);
    }

    public function deletePost($id) {

        $postToDelete = Posts::findOrFail($id);

        $postToDelete -> tags() -> sync([]);

        $postToDelete -> save();

        $postToDelete -> delete();

        return response()->json(['data' => Posts::all()]);
    }

    public function getSinglePost($id) {

        $singlePost = Posts::findOrFail($id);

        return response()->json(['data' => $singlePost]);
    }

    public function getPostCategory($id) {
        $singleCategory = Categories::findOrFail($id);

        return response()->json(['data' => $singleCategory]);
    }

    public function storeNewPost(Request $request) {

        $data = $request -> validate([
            'title' => 'required|unique:posts|max:255',
            'author' => 'required|max:255',
            'content' => 'required',
            'release_date' => 'required|date',
            'rating' => 'max:5|min:0'
        ]);

        $category = Categories::findOrFail($request -> category_id);

        $newPost = Posts::make($data);

        $newPost -> category() -> associate($category);

        $newPost -> save();

        $tags = Tags::findOrFail($request -> tags);

        $newPost -> tags() -> attach($tags);

        $newPost -> save();

        return response('ok', 200);
    }

    public function updatePost(Request $request, $id) {
        $data = $request -> validate([
            'title' => 'required|max:255|unique:posts,title,' . $id,
            'author' => 'required|max:255',
            'content' => 'required',
            'release_date' => 'required|date',
            'rating' => 'max:5|min:0'
        ]);

        $category = Categories::findOrFail($request -> category_id);

        $updatedtPost = Posts::findOrFail($id);

        $updatedtPost -> category() -> associate($category);

        $updatedtPost -> save();

        $tags = Tags::findOrFail($request['tags']);

        $updatedtPost -> tags() -> attach($tags);

        $updatedtPost -> update($data);

        return response('ok', 200);

    }

    public function getAllTags() {

        $allTags = Tags::all();

        return response() -> json(['data' => $allTags]);
    }

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
