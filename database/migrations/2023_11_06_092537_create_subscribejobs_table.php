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
        Schema::create('subscribejobs', function (Blueprint $table) {
                $table->id();
                $table->string('email', 255)->collation('utf8mb4_unicode_ci');
                $table->string('phoneNumber', 255)->nullable()->collation('utf8mb4_unicode_ci');
                $table->string('otherInfo', 255)->nullable()->collation('utf8mb4_unicode_ci');           
                $table->integer('userId')->unsigned();
                $table->integer('jobId')->unsigned();
                $table->boolean('isChosen')->default(false);
                $table->boolean('isActive')->default(true);
                  
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
        Schema::dropIfExists('subscribejobs');
    }
};
