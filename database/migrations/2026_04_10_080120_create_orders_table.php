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
     Schema::create('orders', function (Blueprint $table) {
    $table->id();

    // 🔴 مهم بزاف: ربط مع المستخدم
    $table->unsignedBigInteger('customer_id');

    $table->decimal('total_price', 10, 2)->default(0);

    $table->enum('status', [
        'pending',
        'processing',
        'shipped',
        'delivered'
    ])->default('pending');

    $table->timestamps();

    // (اختياري ولكن احترافي)
    $table->foreign('customer_id')
          ->references('id')
          ->on('customers')
          ->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};