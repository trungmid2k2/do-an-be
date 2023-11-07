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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('publicKey', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('email', 255)->collation('utf8mb4_unicode_ci')->unique();
            $table->string('username', 255)->collation('utf8mb4_unicode_ci')->unique();
            $table->string('password', 255)->collation('utf8mb4_unicode_ci');
            $table->string('photo', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('firstName', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('lastName', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->tinyInteger('isVerified')->default(0);
            $table->enum('role', ['GOD', 'USER'])->collation('utf8mb4_unicode_ci')->default('USER');
            $table->integer('totalEarned')->default(0);
            $table->tinyInteger('isTalentFilled')->default(0);
            $table->string('interests', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('bio', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('twitter', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('discord', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('github', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('linkedin', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('website', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('telegram', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('experience', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('level', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('location', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('workPrefernce', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('currentEmployer', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->json('notifications')->nullable();
            $table->tinyInteger('private')->default(0);
            $table->json('skills')->nullable();
            $table->integer('currentCompanyId')->default(0);

            $table->engine = 'InnoDB';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
