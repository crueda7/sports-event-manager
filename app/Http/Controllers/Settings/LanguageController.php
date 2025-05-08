<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

class LanguageController extends Controller
{
    /**
     * Update the application language.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'locale' => 'required|in:es,en',
        ]);
        
        $locale = $validated['locale'];
        
        App::setLocale($locale);
        session(['locale' => $locale]);

        return redirect()->back()->with([
            'forceReload' => true,
        ]);
    }
}
