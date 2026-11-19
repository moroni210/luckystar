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
    Schema::create('carrinhos', function (Blueprint $table) {
        $table->id();

        $table->foreignId('usuario_id')
            ->nullable()
            ->constrained('usuario')
            ->nullOnDelete();

        $table->foreignId('produto_id')
            ->constrained('produtos')
            ->cascadeOnDelete();

        $table->integer('quantidade')->default(1);

        $table->decimal('preco', 10, 2);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('tipo_acessorio');
        });
    }
};
