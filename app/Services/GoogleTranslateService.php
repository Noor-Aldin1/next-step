<?php

namespace App\Services;

use GuzzleHttp\Client;

class TranslationService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('GOOGLE_TRANSLATE_API_KEY'); // Store your API key in .env
    }

    public function translate($text, $targetLanguage)
    {
        $response = $this->client->post('https://translation.googleapis.com/language/translate/v2', [
            'json' => [
                'q' => $text,
                'target' => $targetLanguage,
                'key' => $this->apiKey,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return $data['data']['translations'][0]['translatedText'] ?? $text; // Return original text if translation fails
    }
}
