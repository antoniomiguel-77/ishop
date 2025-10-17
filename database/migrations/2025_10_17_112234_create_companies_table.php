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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('phone')->nullable();
            $table->string('otherphone')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable()->default("Angola");
            $table->string('taxpayer')->nullable()->unique();
            $table->string('website')->nullable();
            $table->string('currency')->default('AOA');
            $table->string('invoiceSerie')->nullable();
            $table->enum('regime', ['Geral', 'Simplificado', 'Exclusão'])->nullable();
            $table->decimal('tax', 60, 2)->default(0.00);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
