<?php

namespace App\Http\Controllers\Apps;

use Inertia\Inertia;
use App\Models\Profit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Exports\ProfitsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

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
        return Inertia::render('Apps/Products/Index', [
            'laporan' => $customer
        ]);
    }
    public function clear ()
    {
        $clear = Profit::truncate();
        return redirect()->route('apps.products.index');
    }

    public function proses(Request $request)
    {
        //Get value max in coloumn parameter
        $max_kelengkapan_administrasi = DB::table('products')->max('kelengkapan_administrasi');
        $max_tes_fisik = DB::table('products')->max('tes_fisik');
        $max_tes_matematika = DB::table('products')->max('tes_matematika');
        $max_tes_bahasa = DB::table('products')->max('tes_bahasa');

        //Get value min in coloumn parameter
        $min_kelengkapan_administrasi = Product::min('kelengkapan_administrasi');
        // dd($min_kelengkapan_administrasi);
        $min_tes_fisik = DB::table('products')->min('tes_fisik');
        $min_tes_matematika = DB::table('products')->min('tes_matematika');
        $min_tes_bahasa = DB::table('products')->min('tes_bahasa');

        // calculate value bobot kriteria 
        $jumlah_nilai_bobot = (int)DB::table('categories')->sum('bobot');
        $nilai_bobot_kelengkapan_administrasi =(int) DB::table('categories')->select('bobot')->where('id','=','1')->sum('bobot');
        $nilai_bobot_tes_fisik = (int) Category::select('bobot')->where('id','=','2')->sum('bobot');
        $nilai_bobot_tes_matematika = (int) Category::select('bobot')->where('id','=','3')->sum('bobot');
        $nilai_bobot_tes_bahasa = (int) Category::select('bobot')->where('id','=','4')->sum('bobot');
        $nilai_bobot_kriteria_kelengkapan_administrasi = $nilai_bobot_kelengkapan_administrasi / $jumlah_nilai_bobot;
        $nilai_bobot_kriteria_tes_fisik = $nilai_bobot_tes_fisik / $jumlah_nilai_bobot;
        $nilai_bobot_kriteria_tes_matematika = $nilai_bobot_tes_matematika / $jumlah_nilai_bobot;
        $nilai_bobot_kriteria_tes_bahasa = $nilai_bobot_tes_bahasa / $jumlah_nilai_bobot;

        $nilai_users = Product::all();
        $kriterias = Kriteria::all();
        foreach($nilai_users as $nilai_user){
            (($max_kelengkapan_administrasi - $min_kelengkapan_administrasi) == 0 ) ? ($nilai_utility_kelengkapan_administrasi = 0) : ($nilai_utility_kelengkapan_administrasi = (($nilai_user->kelengkapan_administrasi - $min_kelengkapan_administrasi) / ($max_kelengkapan_administrasi - $min_kelengkapan_administrasi)) * 100);
            (($max_tes_fisik - $min_tes_fisik) == 0) ? ($nilai_utility_tes_fisik = 0) : ($nilai_utility_tes_fisik = (($nilai_user->tes_fisik - $min_tes_fisik) / ($max_tes_fisik - $min_tes_fisik)) * 100);
            (($max_tes_matematika - $min_tes_matematika) == 0) ? ($nilai_utility_tes_matematika = 0) : ($nilai_utility_tes_matematika = (($nilai_user->tes_matematika - $min_tes_matematika) / ($max_tes_matematika - $min_tes_matematika)) * 100);
            (($max_tes_bahasa - $min_tes_bahasa) == 0) ? ($nilai_utility_tes_bahasa = 0) : ($nilai_utility_tes_bahasa = (($nilai_user->tes_bahasa - $min_tes_bahasa) / ($max_tes_bahasa - $min_tes_bahasa)) * 100);
            $nilai_smarttest = ($nilai_utility_kelengkapan_administrasi * $nilai_bobot_kriteria_kelengkapan_administrasi) + ($nilai_utility_tes_fisik * $nilai_bobot_kriteria_tes_fisik) + ($nilai_utility_tes_matematika * $nilai_bobot_kriteria_tes_matematika) + ($nilai_utility_tes_bahasa * $nilai_bobot_kriteria_tes_bahasa);
            foreach ($kriterias as $kriteria) {
                if (($kriteria->nilai_awal <= $nilai_smarttest) && ($nilai_smarttest <= $kriteria->nilai_akhir)) {
                    $kategori = $kriteria->keterangan;
                }
            }
            
            Profit::create([
                'customer_id'                   => $nilai_user->customer_id,
                'product_id'                    => $nilai_user->id,
                'nilai'                         => $nilai_smarttest,
                'kategori'                      => $kategori,
            ]);
        }

        //redirect
        return redirect()->route('apps.products.index');
    }
    

    /**
     * export
     *
     * @param  mixed $request
     * @return void
     */
    public function export(Request $request)
    {
        return Excel::download(new ProfitsExport(), 'Laporan Smart Test.xlsx');
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
        $profits = Profit::with('customer')->get();

        //load view PDF with data
        $pdf = PDF::loadView('exports.profits', compact('profits'));

        //download PDF
        return $pdf->download('Laporan Smart Test.pdf');
    }
}
