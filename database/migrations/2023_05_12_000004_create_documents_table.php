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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('original_file_name');
            $table->string('file_path');
            $table->foreignId('file_type_id')->constrained();
            $table->foreignId('from_department_id')->constrained('departments');
            $table->foreignId('to_department_id')->constrained('departments');
            $table->foreignId('created_by')->constrained('users');
            $table->text('description')->nullable();
            $table->text('description_dari')->nullable();
            $table->text('description_pashto')->nullable();
            $table->string('status')->default('pending'); // pending, received, completed, rejected
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('viewed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('encryption_key')->nullable();
            $table->string('encryption_iv')->nullable();
            $table->boolean('is_encrypted')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
