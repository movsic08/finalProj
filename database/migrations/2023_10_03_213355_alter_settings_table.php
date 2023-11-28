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
            $table->longText('mobile_number_2')->nullable()->after('mobile_number');
            $table->longText('mobile_number_3')->nullable()->after('mobile_number_2');
            $table->longText('mobile_number_4')->nullable()->after('mobile_number_3');

            $table->longText('twitter')->nullable()->after('facebook');
            $table->longText('youtube')->nullable()->after('twitter');
            $table->longText('instagram')->nullable()->after('youtube');

            $table->time('order_confirm_open_time_1')->nullable()->after('close_time');
            $table->time('order_confirm_close_time_1')->nullable()->after('order_confirm_open_time_1');
            $table->time('order_confirm_open_time_2')->nullable()->after('order_confirm_close_time_1');
            $table->time('order_confirm_close_time_2')->nullable()->after('order_confirm_open_time_2');
            $table->time('order_confirm_open_time_3')->nullable()->after('order_confirm_close_time_2');
            $table->time('order_confirm_close_time_3')->nullable()->after('order_confirm_open_time_3');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings',function(Blueprint $table){
            $table->dropColumn('mobile_number_2');
            $table->dropColumn('mobile_number_3');
            $table->dropColumn('mobile_number_4');

            $table->dropColumn('twitter');
            $table->dropColumn('youtube');
            $table->dropColumn('instagram');

            $table->dropColumn('order_confirm_open_time_1');
            $table->dropColumn('order_confirm_close_time_1');
            $table->dropColumn('order_confirm_open_time_2');
            $table->dropColumn('order_confirm_close_time_2');
            $table->dropColumn('order_confirm_open_time_3');
            $table->dropColumn('order_confirm_close_time_3');


        });
    }
};
