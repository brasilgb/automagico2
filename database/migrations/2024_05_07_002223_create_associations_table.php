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
        Schema::create('associations', function (Blueprint $table) {
            $table->string('id')->primary()->index();
            $table->foreignId('organization_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('cnpj');
            $table->string('filial');
            $table->string('dtvenda');
            $table->string('assoc');
            $table->string('descassoc');
            $table->string('valdevolucao', 15,2);
            $table->string('valvenda', 15,2);
            $table->string('valmeta', 15,2);
            $table->string('margem', 15,2);
            $table->string('representa', 15,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('associations');
    }
};
