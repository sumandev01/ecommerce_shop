<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Media;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('sku_code');
            $table->float('price');
            $table->float('buy_price')->default(0);
            $table->float('discount_price')->default(0);
            $table->integer('reviews')->default(0);
            $table->float('rating')->default(0);
            $table->integer('stock')->default(0);
            $table->foreignIdFor(Media::class)->nullable()->constrained()->cascadeOnDelete();
            $table->integer('status')->default(0);
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
