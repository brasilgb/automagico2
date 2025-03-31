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
        Schema::create('sales', function (Blueprint $table) {
            $table->string('id')->primary()->index();
            $table->foreignId('organization_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('cnpj');
            $table->string('filial');
            $table->string('descfilial');
            $table->string('dtvenda');
            $table->string('anomes');
            $table->string('valdevolucao', 15,2);
            $table->string('valvenda', 15,2);
            $table->string('valmeta', 15,2);
            $table->string('margem', 15,2);
            $table->string('representa', 15,4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};