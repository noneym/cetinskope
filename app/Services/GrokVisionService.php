<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GrokVisionService {
    protected $apiKey;
    protected $endpoint;
    protected $model;

    public function __construct() {
        $this->apiKey = env('GROK_API_KEY', 'xai-WdIDxrkkVRsVMSYlVdmbtr0x6XIqZ8xtcrRYu8RI8FEV6CxTgT0Ss3cfz5YMIwiRg6t4BxhdnJqLbnZ5');
        $this->endpoint = 'https://api.x.ai/v1/chat/completions';
        $this->model = 'grok-2-vision-1212';
    }

    public function analyzeSkinPhotos(array $imagePaths) {
        try {
            $imagesBase64 = array_map(function ($path) {
                return [
                    "type" => "image_url",
                    "image_url" => [
                        "url" => "data:image/jpeg;base64," . base64_encode(file_get_contents(storage_path('app/public/' . $path)))
                    ]
                ];
            }, $imagePaths);

            $prompt = "Bu cilt fotoğraflarını analiz et. Aşağıdaki başlıkları detaylandır:
            1. Kırışıklıklar: Yüzdeki kırışıklıkların yeri ve şiddeti
            2. Hacim kaybı: Yüzde hacim kaybı olan bölgeler
            3. Leke: Pigmentasyon durumu, leke tipi ve yerleşimi
            4. Sarkma: Cilt elastikiyeti ve sarkma bölgeleri
            5. Önerilen Estetik İşlemler: Bu sorunlara yönelik tedavi önerileri

            Lütfen profesyonel bir estetik danışmanı gibi kapsamlı bir analiz sun.";

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer {$this->apiKey}",
            ])->post($this->endpoint, [
                "model" => $this->model,
                "stream" => false,
                "temperature" => 0.5,
                "messages" => [
                    [
                        "role" => "system",
                        "content" => "You are a professional aesthetic assistant analyzing general facial skin condition for Çetinkaya Beauty."
                    ],
                    [
                        "role" => "user",
                        "content" => array_merge([
                            ["type" => "text", "text" => $prompt]
                        ], $imagesBase64)
                    ]
                ]
            ]);

            if ($response->successful()) {
                return $response['choices'][0]['message']['content'];
            } else {
                Log::error("Grok API Error: " . $response->body());
                return "Analiz sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyin.";
            }
        } catch (\Exception $e) {
            Log::error("Exception in GrokVisionService: " . $e->getMessage());
            return "Fotoğraflar analiz edilirken bir hata oluştu. Lütfen daha sonra tekrar deneyin.";
        }
    }
}
