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
        Schema::create('affiliate_commissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Le parrain (user A)
            $table->unsignedBigInteger('referred_user_id'); // L'utilisateur référé (user B)
            $table->decimal('commission_amount', 10, 2);
            $table->integer('renewal_count'); // Compte le nombre de fois où la commission a été payée
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('referred_user_id')->references('id')->on('users');
            $table->decimal('balance', 10, 2)->default(0); // Solde pour les crédits sur la plateforme
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_commissions');
    }
};
