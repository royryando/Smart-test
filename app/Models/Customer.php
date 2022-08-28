<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name', 'tempat_tgl_lahir', 'alamat','jenis_kelamin','no_hp','pendidikan','no_ktp','tgl_register','asal_sekolah'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function profit()
    {
        return $this->hasMany(Profit::class);
    }

    // public function profit()
    // {
    //     return $this->belongsTo(Customer::class);
    // }
}
