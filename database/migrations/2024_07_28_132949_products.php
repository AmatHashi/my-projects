<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cat_id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->text('discription');
            $table->text('sizes')->nullable(); 
            $table->text('colors')->nullable(); 
            $table->float('price');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        
    }
};
