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
        //make text
        Schema::table('orders',function(Blueprint $table){
            // $table->foreignId('country_id')->constrained()->default(170)->change();
            $table->string('region_code')->after('country_id')->nullable();
            $table->string('province_code')->after('region_code')->nullable();
            $table->string('city_municipality_code')->after('province_code')->nullable();
            $table->string('barangay_code')->after('city_municipality_code')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //reverse
        Schema::table('orders',function(Blueprint $table){
            $table->dropColumn('region_code');
            $table->dropColumn('province_code');
            $table->dropColumn('city_municipality_code');
            $table->dropColumn('barangay_code');
        });
    }
};
