<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();

            // اسم العامل أو المقاول
            $table->string('name');

            // رقم الهاتف
            $table->string('phone')->nullable();

            // الوظيفة
            $table->string('job_title')->nullable();

            // نوع التعامل
            $table->enum('type', [
                'worker',
                'contractor',
            ])->default('worker');

            // المبلغ المستحق للعامل
            $table->decimal('total_due', 15, 2)->default(0);

            // المبلغ المدفوع
            $table->decimal('total_paid', 15, 2)->default(0);

            // ملاحظات
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('name');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};