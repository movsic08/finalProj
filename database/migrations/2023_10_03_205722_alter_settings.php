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
        Schema::table('settings',function(Blueprint $table){
            $table->time('open_time')->change();
            $table->time('close_time')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('settings',function(Blueprint $table){
            $table->timestamp('open_time')->change();
            $table->timestamp('close_time')->change();
        });

    }
};
