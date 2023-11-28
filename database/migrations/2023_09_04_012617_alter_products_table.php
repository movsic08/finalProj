<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * composer require doctrine/dbal
     * 
     * we have to make the description into text
     */
    public function up(): void
    {
        //make text
        Schema::table('products',function(Blueprint $table){
            $table->text('description')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //reverse
        Schema::table('products',function(Blueprint $table){
            $table->text('description')->change();
        });
    }
};
