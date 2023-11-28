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
            $table->longText('twilio_sid')->nullable()->after('acc_3_gcash_number');
            $table->longText('twilio_token')->nullable()->after('acc_3_gcash_number');
            $table->longText('twilio_from')->nullable()->after('acc_3_gcash_number');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings',function(Blueprint $table){
            $table->dropColumn('twilio_sid');
            $table->dropColumn('twilio_token');
            $table->dropColumn('twilio_from');
        });
    }
};
