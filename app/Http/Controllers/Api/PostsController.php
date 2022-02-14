<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\Categories;
use App\Models\Tags;
use Illuminate\Support\Facades\DB;
use App\Mail\NewMail;
use Illuminate\Support\Facades\Mail;

// handles requests to posts db table

class PostsController extends Controller
{
    

    // gets all posts

    public function getAllPosts() {
        $allPosts = Posts::all();

        return response()->json(['data' => $allPosts]);
    }

    // deletes single post

    public function deletePost($id) {

        $user = Auth::user();

        $postToDelete = Posts::findOrFail($id);

        $postToDelete -> tags() -> sync([]);

        $postToDelete -> save();

        $postToDelete -> delete();

        Mail::to($user)->send(new NewMail($postToDelete));

        return response()->json(['data' => Posts::all()]);
    }

    // gets single post

    public function getSinglePost($id) {

        $singlePost = Posts::findOrFail($id);

        return response()->json(['data' => $singlePost]);
    }

    // stores new post

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

    // updates post

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
}
