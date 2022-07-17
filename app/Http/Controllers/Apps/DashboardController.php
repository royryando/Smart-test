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
        $count_customer = Customer::all()->count();

        //sum sales today
        $avarage_nilai = Profit::all()->sum('nilai');

        return Inertia::render('Apps/Dashboard/Index', [
            'count_customer'    => (int) $count_customer,
            'avarage_nilai'      => (int) $avarage_nilai / $count_customer
        ]);
    }
}
