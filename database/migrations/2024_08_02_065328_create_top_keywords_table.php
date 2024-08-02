<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('top_keywords', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->unsigned()->nullable();

            $table->text('kw')->nullable()->unique();
            $table->jsonb('info')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable()->index();
            $table->bigInteger('updated_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_keywords');
    }
};
