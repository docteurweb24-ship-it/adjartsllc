<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Vérifier si la colonne images existe et la supprimer
        if (Schema::hasColumn('products', 'images')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('images');
            });
        }
        
        // Puis recréer la colonne images proprement
        Schema::table('products', function (Blueprint $table) {
            $table->text('images')->nullable()->after('description');
        });

        // Créer la table promotions si elle n'existe pas
        if (!Schema::hasTable('promotions')) {
            Schema::create('promotions', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->text('description');
                $table->enum('type', ['percentage', 'fixed'])->default('percentage');
                $table->decimal('value', 8, 2);
                $table->decimal('min_amount', 10, 2)->nullable();
                $table->integer('usage_limit')->nullable();
                $table->integer('used_count')->default(0);
                $table->datetime('starts_at');
                $table->datetime('expires_at');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // Créer la table pivot category_promotion si elle n'existe pas
        if (!Schema::hasTable('category_promotion')) {
            Schema::create('category_promotion', function (Blueprint $table) {
                $table->id();
                $table->foreignId('category_id')->constrained()->onDelete('cascade');
                $table->foreignId('promotion_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        // En cas de rollback, supprimer les tables créées
        Schema::dropIfExists('category_promotion');
        Schema::dropIfExists('promotions');
        
        // Remettre la colonne images
        if (Schema::hasColumn('products', 'images')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('images');
            });
        }
    }
};