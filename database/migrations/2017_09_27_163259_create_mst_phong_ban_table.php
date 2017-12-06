<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstPhongBanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_phong_ban', function (Blueprint $table){
            $table->string('ma_phong_ban', 7);
            $table->string('ma_tru_so', 4);
            $table->string('ten_phong_ban',100)->unique();
            $table->timestamp('ngay_tao')->useCurrent();
            $table->timestamp('ngay_cap_nhat')->useCurrent();

            $table->primary('ma_phong_ban');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_phong_ban');
    }
}
