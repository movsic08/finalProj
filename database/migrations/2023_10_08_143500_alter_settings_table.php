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
            $table->string('acc_1_gcash_name')->nullable()->after('order_confirm_close_time_3');
            $table->string('acc_1_gcash_number')->nullable()->after('acc_1_gcash_name');
            $table->string('acc_2_gcash_name')->nullable()->after('acc_1_gcash_number');
            $table->string('acc_2_gcash_number')->nullable()->after('acc_2_gcash_name');
            $table->string('acc_3_gcash_name')->nullable()->after('acc_2_gcash_number');
            $table->string('acc_3_gcash_number')->nullable()->after('acc_3_gcash_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropColumn('acc_1_gcash_name');
        $table->dropColumn('acc_1_gcash_number');
        $table->dropColumn('acc_2_gcash_name');
        $table->dropColumn('acc_2_gcash_number');
        $table->dropColumn('acc_3_gcash_name');
        $table->dropColumn('acc_3_gcash_number');
    }
};
