<?php

namespace App\Http\Controllers\Apps;

use Inertia\Inertia;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get customers
        $customers = Customer::when(request()->q, function($customers) {
            $customers = $customers->where('name', 'like', '%'. request()->q . '%');
        })->latest()->paginate(5);

        //return inertia
        return Inertia::render('Apps/Customers/Index', [
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Apps/Customers/Create');
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
            'name'      => 'required',
            'tempat_tgl_lahir' => 'required',
            'alamat'   => 'required',
            'jenis_kelamin' => 'required',
            'no_hp'   => 'required|unique:customers',
            'pendidikan' => 'required',
            'no_ktp' => 'required|unique:customers',
            'asal_sekolah' => 'required'
            
        ]);

        //create customer
        Customer::create([
            'name'      => $request->name,
            'tempat_tgl_lahir' => $request->tempat_tgl_lahir,
            'alamat'   => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp'   => $request->no_hp,
            'pendidikan' => $request->pendidikan,
            'no_ktp' => $request->no_ktp,
            'tgl_register' => Carbon::now(),
            'asal_sekolah' => $request->asal_sekolah
        ]);

        //redirect
        return redirect()->route('apps.customers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return Inertia::render('Apps/Customers/Edit', [
            'customer' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)    
    {
        /**
         * validate
         */
        $this->validate($request, [
            'name'      => 'required',
            'tempat_tgl_lahir' => 'required',
            'alamat'   => 'required',
            'jenis_kelamin' => 'required',
            'no_hp'   => 'required|unique:customers,no_hp,'.$customer->id,
            'pendidikan' => 'required',
            'no_ktp' => 'required|unique:customers,no_ktp,'.$customer->id,
            'asal_sekolah' => 'required'
        ]);

        //update customer
        $customer->update([
            'name'      => $request->name,
            'tempat_tgl_lahir' => $request->tempat_tgl_lahir,
            'alamat'   => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp'   => $request->no_hp,
            'pendidikan' => $request->pendidikan,
            'no_ktp' => $request->no_ktp,
            'asal_sekolah' => $request->asal_sekolah
        ]);

        //redirect
        return redirect()->route('apps.customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find customer by ID
        $customer = Customer::findOrFail($id);

        //delete customer
        $customer->delete();

        //redirect
        return redirect()->route('apps.customers.index');
    }
}
