<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index() 
    {
        $data = Category::latest()->paginate(5);
        return new DataResource(true, 'All data displayed successfully', $data);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = Category::create([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return new DataResource(true, 'Data added successfully', $data);
    }
    public function show(string $id) 
    {
        $data = Category::find($id);
        return new DataResource(true, 'Data show successfully', $data);
    }
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required'
        ]);

        $data = Category::find($id);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data->update([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return new DataResource(true, 'Data udpated successfully', $data);
    }
    public function destroy(string $id) 
    {
        $data = Category::find($id);
        $data->delete();
        return new DataResource(true, 'Data deleted successfully', $data);
    }
}
