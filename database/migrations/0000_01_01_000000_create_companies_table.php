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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('altername')->nullable();
            $table->string('corpreason');
            $table->string('cnpj');
            $table->string('subnumber'); // Número da filial
            $table->string('subname'); // Nome da filial
            $table->string('cep');
            $table->string('state');
            $table->string('city')->nullable();
            $table->string('district');
            $table->string('street')->nullable(); // Logradouro
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('telephone');
            $table->string('status');
            $table->string('whatsapp', 20)->nullable();
            $table->text('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
