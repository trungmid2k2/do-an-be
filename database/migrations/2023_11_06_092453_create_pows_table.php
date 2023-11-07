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
        Schema::create('pows', function (Blueprint $table) {
            $table->id();
            $table->integer('userId')->unsigned();
            $table->string('title', 255)->collation('utf8mb4_unicode_ci');
            $table->string('description', 255)->collation('utf8mb4_unicode_ci');
            $table->json('skills')->nullable();
            $table->json('subSkills')->nullable();
            $table->string('link', 255)->collation('utf8mb4_unicode_ci');

            $table->engine = 'InnoDB';
            $table->collation = 'utf8mb4_unicode_ci';

            // //$table->foreign('userId')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pows');
    }
};
