<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
    public function edit()
    {
        $settings = [
            'site_name' => config('app.name', 'ADJ ARTS'),
            'site_description' => config('site.description', ''),
            'contact_email' => config('site.contact_email', ''),
            'contact_phone' => config('site.contact_phone', ''),
            'address' => config('site.address', ''),
            'whatsapp_number' => config('site.whatsapp_number', ''),
            'amazon_store_url' => config('site.amazon_store_url', ''),
            'meta_title' => config('site.meta_title', ''),
            'meta_description' => config('site.meta_description', ''),
            'meta_keywords' => config('site.meta_keywords', ''),
        ];
        
        return view('admin.settings.site', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'whatsapp_number' => 'nullable|string|max:20',
            'amazon_store_url' => 'nullable|url',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
        ]);

        // Mettre à jour la configuration de l'application
        config(['app.name' => $validated['site_name']]);
        
        // Mettre à jour les paramètres du site
        $siteSettings = [
            'description' => $validated['site_description'],
            'contact_email' => $validated['contact_email'],
            'contact_phone' => $validated['contact_phone'],
            'address' => $validated['address'],
            'whatsapp_number' => $validated['whatsapp_number'],
            'amazon_store_url' => $validated['amazon_store_url'],
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
            'meta_keywords' => $validated['meta_keywords'],
        ];

        config(['site' => $siteSettings]);

        // Sauvegarder dans un fichier de configuration
        $this->saveSettings($siteSettings);

        return redirect()->route('admin.site-settings.edit')->with('success', 'Paramètres du site mis à jour avec succès');
    }

    private function saveSettings($settings)
    {
        $content = '<?php return ' . var_export($settings, true) . ';';
        file_put_contents(config_path('site.php'), $content);
    }
}