<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){

        $data = [
            'title' => 'Kategori',
            'category' => Category::all()->sortBy('DESC')
        ];

        return view('admin.category.index', $data);
    }

    public function create(){

        $data = [
            'title' => 'Buat Kategori'
        ];

        return view('admin.category.create', $data);
    }

    public function check(Request $request){
        $name = Category::where('name', $request->name)->exists();
        if($name){
            return response()->json(['status' => 'success', 'messages' => 'not available'], 200);
        }else{
            return response()->json(['status' => 'success', 'messages' => 'available'], 201);
        }
    }

    public function save(Request $request){
        $validators = Validator::make($request->all(), [
            'path' => 'required',
            'name' => 'required|unique:categories',
        ]);

        if($validators->fails()){
            return redirect()->route('categoryCreate')->withErrors($validators)->withInput();
        }else{
            $path = $request->file('path');
            $extension_path = $path->getClientOriginalExtension();
            $full_name_path = Str::random(20).".".$extension_path;
            $path->move(public_path('shop/products/'), $full_name_path);

            Category::create([
                'shop_id' => Auth::user()->shop->id,
                'name' => $request->name,
                'path' => $full_name_path
            ]);

            return redirect()->route('category');

        }
    }

    public function delete($id, $path){
        $paths = public_path().'/shop/products/'. $path;
        if(file_exists($paths)){
            unlink($paths);
        }

        Category::destroy($id);

        return redirect()->route('category')->with('success', 'Category deleted');
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        
        $data = [
            'title' => 'Edit category',
            'category' => $category
        ];

        return view('admin.category.edit', $data);
    }

    public function update(Request $request, $id){
        $category = Category::findOrFail($id);
        
        $rules = [
            'name' => 'required|unique:categories,name,'.$id,
        ];

        if($request->hasFile('path')){
            $rules['path'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        }

        $validators = Validator::make($request->all(), $rules);

        if($validators->fails()){
            return redirect()->route('categoryEdit', $id)->withErrors($validators)->withInput();
        }

        $category->name = $request->name;

        if($request->hasFile('path')){
            // Delete old image
            $old_path = public_path().'/shop/products/'. $category->path;
            if(file_exists($old_path)){
                unlink($old_path);
            }

            // Upload new image
            $path = $request->file('path');
            $extension_path = $path->getClientOriginalExtension();
            $full_name_path = Str::random(20).".".$extension_path;
            $path->move(public_path('shop/products/'), $full_name_path);
            
            $category->path = $full_name_path;
        }

        $category->save();

        return redirect()->route('category')->with('success', 'Category updated successfully');
    }
}
