<?php

namespace App\Exports;

use App\Models\Profit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
 
class ProfitsExport implements FromView
{
    protected $start_date;
    protected $end_date;
    
    /**
     * __construct
     *
     * @param  mixed $start_date
     * @param  mixed $end_date
     * @return void
     */
    public function __construct()
    {
        
    }
    
    /**
     * view
     *
     * @return View
     */
    public function view(): View
    {
        return view('exports.profits', [
            'profits' => Profit::with('customer')->get()
        ]);
    }
}
