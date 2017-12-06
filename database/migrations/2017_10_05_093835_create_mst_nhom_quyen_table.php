<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstNhomQuyenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_nhom_quyen', function (Blueprint $table){
            $table->string('ma_nhom_quyen', 4);
            $table->string('ten_nhom_quyen');
            $table->string('ma_danh_muc', 6);
            $table->boolean('trang_thai')->default(1);
            $table->string('nguoi_tao', 20);
            $table->dateTime('ngay_tao');
            $table->string('nguoi_cap_nhat', 20);
            $table->dateTime('ngay_cap_nhat');

            $table->primary('ma_nhom_quyen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_nhom_quyen');
    }
}
