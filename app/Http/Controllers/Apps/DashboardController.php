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
        $customer = Customer::whereYear('tgl_register', '<=', $year)->whereYear('tgl_register', '>', $year - 1)->count();
        // DB::table('customers')->where(DB::raw(YEAR('tgl_register')), $year)->count();
        // $count = Flight::where('active', 1)->count();

        return Inertia::render('Apps/Dashboard/Index', [
            'count_customer'    => $customer
        ]);
    }
}
