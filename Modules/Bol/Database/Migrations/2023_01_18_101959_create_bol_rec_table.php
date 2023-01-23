<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bol_rec', function (Blueprint $table) {
            $table->id();
            $table->integer('s_d');
            $table->foreignId('user_id');
            $table->string('site', 100);
            $table->string('lable_pdf_file', 50);
            $table->string('invoice_pdf_file', 100);
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
        Schema::dropIfExists('bol_rec');
    }
};
