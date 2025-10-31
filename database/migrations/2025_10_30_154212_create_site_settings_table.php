<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Paramètres par défaut
        DB::table('site_settings')->insert([
            ['key' => 'site_name', 'value' => 'ADJ ARTS'],
            ['key' => 'site_email', 'value' => 'contact@adjarts.com'],
            ['key' => 'phone', 'value' => '+229 XX XX XX XX'],
            ['key' => 'address', 'value' => ''],
            ['key' => 'whatsapp', 'value' => '+229XXXXXXXXX'],
            ['key' => 'facebook', 'value' => ''],
            ['key' => 'instagram', 'value' => ''],
            ['key' => 'twitter', 'value' => ''],
            ['key' => 'youtube', 'value' => ''],
            ['key' => 'meta_description', 'value' => 'ADJ ARTS - Artisanat africain authentique'],
            ['key' => 'keywords', 'value' => 'bijoux, art africain, artisanat, création'],
            
            // Header
            ['key' => 'nav_item1_text', 'value' => 'Accueil'],
            ['key' => 'nav_item1_url', 'value' => '/'],
            ['key' => 'nav_item2_text', 'value' => 'À Propos'],
            ['key' => 'nav_item2_url', 'value' => '/a-propos'],
            ['key' => 'nav_item3_text', 'value' => 'Collections'],
            ['key' => 'nav_item3_url', 'value' => '/collections'],
            ['key' => 'nav_item4_text', 'value' => 'Blog'],
            ['key' => 'nav_item4_url', 'value' => '/blog'],
            ['key' => 'nav_item5_text', 'value' => 'Promotions'],
            ['key' => 'nav_item5_url', 'value' => '/promotions'],
            ['key' => 'nav_item6_text', 'value' => 'Contact'],
            ['key' => 'nav_item6_url', 'value' => '/contact'],
            ['key' => 'cta_text', 'value' => 'Contactez-nous'],
            ['key' => 'cta_url', 'value' => '/contact'],
            
            // Footer
            ['key' => 'footer_description', 'value' => 'L\'art, les yeux d\'Afrique'],
            ['key' => 'footer_tagline', 'value' => 'Artisanat africain authentique'],
            ['key' => 'footer_phone', 'value' => '+229 XX XX XX XX'],
            ['key' => 'footer_email', 'value' => 'contact@adjarts.com'],
            ['key' => 'footer_whatsapp', 'value' => '+229XXXXXXXXX'],
            ['key' => 'link1_text', 'value' => 'Collections'],
            ['key' => 'link1_url', 'value' => '/collections'],
            ['key' => 'link2_text', 'value' => 'Promotions'],
            ['key' => 'link2_url', 'value' => '/promotions'],
            ['key' => 'link3_text', 'value' => 'Blog'],
            ['key' => 'link3_url', 'value' => '/blog'],
            ['key' => 'copyright_text', 'value' => '© 2024 ADJ ARTS. Tous droits réservés.'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
};