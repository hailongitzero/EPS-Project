<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstToCongTacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_to_cong_tac', function (Blueprint $table){
            $table->string('ma_to_cong_tac', 10);
            $table->string('ten_to_cong_tac');
            $table->string('ma_phong_ban', 7);
            $table->string('thu_muc');
            $table->boolean('trang_thai')->default(1);
            $table->string('nguoi_tao', 20);
            $table->dateTime('ngay_tao')->useCurrent();
            $table->dateTime('ngay_cap_nhat')->useCurrent();


            $table->primary('ma_to_cong_tac');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_to_cong_tac');
    }
}
