<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('alias')->unique();
            $table->string('name');

            $table->text('store_url')->nullable();
            $table->text('logo_url')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();

            $table->jsonb('info')->nullable();
            $table->text('affiliate_url')->nullable();
            $table->integer('country_id')->nullable(); //country id
            $table->integer('category_id')->nullable();

            $table->string('status')->nullable();
            $table->string('scrapy_source')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
