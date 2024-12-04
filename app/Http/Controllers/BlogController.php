<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $blogs = Blog::latest()->get();
        return view("blogs.index", compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function create() 
    {
        return view('blogs.create');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['judul', 'isi']);
        $data['pembuat'] = Auth::user()->name;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('public/blog-images', $filename);
            $data['foto'] = $filename;
        }

        Blog::create($data);
        return redirect()->route('blogs.index')->with('success', 'Blog berhasil dibuat!');
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['judul', 'isi']);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($blog->foto) {
                Storage::delete('public/blog-images/' . $blog->foto);
            }

            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('public/blog-images', $filename);
            $data['foto'] = $filename;
        }

        $blog->update($data);
        return redirect()->route('blogs.index')->with('success', 'Blog berhasil diupdate!');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->foto) {
            Storage::delete('public/blog-images/' . $blog->foto);
        }
        
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog berhasil dihapus!');
    }
}
