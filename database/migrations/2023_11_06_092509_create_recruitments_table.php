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
        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->collation('utf8mb4_unicode_ci');
            $table->string('slug', 255)->collation('utf8mb4_unicode_ci');
            $table->string('description', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('skills', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('subskills', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('deadline', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->enum('source', ['NATIVE', 'IMPORT'])->collation('utf8mb4_unicode_ci')->default('NATIVE');
            $table->boolean('active')->default(true);;
            $table->boolean('private')->default(false);;
            $table->boolean('featured')->default(false);;
            $table->string('experience', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->enum('jobType', ['parttime', 'fulltime', 'internship'])->collation('utf8mb4_unicode_ci')->default('fulltime');
            $table->double('maxSalary')->nullable();
            $table->double('minSalary')->nullable();
            $table->double('maxEq')->nullable();
            $table->double('minEq')->nullable();
            $table->string('location', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->integer('companyId')->unsigned();
            $table->string('timezone', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('link', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->json('sourceDetails')->nullable();

            $table->engine = 'InnoDB';
            $table->collation = 'utf8mb4_unicode_ci';

            //$table->foreign('companyId')->references('id')->on('companys');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruitments');
    }
};
