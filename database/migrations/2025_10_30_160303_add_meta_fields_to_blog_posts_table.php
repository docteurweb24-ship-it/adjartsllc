<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            // Ajouter les colonnes manquantes
            $table->string('meta_title')->nullable()->after('excerpt');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->boolean('is_published')->default(true)->after('meta_description');
            $table->string('featured_image')->nullable()->after('is_published');
            $table->string('slug')->unique()->after('title'); // S'assurer que slug existe et est unique
            
            // Si excerpt n'existe pas non plus
            if (!Schema::hasColumn('blog_posts', 'excerpt')) {
                $table->text('excerpt')->nullable()->after('content');
            }
        });
    }

    public function down()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description', 'is_published', 'featured_image', 'slug', 'excerpt']);
        });
    }
};