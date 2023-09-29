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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->year('batch_year');
            $table->date('joined');
            $table->decimal('gpa', 3, 1)->default(0.0);
            $table->date('verbal_warning')->nullable()->default(null);
            $table->date('written_warning')->nullable()->default(null);
            $table->date('provisionary')->nullable()->default(null);
            $table->enum('status', ['active', 'inactive']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
