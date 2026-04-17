<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('engines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_model_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->string('fuel_type')->nullable();
            $table->string('displacement')->nullable();
            $table->string('power_hp')->nullable();
            $table->string('engine_code')->nullable();
            $table->year('year_from')->nullable();
            $table->year('year_to')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['car_model_id','slug']);
        });
    }
    public function down(): void { Schema::dropIfExists('engines'); }
};
