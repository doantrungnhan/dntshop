<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class categoriesController extends Controller
{
    public function categories(){
        $categories = Categories::all();
        return view('admin.categories.list',compact('categories'));
    }
    public function categories_add(){
        return view('admin.categories.add');
    }
    public function categories_store(Request $request){
        $request->validate([
            'category_name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:2048']);

            $data=[
                'category_name'=>$request['category_name'],
                'slug'=>Slug($request['category_name']),
                'description'=>$request['description'],
                'image'=>$request['image']
            ];

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request['image']->extension();
            $request['image']->move(public_path('uploads/categories'), $imageName);
            $data['image'] = $imageName;
        }

        Categories::create($data);
        return redirect()->route('admin.categories')->with('success','Đã thêm thành công');
    }
    public function categories_edit($categoriesID){
        $categories = Categories::find($categoriesID);
        return view('admin.categories.edit', compact('categories'));
    }
    public function categories_update(Request $request, $categoriesID){
        $request->validate([
                'category_name' => 'required',
                'description' => 'required',
                'up_image' => 'required|mimes:jpeg,jpg,png|max:2048']);

        $category= Categories::find($categoriesID);

        $category['category_name']=$request['category_name'];
        $category['slug']=Slug($request['category_name']);
        $category['description']=$request['description'];


        if ($request->hasFile('up_image')) {
            if ($category['image']) {
                unlink(public_path('/uploads/categories/' . $category['image']));
            }

            $imageName = time() . '.' . $request['up_image']->extension();
            $request['up_image']->move(public_path('/uploads/categories'), $imageName);
            $category['image'] = $imageName;
        }

        $category->save();
        return redirect()->route('admin.categories')->with('success','Đã cập nhật thành công');
    }
    public function categories_delete($categoriesID){
        $categories = Categories::find($categoriesID);
        $categories->delete();
        return redirect()->route('admin.categories')->with('success','Đã xóa thành công');
    }

}
