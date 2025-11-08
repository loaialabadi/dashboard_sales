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
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();

            // فرع الإرسال و فرع الاستلام (مربوطان بجدول branches)
            $table->foreignId('from_branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('to_branch_id')->constrained('branches')->cascadeOnDelete();

            // المنتج المنقول مرتبط بجدول products
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();

            $table->integer('quantity')->unsigned();
            $table->date('transfer_date')->nullable();
            $table->enum('status', ['pending', 'done', 'canceled'])->default('pending');

            // من أنشأ العملية
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->text('note')->nullable();

            $table->timestamps();

            // تسريع بعض الاستعلامات
            $table->index(['from_branch_id']);
            $table->index(['to_branch_id']);
            $table->index(['product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transfers');
    }
};
