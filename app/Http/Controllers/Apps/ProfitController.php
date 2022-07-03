<?php

namespace App\Http\Controllers\Apps;

use Inertia\Inertia;
use App\Models\Profit;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\ProfitsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ProfitController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $customer= Profit::with('customer')->get();
        return Inertia::render('Apps/Profits/Index', [
            'laporan' => $customer
        ]);
    }

    public function proses(Request $request, $id)
    {
        //find by ID
        $proses = Product::where('id','=',$id) ->get(); 
        $rata_nilai = 0;
        $kategori='';
        $customer_id = '';
        foreach ($proses as $nilai_peserta) {
            $rata_nilai = $rata_nilai + $nilai_peserta->kelengkapan_administrasi;
            $rata_nilai = $rata_nilai + $nilai_peserta->tes_fisik;
            $rata_nilai = $rata_nilai + $nilai_peserta->tes_matematika;
            $rata_nilai = $rata_nilai + $nilai_peserta->tes_bahasa;
            $customer_id = $nilai_peserta->customer_id;
        }
        $result_nilai = $rata_nilai / 4;

        if($result_nilai <= 25){
            $kategori = 'Cukup';
        }
        elseif(25<$result_nilai && $result_nilai<=50){
            $kategori = 'Kurang Baik';
        }
        elseif(50<$result_nilai && $result_nilai<=75){
            $kategori = 'Baik';
        }
        elseif(75<$result_nilai && $result_nilai<=100){
            $kategori = 'Baik';
        }
        else{
            $kategori = '-';
        }

        //remove image
        // Storage::disk('local')->delete('public/products/'.basename($product->image));

        //delete
        // $product->delete();

        //redirect
        Profit::create([
            'customer_id'                   => $customer_id,
            'product_id'                    => $id,
            'nilai'                         => $result_nilai,
            'kategori'                      => $kategori,
        ]);

        //redirect
        return redirect()->route('apps.products.index');
        // return redirect()->route('apps.products.index');
    }
    
    /**
     * filter
     *
     * @param  mixed $request
     * @return void
     */
    public function filter(Request $request)
    {
        $this->validate($request, [
            'start_date'  => 'required',
            'end_date'    => 'required',
        ]);

        //get data profits by range date
        $profits = Profit::with('customer')->whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->get();

        //get total profit by range date    
        // $total = Profit::whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->sum('total');
        
        return Inertia::render('Apps/Profits/Index', [
            'profits'   => $profits,
            // 'total'     => (int) $total
        ]);
    }

    /**
     * export
     *
     * @param  mixed $request
     * @return void
     */
    public function export(Request $request)
    {
        return Excel::download(new ProfitsExport($request->start_date, $request->end_date), 'profits : '.$request->start_date.' — '.$request->end_date.'.xlsx');
    }
    
    /**
     * pdf
     *
     * @param  mixed $request
     * @return void
     */
    public function pdf(Request $request)
    {
        //get data proftis by range date
        $profits = Profit::with('customer')->whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->get();

        //get total profit by range date
        // $total = Profit::whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->sum('total');

        //load view PDF with data
        $pdf = PDF::loadView('exports.profits', compact('profits'));

        //download PDF
        return $pdf->download('profits : '.$request->start_date.' — '.$request->end_date.'.pdf');
    }
}
