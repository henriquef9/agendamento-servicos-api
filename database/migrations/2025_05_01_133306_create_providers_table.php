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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();

            $table->string('cpf_cnpj', 20);
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->text('description');
            $table->string('phone_number_1', 11);
            $table->string('phone_number_2', 11)->nullable();
            $table->string('cep', 9);
            $table->string('city', 100);
            $table->string('state', 2); // salvar apenas o UF do estado
            $table->string('street', 100);
            $table->string('district', 50);
            $table->string('complement', 250);

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_providers');
    }
};
