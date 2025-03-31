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
        Schema::create('totals', function (Blueprint $table) {
            $table->string('id')->primary()->index();
            $table->foreignId('organization_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('cnpj');
            $table->string('filial');
            $table->string('datatu');
            $table->string('valdev', 15, 2);
            $table->string('valven', 15, 2);
            $table->string('margem', 15, 2);
            $table->string('permet', 15, 2);
            $table->string('projec', 15, 2);
            $table->string('valjur', 15, 2);
            $table->string('perjur', 15, 2);
            $table->string('valina', 15, 2);
            $table->string('perina', 15, 2);
            $table->string('valest', 15, 2);
            $table->string('valmeta', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('totals');
    }
};
