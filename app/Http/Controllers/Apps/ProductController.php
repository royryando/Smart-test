<?php

namespace App\Http\Controllers\Apps;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Profit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get products
        $customers = Customer::orderBy('name','ASC')->get();
        $products = Product::when(request()->q, function($products) {
            $products = $products->where('title', 'like', '%'. request()->q . '%');
        })->latest()->paginate(5);
        $penilaian_view= Product::with('customer')->get();
        $profits= Profit::with('customer')->get();
        //return inertia
        return Inertia::render('Apps/Products/Index', [
            'products' => $products,
            'penilaian_view' => $penilaian_view,
            'customers' => $customers,
            'profits' => $profits
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get categories -> get data
        $customers = Customer::orderBy('name','ASC')->get();
        //return inertia
        return Inertia::render('Apps/Products/Index', [
            'customers' => $customers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * validate
         */
        $this->validate($request, [
            'customer_id'                           => 'required',
            // 'image'         => 'required|image|mimes:jpeg,jpg,png|max:2000',
            // 'barcode'       => 'required|unique:products',
            'kelengkapan_administrasi'          => 'required',
            'tes_fisik'                         => 'required',
            'tes_matematika'                    => 'required',
            'tes_bahasa'                        => 'required',
        ]);

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/products', $image->hashName());

        //create product
        Product::create([
            // 'image'         => $image->hashName(),
            'customer_id'                   => $request->customer_id,
            'kelengkapan_administrasi'      => $request->kelengkapan_administrasi,
            'tes_fisik'                     => $request->tes_fisik,
            'tes_matematika'                => $request->tes_matematika,
            'tes_bahasa'                    => $request->tes_bahasa,
        ]);

        //redirect
        return redirect()->route('apps.products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //get categories
        $customers = Customer::orderBy('name','ASC')->get();

        return Inertia::render('Apps/Products/Edit', [
            'product' => $product,
            'customers' => $customers
        ]);
    }

    public function update(Request $request, Product $product)
    {
        /**
         * validate
         */
        $this->validate($request, [
            'customer_id'                       => 'required',
            'kelengkapan_administrasi'          => 'required',
            'tes_fisik'                         => 'required',
            'tes_matematika'                    => 'required',
            'tes_bahasa'                        => 'required',
        ]);

        //update product without image
        $product->update([
            'customer_id'                       => $request->customer_id,
            'kelengkapan_administrasi'          => $request->kelengkapan_administrasi,
            'tes_fisik'                         => $request->tes_fisik,
            'tes_matematika'                    => $request->tes_matematika,
            'tes_bahasa'                        => $request->tes_bahasa,
        ]);

        //redirect
        return redirect()->route('apps.products.index');
    }

    public function destroy($id)
    {
        //find by ID
        $product = Product::findOrFail($id);

        

        //remove image
        // Storage::disk('local')->delete('public/products/'.basename($product->image));

        //delete
        $product->delete();

        //redirect
        return redirect()->route('apps.products.index');
    }

    
}
