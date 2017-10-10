<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstPhanQuyenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_phan_quyen', function (Blueprint $table){
            $table->increments('ma_phan_quyen');
            $table->string('ma_nhan_vien');
            $table->string('ma_nhom_quyen', 4);
            $table->boolean('trang_thai')->default(1);
            $table->string('nguoi_tao');
            $table->dateTime('ngay_tao');
            $table->string('nguoi_cap_nhat');
            $table->dateTime('ngay_cap_nhat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_phan_quyen');
    }
}
