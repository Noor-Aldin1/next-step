<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TranslationService;

class TranslationController extends Controller
{
    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function translateText(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $translatedText = $this->translationService->translate($request->text, 'ar'); // Translate to Arabic

        return response()->json(['translatedText' => $translatedText]);
    }
}
