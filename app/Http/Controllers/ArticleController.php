<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(): View
    {
        $data = Article::all();
        return view('articles.index', compact('data'));
    }
    public function create(): View 
    {
        return view('articles.create');
    }
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'image',
            'user_id' => 'required',
            'category_id' => 'required'
        ]);

        $imageName = $request->image->getClientOriginalName();
        $request->image->move(public_path('/storage/articles'), $imageName);

        $data = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id
        ]);

        if($data) {
            return redirect()->route('articles.index')->with(['success'=>'Data berhasil ditambahkan']);
        }else {
            return redirect()->route('articles.index')->with(['errors'=>'Data gagal ditambahkan']);
        }
    }
    public function edit(string $id): View 
    {
        $data = Article::findOrFail($id);
        return view('articles.edit', compact('data'));
    }
    public function update(Request $request, string $id): RedirectResponse 
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'image',
            'user_id' => 'required',
            'category_id' => 'required'
        ]);

        $data = Article::findOrFail($id);

        if($request->has('image')) {
            $imageName = $request->image->getClientOriginalName();
            $request->image->move(public_path('/storage/articles'), $imageName);

            Storage::delete('public/articles/'.basename($data->image));
            
            $data->update([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imageName,
                'user_id' => $request->user_id,
                'category_id' => $request->category_id
            ]);
        }else {
            $data->update([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => $request->user_id,
                'category_id' => $request->category_id
            ]);
        }

        return redirect()->route('articles.index')->with(['success'=>'Data berhasil diubah']);
    }
    public function show(string $id): View 
    {
        $data = Article::findOrFail($id);
        return view('articles.show', compact('data'));
    }
    public function destroy(string $id): RedirectResponse 
    {
        $data = Article::findOrFail($id);
        Storage::delete('public/articles/'.basename($data->image));
        $data->delete();

        return redirect()->route('articles.index')->with(['success'=>'Data berhasil dihapus']);
    }
}
