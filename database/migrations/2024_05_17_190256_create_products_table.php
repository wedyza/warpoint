<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('category_id')->nullable(false)->constrained()->cascadeOnDelete();
            $table->string('name')->nullable(false);
            $table->string('description')->nullable(false);
            $table->integer('price')->nullable(false);
            $table->string('avatar')->nullable(false);
            $table->foreignId('subcategory_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
