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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('message', 255)->collation('utf8mb4_unicode_ci');
            $table->integer('authorId')->unsigned();
            $table->integer('jobId')->unsigned();
            $table->tinyInteger('isActive')->default(1);
            $table->tinyInteger('isArchived')->default(0);

            $table->engine = 'InnoDB';
            $table->collation = 'utf8mb4_unicode_ci';

            //$table->foreign('authorId')->references('id')->on('users');
            //$table->foreign('jobId')->references('id')->on('jobs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
