<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\Category;
use App\Models\SubCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SubCategory::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Brand::class)->nullable()->constrained()->cascadeOnDelete();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->text('additional_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
