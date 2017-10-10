<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstThuVienHinhAnhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_thu_vien_hinh_anh', function (Blueprint $table){
            $table->string('ma_thu_vien', 6);
            $table->string('ten_thu_vien');
            $table->boolean('trang_thai');
            $table->dateTime('ngay_tao')->useCurrent();
            $table->dateTime('ngay_cap_nhat')->useCurrent();
            $table->string('nguoi_tao');
            $table->string('nguoi_cap_nhat');

            $table->primary('ma_thu_vien');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_thu_vien_hinh_anh');
    }
}
