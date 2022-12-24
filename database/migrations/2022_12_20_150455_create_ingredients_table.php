<?php

use App\Enums\WeightUnit;
use App\Models\Marchant;
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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->double('total_amount')->default(0);
            $table->double('available_amount')->default(0);
            $table->enum('unit', WeightUnit::all());

            $table->foreignId('marchant_id')
                ->nullable()
                ->constrained(app(Marchant::class)->getTable())
                ->nullOnDelete();

            $table->boolean('is_notified')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
