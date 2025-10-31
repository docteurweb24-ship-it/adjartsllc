<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AppearanceController extends Controller
{
    public function editHeader()
    {
        $headerSettings = [
            'logo_url' => Cache::get('header_logo_url'),
            'nav_item1_text' => Cache::get('header_nav_item1_text', 'Collections'),
            'nav_item1_url' => Cache::get('header_nav_item1_url', '/collections'),
            'nav_item2_text' => Cache::get('header_nav_item2_text', 'À propos'),
            'nav_item2_url' => Cache::get('header_nav_item2_url', '/a-propos'),
            'nav_item3_text' => Cache::get('header_nav_item3_text', 'Blog'),
            'nav_item3_url' => Cache::get('header_nav_item3_url', '/blog'),
            'cta_text' => Cache::get('header_cta_text', 'Contactez-nous'),
            'cta_url' => Cache::get('header_cta_url', '/contact'),
        ];

        return view('admin.appearance.header', compact('headerSettings'));
    }

    public function updateHeader(Request $request)
    {
        $validated = $request->validate([
            'nav_item1_text' => 'required|string|max:50',
            'nav_item1_url' => 'required|string|max:255',
            'nav_item2_text' => 'required|string|max:50',
            'nav_item2_url' => 'required|string|max:255',
            'nav_item3_text' => 'required|string|max:50',
            'nav_item3_url' => 'required|string|max:255',
            'cta_text' => 'required|string|max:50',
            'cta_url' => 'required|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            Cache::forever('header_' . $key, $value);
        }

        return redirect()->route('admin.header.edit')
                         ->with('success', 'Paramètres du header mis à jour avec succès!');
    }

    public function editFooter()
    {
        $footerSettings = [
            'description' => Cache::get('footer_description', 'ADJ ARTS - Créations artistiques uniques et bijoux de luxe'),
            'phone' => Cache::get('footer_phone'),
            'email' => Cache::get('footer_email', 'contact@adj-arts.com'),
            'address' => Cache::get('footer_address'),
            'link1_text' => Cache::get('footer_link1_text', 'Nos collections'),
            'link1_url' => Cache::get('footer_link1_url', '/collections'),
            'link2_text' => Cache::get('footer_link2_text', 'Notre histoire'),
            'link2_url' => Cache::get('footer_link2_url', '/a-propos'),
            'copyright_text' => Cache::get('footer_copyright_text', '© 2024 ADJ ARTS. Tous droits réservés.'),
            'privacy_url' => Cache::get('footer_privacy_url', '/privacy'),
            'terms_url' => Cache::get('footer_terms_url', '/terms'),
        ];

        return view('admin.appearance.footer', compact('footerSettings'));
    }

    public function updateFooter(Request $request)
    {
        $validated = $request->validate([
            'footer_description' => 'nullable|string|max:500',
            'footer_phone' => 'nullable|string|max:20',
            'footer_email' => 'nullable|email',
            'footer_address' => 'nullable|string|max:500',
            'link1_text' => 'required|string|max:50',
            'link1_url' => 'required|string|max:255',
            'link2_text' => 'required|string|max:50',
            'link2_url' => 'required|string|max:255',
            'copyright_text' => 'required|string|max:255',
            'privacy_url' => 'required|string|max:255',
            'terms_url' => 'required|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            Cache::forever(str_replace('footer_', '', $key), $value);
        }

        return redirect()->route('admin.footer.edit')
                         ->with('success', 'Paramètres du footer mis à jour avec succès!');
    }

    public function uploadMedia(Request $request)
    {
        // Gérer l'upload de médias
        return response()->json(['success' => true]);
    }

    public function deleteMedia($id)
    {
        // Gérer la suppression de médias
        return response()->json(['success' => true]);
    }
}