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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->longText('name')->nullable();
            $table->longText('logo')->nullable();
            $table->longText('favicon')->nullable();
            $table->longText('location')->nullable();
            $table->longText('mobile_number')->nullable();
            $table->longText('email')->nullable();
            $table->longText('facebook')->nullable();
            $table->timestamp('open_time')->nullable();
            $table->timestamp('close_time')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
