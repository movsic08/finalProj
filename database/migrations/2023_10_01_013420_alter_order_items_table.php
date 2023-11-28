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
        Schema::table('order_items',function(Blueprint $table){
            $table->foreignId('size_id')->constrained()->onDelete('cascade')->after('product_id');
            $table->foreignId('color_id')->constrained()->onDelete('cascade')->after('size_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //delete tables if it exists
        $table->dropColumn('size_id');
        $table->dropColumn('color_id');

    }
};
