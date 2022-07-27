<?php

namespace App\Http\Controllers\Apps;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get products

        $categories = Category::when(request()->q, function($categories) {
            $categories = $categories->where('title', 'like', '%'. request()->q . '%');
        })->latest()->paginate(5);
        //return inertia
        return Inertia::render('Apps/Categories/Index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return Inertia::render('Apps/Categories/Edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        /**
         * validate
         */
        $this->validate($request, [
            'deskripsi'             => 'required',
            'bobot'                 => 'required',
        ]);

        //update product without image
        $category->update([
            'deskripsi'      => $request->deskripsi,
            'bobot'     => $request->bobot,
        ]);

        //redirect
        return redirect()->route('apps.categories.index');
    }

    
}
