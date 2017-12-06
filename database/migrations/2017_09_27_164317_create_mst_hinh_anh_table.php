<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstHinhAnhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_hinh_anh', function (Blueprint $table){
            $table->string('ma_hinh_anh', 9);
            $table->string('ten_hinh_anh');
            $table->string('ma_thu_vien', 6);
            $table->string('lien_ket');
            $table->string('dinh_dang', 10);
            $table->integer('luot_tai')->default(0);
            $table->string('nguoi_dang', 20);
            $table->date('ngay_dang')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_hinh_anh');
    }
}
