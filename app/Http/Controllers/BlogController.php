<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('user')->latest()->get();
        return response()->json($blogs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $blog = Auth::user()->blogs()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json($blog, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::with('user')->find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        return response()->json($blog);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$blog) {
            return response()->json(['message' => 'Blog not found or unauthorized.'], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Blog updated successfully.', 'blog' => $blog]);
    }

    public function myBlogs(Request $request)
    {
        $user = $request->user(); // Authenticated user
        $blogs = Blog::where('user_id', $user->id)->latest()->get();
        return response()->json($blogs);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$blog) {
            return response()->json(['message' => 'Blog not found or unauthorized.'], 404);
        }

        $blog->delete();

        return response()->json(['message' => 'Blog deleted successfully.']);
    }
}
