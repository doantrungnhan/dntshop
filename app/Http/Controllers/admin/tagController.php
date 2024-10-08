<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;


use Illuminate\Http\Request;

class tagController extends Controller
{
    public function tag()
    {
        $tags = Tag::orderBy('tagID', 'desc')->get();
        return view('admin.tags.tag', compact('tags'));
    }
    public function create()
    {
        return view('admin.tags.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $slug = Slug($request->name);
        Tag::create([
            'tag_name' => $request->name,
            'slug' => $slug,
        ]);
        return redirect()->route('tag')->with('success', 'Thêm tag thành công!');
    }
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.tags.update', compact('tag'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $slug = Slug($request->name);
        $tag = Tag::findOrFail($id);
        $tag->tag_name = $request->name;
        $tag->slug = $slug;
        $tag->save();
        return redirect()->route('tag')->with('success', 'Cập nhật tag thành công!');
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return redirect()->route('tag')->with('success', 'Xoá tag thành công!');
    }
}
