<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('address')->nullable();

            $table->decimal('total_due', 15, 2)->default(0);
            $table->decimal('total_paid', 15, 2)->default(0);

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('name');
            $table->index('phone');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};

