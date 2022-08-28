<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tempat_tgl_lahir');
            $table->text('alamat');
            $table->string('jenis_kelamin');
            $table->integer('no_hp');
            $table->string('pendidikan');
            $table->integer('no_ktp');
            $table->date('tgl_register');
            $table->string('asal_seklolah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
