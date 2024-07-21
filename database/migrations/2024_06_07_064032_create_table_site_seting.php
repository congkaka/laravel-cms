<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSiteSeting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_setting', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('facebook')->nullable();
            $table->string('zalo')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('work_time')->nullable();

            $table->string('google_play')->nullable();
            $table->string('appstore')->nullable();

            $table->string('logo')->nullable();
            $table->jsonb('slide')->nullable();
            $table->jsonb('main_banner')->nullable();
            $table->jsonb('sub_banner')->nullable();

            $table->jsonb('footer')->nullable();
            $table->jsonb('top_menu')->nullable();
            $table->jsonb('main_menu')->nullable();
            $table->json('bank')->nullable();
            $table->json('telegram')->nullable();
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
        Schema::dropIfExists('site_setting');
    }
}
