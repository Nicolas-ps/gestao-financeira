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
        Schema::create('debts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->string('category');
            $table->date('date');
            $table->decimal('value', 10);
            $table->string('status');
            $table->integer('payment_method_id');
            $table->integer('installment')->nullable();
            $table->integer('installment_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts');
    }
};
