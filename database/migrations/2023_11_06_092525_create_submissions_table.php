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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('link', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('tweet', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('otherInfo', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->json('eligibilityAnswers')->nullable();
            $table->integer('userId')->unsigned();
            $table->integer('jobId')->unsigned();
            $table->tinyInteger('isWinner')->default(0);
            $table->string('winnerPosition', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->tinyInteger('isPaid')->default(0);
            $table->json('paymentDetails')->nullable();
            $table->tinyInteger('isActive')->default(1);
            $table->tinyInteger('isArchived')->default(0);
            
            $table->json('like')->nullable();
            $table->integer('likes')->default(0);

            $table->engine = 'InnoDB';
            $table->collation = 'utf8mb4_unicode_ci';

            //$table->foreign('userId')->references('id')->on('users');
            //$table->foreign('jobId')->references('id')->on('jobs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
