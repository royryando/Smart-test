<?php

namespace App\Http\Controllers\Apps;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Customer;
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
        $products = Product::when(request()->q, function($products) {
            $products = $products->where('title', 'like', '%'. request()->q . '%');
        })->latest()->paginate(5);

        $penilaian_view= Product::with('customer')->get();
 

        //return inertia
        return Inertia::render('Apps/Products/Index', [
            'products' => $products,
            'penilaian_view' => $penilaian_view
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get categories
        $customers = Customer::orderBy('name','ASC')->get();

        //return inertia
        return Inertia::render('Apps/Products/Create', [
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        //check image update
        // if ($request->file('image')) {

        //     //remove old image
        //     Storage::disk('local')->delete('public/products/'.basename($product->image));
        
        //     //upload new image
        //     $image = $request->file('image');
        //     $image->storeAs('public/products', $image->hashName());

        //     //update product with new image
        //     $product->update([
        //         'image'=> $image->hashName(),
        //         'barcode'       => $request->barcode,
        //         'title'         => $request->title,
        //         'description'   => $request->description,
        //         'category_id'   => $request->category_id,
        //         'buy_price'     => $request->buy_price,
        //         'sell_price'    => $request->sell_price,
        //         'stock'         => $request->stock,
        //     ]);

        // }

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function proses(Request $request, $id)
    {
        //find by ID
        $proses = Product::select('kelengkapan_administrasi','tes_fisik','tes_matematika','tes_bahasa')
                ->where('id','=',$id) 
                ->get();
        $rata_nilai = 0;
        foreach ($proses as $nilai_peserta) {
            $rata_nilai = $rata_nilai + $nilai_peserta->kelengkapan_administrasi;
            $rata_nilai = $rata_nilai + $nilai_peserta->tes_fisik;
            $rata_nilai = $rata_nilai + $nilai_peserta->tes_matematika;
            $rata_nilai = $rata_nilai + $nilai_peserta->tes_bahasa;
        }
        $result_nilai = $rata_nilai / 4;

        //remove image
        // Storage::disk('local')->delete('public/products/'.basename($product->image));

        //delete
        // $product->delete();

        //redirect
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
        // return redirect()->route('apps.products.index');
    }
}
