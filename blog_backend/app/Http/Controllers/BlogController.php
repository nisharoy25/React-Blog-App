<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use App\Models\TempImage;

class BlogController extends Controller
{
    public function index(Request $request) {
        $blogs = Blog::orderBy('created_at', 'DESC');
        if (!empty($request->keyword)) {
            $blogs = $blogs->where('title','like','%'.$request->keyword.'%');
        }
        $blogs = $blogs->paginate(12);
        return response()->json([
            'status' => true,
            'data' => $blogs
        ]);
    }

    public function show($id) {

        $blog = Blog::find($id);

        if ($blog == null) {
            return response()->json([
                'status' => false,
                'message' => 'Blog not found',
            ]);
        }

        $blog['date'] = \Carbon\Carbon::parse($blog->created_at)->format('d M, Y');

        return response()->json([
            'status' => true,
            'data' => $blog,
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'title' => 'required|min:3',
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
        $blog->title = $request->title;
        $blog->author = $request->author;
        $blog->description = $request->description;
        $blog->shortDesc = $request->shortDesc;
        $blog->save();

         //Save Image 
         $tempImage = TempImage::find($request->image_id);

         if ($tempImage != null) {
 
             $imageExtArray = explode('.',$tempImage->name);
             $ext = last($imageExtArray);
             $imageName = time().'-'.$blog->id.'.'.$ext;
 
             $blog->image = $imageName;
             $blog->save();
 
             $sourcePath = public_path('uploads/temp/'.$tempImage->name);
             $destPath = public_path('uploads/blogs/'.$imageName);
 
             File::copy($sourcePath,$destPath);
         }

        return response()->json([
            'status' => true,
            'message' => 'Blog added successfully.',
            'data' => $blog
        ]);

    }

    // public function update($id, Request $request) {

    //     $blog = Blog::find($id);

    //     if ($blog == null) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Blog not found.',
    //         ]);
    //     } 

    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required|min:10',
    //         'author' => 'required|min:3'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Please fix the errors',
    //             'errors' => $validator->errors()
    //         ]);
    //     }

    //     $blog->title = $request->title;
    //     $blog->author = $request->author;
    //     $blog->description = $request->description;
    //     $blog->shortDesc = $request->shortDesc;
    //     $blog->save();

    //     // Save Image
    //     $tempImage = TempImage::find($request->image_id);

    //     if ($tempImage != null) {

    //         // Delete old image 
    //         File::delete(public_path('uploads/blogs/'.$blog->image));

    //         $imageExtArray = explode('.',$tempImage->name);
    //         $ext = last($imageExtArray);
    //         $imageName = time().'-'.$blog->id.'.'.$ext;

    //         $blog->image = $imageName;
    //         $blog->save();

    //         $sourcePath = public_path('uploads/temp/'.$tempImage->name);
    //         $destPath = public_path('uploads/blogs/'.$imageName);

    //         File::copy($sourcePath,$destPath);
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Blog updated successfully.',
    //         'data' => $blog
    //     ]);
    // }
    

    // public function destroy($id) {

    //     $blog = Blog::find($id);

    //     if ($blog == null) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Blog not found.',
    //         ]);
    //     }

    //     // Delete blog image first
    //     File::delete(public_path('uploads/blogs/'.$blog->image));

    //     // Delete blog from DB
    //     $blog->delete();

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Blog deleted successfully.'            
    //     ]);

    // }

}
