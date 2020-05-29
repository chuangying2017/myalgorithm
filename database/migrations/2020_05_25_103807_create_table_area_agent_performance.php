<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAreaAgentPerformance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
/*        Schema::create('tbl_area_agent_performance', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('finish')->comment('finish：订单完成，chargeback：退单');
            $table->char('order_no',100)->comment('关联订单号');
            $table->decimal('money',11,3)->default(0.000)->comment('统计订单金额');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
        \Illuminate\Support\Facades\DB::statement("alter table `tbl_area_agent_performance` comment '区域代理统计'");*/

        Schema::create('tbl_area_agent_level', function(Blueprint $table){
            $default_decimal = 0.000;
            $table->integerIncrements('id');
            $table->integer('site_id')->nullable();
            $table->string('name')->comment('等级名称');
            $table->tinyInteger('status')->default(1)->comment('默认0禁用1启用');
            $table->json('settings')->nullable()->comment('对应配置配置文件');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });

        Schema::create('tbl_area_agent_performance', function(Blueprint $table){
            $table->integerIncrements('id');
            $table->integer('site_id')->nullable();
            $table->integer('member_id')->nullable();
            $table->string('order_id')->nullable();
            $table->integer('area_id')->nullable()->comment('关联区域');
            $table->dateTime('order_time')->nullable()->comment('付款 或 维权期后 时间');
            $table->integer('money')->default(0)->comment('业绩金额，单位：分');
            $table->tinyInteger('count_period')->nullable()->comment('时期：0-付费后，1-维权期后');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });

        Schema::create('tbl_area_agent', function(Blueprint $table){
            $table->integerIncrements('id');
            $table->integer('member_id')->nullable();
            $table->integer('area_agent_level')->nullable()->comment('关联等级id');
        });
/*        \Illuminate\Support\Facades\DB::statement("alter table `tbl_area_agent_level` comment '区域等级代理'");
        \Illuminate\Support\Facades\DB::statement("alter table `tbl_area_agent_performance` comment '区域业绩统计表'");*/


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_area_agent_level');
        Schema::dropIfExists('tbl_area_agent_performance');
    }
}
