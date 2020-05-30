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
            $table->integerIncrements('id');
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
        \Illuminate\Support\Facades\DB::statement("alter table `users` comment '后台用户'");

        Schema::create('take_address', function(Blueprint $table){
            $table->integerIncrements('id');
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
        \Illuminate\Support\Facades\DB::statement("alter table `take_address` comment '会员地址'");

        Schema::create('bay_cat', function(Blueprint $table){
            $table->integer('user_id')->comment('关联member表id');
            $table->integer('product_id')->comment('关联商品id');
            $table->json('specification')->comment('商品规格参数');
            $table->integer('bay_num');
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("alter table `bay_cat` comment '购物车'");

        Schema::create('member', function(Blueprint $table){
            $table->integerIncrements('user_id');
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
            $table->decimal('integral',10,2)->default(0.00);
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('openid')->nullable()->comment('微信openid');
            $table->string('wx_phone')->nullable()->comment('微信授权手机号码');
            $table->string('wx_nickname')->nullable()->comment('微信昵称');
            $table->timestamps();
            $table->softDeletes();
        });
        \Illuminate\Support\Facades\DB::statement("alter table `member` comment '会员表'");

        Schema::create('banner', function(Blueprint $table){
            $table->integerIncrements('id');
            $table->string('name')->nullable()->comment('图片名称');
            $table->string('url')->nullable();
            $table->integer('weight')->default(0)->comment('权重用于排序');
            $table->string('image_id')->nullable()->comment('用于存储的sdk');
            $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamps();
        });
        \Illuminate\Support\Facades\DB::statement("alter table `banner` comment '首页展图'");

        Schema::create('order', function(Blueprint $table){
            $table->integerIncrements('id');
            $table->string('order_no')->comment('订单号');
            $table->timestamps();
        });

        Schema::create('order_sku', function(Blueprint $table){
            $table->integer('order_id');
            $table->integer('product_id');
            $table->json('specification');
            $table->integer('bay_num');
        });

        Schema::create('coupon', function(Blueprint $table){
           $table->integerIncrements('id');
           $table->string('name')->comment('优惠券命名');
           $table->integer('user_id')->comment('后台用户');
           $table->enum('status', ['active','forbidden'])->default('active')->comment('默认活跃');
           $table->enum('type', ['assign','common'])->default('assign')->comment('使用类型指定或通用');
           $table->decimal('money',10,2)->default(0.00)->comment('优惠金额');
           $table->timestamp('start_time');
           $table->timestamp('end_time');
           $table->timestamps();
           $table->softDeletes();
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
