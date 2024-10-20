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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('subscription_plan_id')->constrained(); // Lien avec le plan d'abonnement
            $table->date('start_date'); // Date de début de l'abonnement
            $table->date('end_date'); 
            $table->date('renewal_date');
            $table->integer('renewal_count')->default(0);
            $table->boolean('is_active')->default(true);// Date de fin de l'abonnement
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
