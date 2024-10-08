<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        $categories=categories::all();
        return view('admin.category.list', compact('categories'));
    }
    public function delete($categoryID){
        $categories=categories::where("categoryID",$categoryID)->delete();
        return redirect()->route('admin.category');
    }
}
