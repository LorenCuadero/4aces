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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable()->default('N/A');
            $table->string('last_name');
            $table->string('department')->default('Administrative');
            $table->string('birthdate');
            $table->string('gender')->default('Male');
            $table->string('address');
            $table->string('civil_status');
            $table->string('contact_number')->nullable();
            $table->string('email');
            $table->string('password');

            $table->unsignedBigInteger('user_id');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
