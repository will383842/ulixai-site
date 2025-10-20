<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\DB;


class AdminSettingsController extends Controller
{
    public function settings(Request $request)
    {
        try {
            $settings = SiteSetting::firstOrCreate(
                [],
                [
                    'site_name' => config('app.name', 'Default Site'),
                    'legal_info' => [
                        'publisher' => '',
                        'ip' => '',
                        'liability' => '',
                        'privacy' => '',
                        'law' => '',
                    ]
                ]
            );

            if ($request->isMethod('post') || $request->isMethod('patch')) {
                return $this->updateSettings($request, $settings);
            }

            return view('admin.dashboard.settings.index', compact('settings'));
        } catch (\Exception $e) {
            return back()->with(['error' => 'Unable to load settings. Please try again.']);
        }
    }

    private function updateSettings(Request $request, SiteSetting $settings)
    {
        try {
            $validated = $request->validate([
                'site_name' => 'required|string|max:255',
                'publisher' => 'nullable|string|max:1000',
                'ip' => 'nullable|string|max:1000',
                'liability' => 'nullable|string|max:1000',
                'privacy' => 'nullable|string|max:1000',
                'law' => 'nullable|string|max:1000',
            ], [
                'site_name.required' => 'Site name is required.',
                'site_name.max' => 'Site name cannot exceed 255 characters.',
                '*.max' => 'Field cannot exceed 1000 characters.',
            ]);

            DB::transaction(function () use ($validated, $settings) {
             
                $settings->site_name = trim($validated['site_name']);
                
              
                $currentLegalInfo = $settings->legal_info ?? [];
                $settings->legal_info = array_merge($currentLegalInfo, [
                    'publisher' => $this->sanitizeText($validated['publisher'] ?? ''),
                    'ip' => $this->sanitizeText($validated['ip'] ?? ''),
                    'liability' => $this->sanitizeText($validated['liability'] ?? ''),
                    'privacy' => $this->sanitizeText($validated['privacy'] ?? ''),
                    'law' => $this->sanitizeText($validated['law'] ?? ''),
                    'updated_at' => now()->toDateTimeString(),
                ]);

                $settings->save();
            });

            return redirect()->route('admin.settings')->with('success', 'Settings updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with(['error' => 'Failed to update settings. Please try again.'])->withInput();
        }
    }

   
    private function sanitizeText(?string $text): string
    {
        if (empty($text)) {
            return '';
        }

        
        $text = strip_tags($text, '<p><br><strong><em><ul><ol><li>');
        $text = trim($text);
        
        return $text;
    }

   
    public function getSetting(string $key, $default = null)
    {
        try {
            $settings = SiteSetting::first();
            
            if (!$settings) {
                return $default;
            }

       
            if (str_contains($key, '.')) {
                $keys = explode('.', $key);
                $value = $settings;
                
                foreach ($keys as $nestedKey) {
                    if (is_array($value) && isset($value[$nestedKey])) {
                        $value = $value[$nestedKey];
                    } elseif (is_object($value) && isset($value->$nestedKey)) {
                        $value = $value->$nestedKey;
                    } else {
                        return $default;
                    }
                }
                
                return $value;
            }

            return $settings->$key ?? $default;
        } catch (\Exception $e) {
            return $default;
        }
    }

    
    public function getSettingsJson(Request $request)
    {
        try {
            $settings = SiteSetting::first();
            
            if (!$settings) {
                return response()->json(['error' => 'Settings not found'], 404);
            }

      
            $publicSettings = [
                'site_name' => $settings->site_name,
                'legal_info' => $settings->legal_info ?? []
            ];

            return response()->json($publicSettings);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch settings'], 500);
        }
    }

}
