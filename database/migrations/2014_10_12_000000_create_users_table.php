<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('username');
            $table->string('mobile');
            $table->json('profile')->nullable()->comment('用户属性');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('take_address', function(Blueprint $table){
            $table->id();
            $table->integer('user_id');
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable()->comment('区或县');
            $table->string('in_detail')->nullable()->comment('详细地址');
            $table->enum('status', [
                'active',
                'inactive',
                'default'
            ])->default('default');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('member', function(Blueprint $table){
            $table->id('user_id');
            $table->string('email');
            $table->string('password');
            $table->string('mobile');
            $table->string('pay_password')->nullable();
            $table->json('profile')->nullable();
            $table->enum('status',[
              'active',
              'forbidden',
                'delete'
            ])->default('active');
            $table->string('type')
                ->default('regular')
                ->comment('regular:普通,silver:银牌,gold:金牌,diamond:钻石');

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
