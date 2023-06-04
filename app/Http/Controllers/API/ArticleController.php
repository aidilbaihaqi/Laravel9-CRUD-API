<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index() 
    {
        $data = Article::latest()->paginate(5);
        return new DataResource(true, 'All data displayed successfully', $data);
    }
    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'image' => 'required',
            'user_id' => 'required',
            'category_id' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $imageName = $request->image->getClientOriginalName();
        $request->image->move(public_path('storage/articles/'), $imageName);

        $data  = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id
        ]);

        return new DataResource(true, 'Data added successfully', $data);
    }
    public function show(string $id)
    {
        $data = Article::find($id);
        return new DataResource(true, 'Data show successfully', $data);
    }
    public function update(Request $request, string $id) 
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'image' => 'required',
            'user_id' => 'required',
            'category_id' => 'required'
        ]);

        $data = Article::find($id);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if($request->has('image')) {
            $imageName = $request->image->getClientOriginalName();
            $request->image->move(public_path('storage/articles/'), $imageName);

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

        return new DataResource(true, 'Data changed successfully', $data);
    }
    public function destroy(string $id)
    {
        $data = Article::find($id);
        Storage::delete('public/articles/'.basename($data->image));
        $data->delete();

        return new DataResource(true, 'Data deleted successfully', $data);

    }
    
}
