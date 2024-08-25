<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
       $categories=Category::all();

        return view('categries.index',['categories'=>$categories]);
    }



    public function create(){
        return View('categries.create');
    }

    public function store(Request $request){
        $request->validate([
            'namecate'=>'required | string',
            
        ]);
        $namecate=$request->namecate;
       

        Category::create([
            'namecate'=> $namecate,
          

        ]);

        return redirect(route('categories.index'));

    }
}
