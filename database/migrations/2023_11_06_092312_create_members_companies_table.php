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
        Schema::create('members_companies', function (Blueprint $table) {
            $table->id();
            $table->integer('userId')->unsigned();
            $table->integer('companyId')->unsigned();
            $table->enum('role', ['ADMIN', 'MEMBER'])->collation('utf8mb4_unicode_ci')->default('MEMBER');

            // //$table->foreign('userId')->references('id')->on('users');
            // //$table->foreign('companyId')->references('id')->on('companies');

            $table->engine = 'InnoDB';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members_companies');
    }
};
