<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstTaiLieuMoRongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_tai_lieu_mo_rong', function (Blueprint $table){
            $table->string('ma_tai_lieu_mo_rong', 7);
            $table->string('ten_tai_lieu_mo_rong')->unique();
            $table->string('ma_danh_muc_mo_rong', 6);
            $table->string('thu_muc', 100);
            $table->boolean('trang_thai')->default(1);
            $table->string('nguoi_tao', 20);
            $table->dateTime('ngay_tao')->useCurrent();
            $table->dateTime('ngay_cap_nhat')->useCurrent();

            $table->primary('ma_danh_muc_mo_rong');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_tai_lieu_mo_rong');
    }
}
