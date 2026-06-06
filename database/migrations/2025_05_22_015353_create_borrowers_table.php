<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowersTable extends Migration
{
    public function up()
    {
        Schema::create('borrowers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali')->nullable();
            $table->date('tgl_kembali_confirm')->nullable();
            $table->boolean('is_confirm')->default(false);
            $table->integer('fine')->nullable(); // denda jika ada
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrowers');
    }
}
