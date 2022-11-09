<?php

namespace App\Http\Controllers\Apps;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Profit;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        //count sales today
        $year = Carbon::now()->format('Y');
        $count_customer = Customer::whereYear('tgl_register', '<=', $year)->whereYear('tgl_register', '>', $year - 1)->count();
        // DB::table('customers')->where(DB::raw(YEAR('tgl_register')), $year)->count();
        // $count = Flight::where('active', 1)->count();

        $profits = Profit::whereYear('created_at', '<=', $year)->whereYear('created_at', '>', $year - 1)
            ->orderBy('id', 'DESC')
            ->distinct('customer_id')
            ->get()
            ->unique('customer_id');

        $count_lulus = 0;
        $count_tidak_lulus = 0;
        $count_dipertimbangkan = 0;
        foreach ($profits as $profit) {
            switch ($profit->kategori) {
                case 'Lulus':
                    $count_lulus++;
                    break;
                case 'Tidak Lulus':
                    $count_tidak_lulus++;
                    break;
                case 'Dipertimbangkan':
                    $count_dipertimbangkan++;
                    break;
            }
        }

        return Inertia::render('Apps/Dashboard/Index', compact(
            'count_customer', 'count_lulus', 'count_tidak_lulus', 'count_dipertimbangkan'));
    }
}
