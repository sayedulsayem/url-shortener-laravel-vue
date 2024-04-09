<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleSafeBrowsingService {
    private $apiKey;
    private $endPoint;

    public function __construct() {
        $this->apiKey = env('GOOGLE_SAFE_BROWSING_API_KEY');
        $this->endPoint = 'https://safebrowsing.googleapis.com/v4/threatMatches:find';
    }

    public function checkUrl($url) {
        $apiUrl = $this->endPoint . '?key=' . $this->apiKey;

        try {
            $response = Http::post($apiUrl, [
                'client' => [
                    'clientId' => 'url-shortener-laravel-vue',
                    'clientVersion' => '1.0.0'
                ],
                'threatInfo' => [
                    'threatTypes' => ['MALWARE', 'SOCIAL_ENGINEERING', 'UNWANTED_SOFTWARE', 'POTENTIALLY_HARMFUL_APPLICATION'],
                    'platformTypes' => ['ANY_PLATFORM'],
                    'threatEntryTypes' => ['URL'],
                    'threatEntries' => [
                        ['url' => $url]
                    ]
                ]
            ]);
        } catch (\Exception $exception) {
            return [
                'status' => false,
                'message' => 'Unable to process remote request.',
                'error' => $exception->getMessage(),
            ];
        }

        return json_decode($response->body(), true);
    }

    public function isSafe($url, $threatInfo = false) {
        $checkUrl = $this->checkUrl($url);

        if (empty($checkUrl['matches'])) {
            return true;
        }

        if ($threatInfo) {
            return $checkUrl['matches'][0]['threatType'];
        }

        return false;
    }
}
