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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191);
            $table->string('slug', 191);
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->json('eligibility')->nullable();
            $table->json('references')->nullable();
            $table->enum('status', ['OPEN', 'REVIEW', 'CLOSED'])->default('OPEN');
            $table->string('token', 191)->nullable();
            $table->integer('rewardAmount')->nullable();
            $table->json('rewards')->nullable();
            $table->string('companyId', 191)->notNullable();
            $table->string('region')->default('');
            $table->string('pocId', 191)->notNullable();
            $table->enum('source', ['NATIVE', 'IMPORT'])->default('NATIVE');
            $table->json('sourceDetails')->nullable();
            $table->boolean('isPublished')->default(0);
            $table->boolean('isFeatured')->default(0);
            $table->boolean('isActive')->default(1);
            $table->boolean('isArchived')->default(0);
            $table->timestamps();
            $table->string('applicationLink', 191)->nullable();
            $table->enum('applicationType', ['rolling', 'fixed'])->default('fixed');
            $table->json('skills')->nullable();
            $table->integer('totalWinnersSelected')->default(0);
            $table->integer('totalPaymentsMade')->default(0);
            $table->boolean('isWinnersAnnounced')->default(0);
            $table->string('templateId', 191)->nullable();
            $table->enum('type', ['permissioned', 'open'])->default('open');
            $table->string('pocSocials', 191)->nullable();
            $table->string('timeToComplete', 191)->nullable();
            $table->boolean('hackathonprize')->default(0);
            $table->json('winners')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
