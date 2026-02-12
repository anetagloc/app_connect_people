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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('event_id')->references('id')->on('events')->nullOnDelete();
            $table->foreign('activity_id')->references('id')->on('activities')->nullOnDelete();
            $table->foreign('avaible_time_id')->references('id')->on('avaible_times')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['activity_id']);
            $table->dropForeign(['avaible_time_id']);
        });
    }
};
