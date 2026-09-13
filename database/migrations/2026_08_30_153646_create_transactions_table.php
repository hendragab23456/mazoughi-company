<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // نوع العملية
            $table->enum('type', [
                'expense',
                'income',
                'worker_payment',
                'advance',
                'material_purchase',
                'transport',
            ]);

            // المبلغ
            $table->decimal('amount', 15, 2);

            // طريقة الدفع
            $table->enum('account_type', [
                'cash',
                'bank',
            ]);

            // وصف العملية
            $table->string('description')->nullable();

            // تاريخ العملية الفعلي
            $table->date('transaction_date');

            // حالة الموافقة
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
            ])->default('pending');

            // المستخدم الذي أنشأ العملية
            $table->foreignId('created_by')
                ->constrained('users')
                ->restrictOnDelete();

            // المستخدم الذي وافق/رفض العملية
            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // وقت الموافقة أو الرفض
            $table->timestamp('approved_at')->nullable();

            // سبب الرفض
            $table->text('rejection_reason')->nullable();

            $table->timestamps();

            // لتسريع البحث بالتاريخ والحالة
            $table->index(['transaction_date', 'status']);
            $table->index(['type', 'status']);
            $table->index('account_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};