<?php

use App\Enums\WeightUnit;
use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained(app(Product::class)->getTable())
                ->cascadeOnDelete();

            $table->foreignId('ingredient_id')
                ->constrained(app(Ingredient::class)->getTable())
                ->cascadeOnDelete();

            $table->double('required_amount')->default(0);
            $table->enum('unit', WeightUnit::all());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
