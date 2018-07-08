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
            $table->string('user_name')->nullable()->comment('用户名');
            $table->string('password')->comment('用户密码');
            $table->string('true_name')->nullable()->comment('真实姓名');
            $table->string('user_phone')->unique()->comment('用户手机');
            $table->tinyInteger('user_gender')->default(0)->comment('用户性别（男：0, 女：1）');
            $table->string('region_c')->nullable()->comment('所在市');
            $table->string('region_t')->nullable()->comment('所在镇');
            $table->string('region_v')->nullable()->comment('所在村');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
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
