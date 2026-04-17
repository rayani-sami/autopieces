<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('reference')->nullable()->unique();
            $table->string('oem_reference')->nullable();
            $table->text('description')->nullable();
            $table->text('technical_specs')->nullable();
            $table->decimal('price', 10, 3);
            $table->decimal('price_old', 10, 3)->nullable();
            $table->integer('stock')->default(0);
            $table->string('brand')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_new')->default(false);
            $table->integer('sort_order')->default(0);
            $table->integer('views')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->string('alt')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
        Schema::create('engine_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('engine_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unique(['engine_id','product_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('engine_product');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
    }
};
