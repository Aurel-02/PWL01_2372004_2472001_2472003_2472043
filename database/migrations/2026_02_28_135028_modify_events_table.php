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
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('location');
            $table->dropColumn('quota');
            
            $table->foreignId('organizer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->string('venue')->nullable();
            $table->string('city')->nullable();
            $table->string('status')->default('draft'); // draft, published, cancelled, completed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('category');
            $table->string('location');
            $table->integer('quota');

            $table->dropForeign(['organizer_id']);
            $table->dropColumn('organizer_id');
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
            $table->dropColumn('venue');
            $table->dropColumn('city');
            $table->dropColumn('status');
        });
    }
};
