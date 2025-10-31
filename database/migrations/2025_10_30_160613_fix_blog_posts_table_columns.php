<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            // Vérifier et ajouter uniquement les colonnes manquantes
            
            if (!Schema::hasColumn('blog_posts', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('excerpt');
            }
            
            if (!Schema::hasColumn('blog_posts', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            
            if (!Schema::hasColumn('blog_posts', 'is_published')) {
                $table->boolean('is_published')->default(true)->after('meta_description');
            }
            
            if (!Schema::hasColumn('blog_posts', 'featured_image')) {
                $table->string('featured_image')->nullable()->after('is_published');
            }
            
            if (!Schema::hasColumn('blog_posts', 'slug')) {
                $table->string('slug')->unique()->after('title');
            } else {
                // S'assurer que slug est unique
                $table->string('slug')->unique()->change();
            }
            
            if (!Schema::hasColumn('blog_posts', 'excerpt')) {
                $table->text('excerpt')->nullable()->after('content');
            }
        });
    }

    public function down()
    {
        // Pas de rollback nécessaire pour cette correction
    }
};