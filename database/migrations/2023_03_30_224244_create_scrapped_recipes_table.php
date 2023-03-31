<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scrapped_recipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('url_id');
            $table->string('title');
            $table->json('ingredients');
            $table->json('instructions');
            $table->timestamps();
            $table->softDeletes();

            //if deleted in webscrappedurls delete here
            $table->foreign('url_id')
                ->references('id')
                ->on('webscrappedurls')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scrapped_recipes');
    }
};