<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstTaiLieuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_tai_lieu', function (Blueprint $table){
            $table->string('ma_tai_lieu', 10);
            $table->string('ten_tai_lieu')->unique();
            $table->string('mo_ta_tai_lieu');
            $table->string('ma_danh_muc', 6);
            $table->string('dinh_dang');
            $table->integer('dung_luong');
            $table->string('lien_ket');
            $table->string('nguoi_dang', 20);
            $table->integer('luot_tai')->default(0);
            $table->boolean('trang_thai')->default(1);
            $table->dateTime('ngay_tao')->useCurrent();
            $table->dateTime('ngay_cap_nhat')->useCurrent();

            $table->primary('ma_tai_lieu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_tai_lieu');
    }
}
