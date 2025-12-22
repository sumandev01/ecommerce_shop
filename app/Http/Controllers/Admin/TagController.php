<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::latest('id')->get();
        return view('admin.tag.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tag' => 'required|string|max:255|unique:tags,name',
        ]);

        Tag::create([
            'name' => $request->tag,
        ]);

        return to_route('tag.index')->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'tag' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);

        $tag->update([
            'name' => $request->tag,
        ]);

        return to_route('tag.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return to_route('tag.index')->with('success', 'Tag deleted successfully.');
    }
}
