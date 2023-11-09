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
            $table->boolean('isWinner')->default(false);;
            $table->string('winnerPosition', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->boolean('isPaid')->default(false);;
            $table->json('paymentDetails')->nullable();
            $table->boolean('isActive')->default(true);;
            $table->boolean('isArchived')->default(false);;
            
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
