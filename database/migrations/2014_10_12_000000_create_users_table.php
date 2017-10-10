<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ma_nhan_vien', 10)->unique();
            $table->string('ho_ten');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('ma_phong_ban');
            $table->string('chuc_vu');
            $table->boolean('is_admin')->default(0);
            $table->string('dia_chi');
            $table->date('ngay_sinh');
            $table->boolean('trang_thai')->default(1);
            $table->dateTime('ngay_tao')->useCurrent();
            $table->dateTime('ngay_cap_nhat')->useCurrent();

            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
