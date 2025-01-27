<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug|regex:/^[a-z0-9-]+$/',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->slug);
        
        if ($request->hasFile('image')) {
            // Store the image and return its path
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $blog->id . '|regex:/^[a-z0-9-]+$/',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->slug);
        if ($request->hasFile('image')) {
            // Store the image and return its path
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function changeStatus(Blog $blog, Request $request)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        $blog->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog status updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
    public function blog(Request $request)
    {
        $blogs = Blog::with('category')->latest()->paginate(10);
        return view('front.blogs.blog', compact('blogs'));
    }

    public function blogdetails($id)
    {
        $latestBlogs = Blog::latest()->take(5)->get();
        $categories = Category::all();
        $blog = Blog::where('id', $id)->orWhere('slug', $id)->firstOrFail();

        return view('front.blogs.blog-details', compact('blog','latestBlogs','categories'));
    }
}
