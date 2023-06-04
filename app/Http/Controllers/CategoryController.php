<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(): View
    {
        $data = Category::all();
        return view('categories.index', compact('data'));
    }
    public function create(): View
    {
        return view('categories.create');
    }
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'user_id' => 'required'
        ]);

        $data = Category::create([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        if($data) {
            return redirect()->route('categories.index')->with(['success'=>'Data berhasil ditambahkan']);
        }else {
            return redirect()->route('articles.index')->with(['errors'=>'Data gagal ditambahkan']);
        }
    }
    public function edit(string $id): View
    {
        $data = Category::findOrFail($id);
        return view('categories.edit', compact('data'));
    }
    public function update(Request $request, string $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'user_id' => 'required'
        ]);

        $data = Category::findOrFail($id);

        $data->update([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('categories.index')->with(['success'=>'Data berhasil diubah']);
    }
    public function show(string $id): View
    {
        $data = Category::findOrFail($id);
        return view('categories.show', compact('data'));
    }
    public function destroy(string $id): RedirectResponse 
    {
        $data = Category::findOrFail($id);
        $data->delete();

        return redirect()->route('categories.index')->with(['success'=>'Data berhasil dihapus']);
    }
}
