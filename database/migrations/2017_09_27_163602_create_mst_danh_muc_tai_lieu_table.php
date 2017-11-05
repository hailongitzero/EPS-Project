<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstDanhMucTaiLieuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_danh_muc_tai_lieu', function (Blueprint $table){
            $table->string('ma_danh_muc', 6);
            $table->string('ten_danh_muc');
            $table->string('ma_to_cong_tac', 10)->nullable();
            $table->string('ma_tai_lieu_mo_rong', 7)->nullable();
            $table->boolean('trang_thai');
            $table->timestamp('ngay_tao');
            $table->timestamp('ngay_cap_nhat')->useCurrent();
            $table->string('nguoi_cap_nhat')->useCurrent();

            $table->primary('ma_danh_muc');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_danh_muc_tai_lieu');
    }
}
