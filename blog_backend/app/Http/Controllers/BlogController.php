<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index() {
        $blogs = Blog::orderBy('created_at', 'DESC') ->get();

        return response()->json([
            'status' => true,
            'data' => $blogs
        ]);
    }

    public function show() {}

    public function store(Request $request) {
        $validator = Validator::make($request->all,[
            'blogTitle' => 'required|min:10',
            'author' => 'required|min:3'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fix the error first',
                'errors' => $validator->errors()
            ]);
        }

        $blog = new Blog();
        $blog ->blogTitle = $request->blogTitle;
        $blog ->author = $request->author;
        $blog ->description = $request->description;
        $blog ->shortDesc = $request->shortDesc;
        $blog ->save();

        return response()->json([
            'status' => true,
            'message' => 'Blog added successfully',
            'data' => $blog
        ]);
    }

    public function update() {}

    public function destroy() {}

}
