<?php

use App\Models\ReasonTax;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ReasonTax::class)->nullable();
            $table->string('name', 255);
            $table->string('code', 255)->unique();
            $table->decimal('price', 60, 2);
            $table->decimal('quantity', 60, 2);
            $table->decimal('retention', 60, 2)->nullable();
            $table->enum('type', ["unit", "service"])->nullable();
            $table->decimal('tax', 60, 2)->nullable();
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->boolean('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
