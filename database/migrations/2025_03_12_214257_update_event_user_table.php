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
        Schema::table('event_user', function (Blueprint $table) {
            // Remove as chaves estrangeiras existentes
            $table->dropForeign(['event_id']);
            $table->dropForeign(['user_id']);
    
            // Adiciona as chaves estrangeiras com onDelete('cascade')
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_user', function (Blueprint $table) {
            // Remove as chaves estrangeiras com cascade
            $table->dropForeign(['event_id']);
            $table->dropForeign(['user_id']);
    
            // Adiciona as chaves estrangeiras sem cascade (opcional)
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
};
