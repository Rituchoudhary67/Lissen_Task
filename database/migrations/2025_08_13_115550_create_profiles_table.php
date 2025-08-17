<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(){
    Schema::create('profiles', function (Blueprint $table) {
        $table->id();
        //linked to users table
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('first_last_name'); // full name
        $table->string('country'); // country from dropdown
        $table->string('gender'); // gender
        $table->string('pic')->nullable(); // profile picture
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
