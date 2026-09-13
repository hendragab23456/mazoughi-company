<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('client_name')->nullable();
            $table->string('location')->nullable();

            $table->decimal('budget', 15, 2)->default(0);
            $table->decimal('total_expenses', 15, 2)->default(0);

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->enum('status', [
                'planning',
                'active',
                'completed',
                'paused',
                'cancelled'
            ])->default('planning');

            $table->text('description')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
