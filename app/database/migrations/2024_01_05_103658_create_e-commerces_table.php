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
        Schema::create('e-commerces', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname'); 
            $table->string('email')->unique();
            $table->string('password'); // Use the 'password' method instead of 'hash'
            $table->string('country');
            $table->string('city'); 
            $table->enum('gender',['male','female','other']);
            $table->string('photo');
            $table->string('role')->default('user');
            $table->string('is_active', 1)->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e-commerces');
    }
};
