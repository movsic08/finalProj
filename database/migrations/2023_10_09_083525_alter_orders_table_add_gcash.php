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
        Schema::table('orders',function(Blueprint $table){
            
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending','confirmed','shipped','delivered','cancelled') DEFAULT 'pending'");
            // $table->enum('status',['pending','shipped','delivered','cancelled','confirmed'])->default('pending');

            $table->string('gcash_name')->nullable()->after('notes');
            $table->string('gcash_number')->nullable()->after('gcash_name');
            $table->longText('gcash_photo_reciept')->nullable()->after('gcash_number');
            $table->string('gcash_ref_number')->nullable()->after('gcash_photo_reciept');
            $table->string('gcash_sent_to')->nullable()->after('gcash_ref_number');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders',function(Blueprint $table){
            // $table->enum('status',['pending','shipped','delivered','cancelled'])->default('pending');
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending','shipped','delivered','cancelled') DEFAULT 'pending'");

            $table->dropColumn('gcash_name');
            $table->dropColumn('gcash_number');
            $table->dropColumn('gcash_photo_reciept');
            $table->dropColumn('gcash_ref_number');
            $table->dropColumn('gcash_sent_to');

        });

    }
};
