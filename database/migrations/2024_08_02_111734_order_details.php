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
        Schema::create('orderDetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');         
            $table->unsignedBigInteger('product_id');         
            $table->integer('qty');        
            $table->decimal('unitprice', 10, 2);        
            $table->decimal('total', 10, 2);        
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        
    }
};
