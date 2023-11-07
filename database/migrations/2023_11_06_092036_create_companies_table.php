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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->collation('utf8mb4_unicode_ci');
            $table->string('slug', 255)->collation('utf8mb4_unicode_ci');
            $table->string('logo', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('url', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('industry', 255)->collation('utf8mb4_unicode_ci');
            $table->string('twitter', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->string('bio', 255)->nullable()->collation('utf8mb4_unicode_ci');
            $table->timestamps();
            $table->tinyInteger('isArchived')->default(0);
            $table->tinyInteger('isActive')->default(1);

            $table->engine = 'InnoDB';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
