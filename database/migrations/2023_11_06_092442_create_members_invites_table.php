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
        Schema::create('members_invites', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->collation('utf8mb4_unicode_ci');
            $table->integer('senderId')->unsigned();
            $table->integer('companyId')->unsigned();
            $table->enum('memberType', ['ADMIN', 'MEMBER'])->collation('utf8mb4_unicode_ci')->default('MEMBER');
            $table->engine = 'InnoDB';
            $table->collation = 'utf8mb4_unicode_ci';

            // //$table->foreign('senderId')->references('id')->on('users');
            // //$table->foreign('companyId')->references('id')->on('companies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members_invites');
    }
};
