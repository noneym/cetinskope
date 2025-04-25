<?php

namespace App\Livewire;

use App\Models\SkinAnalysis;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class SkinAnalysisResult extends Component {
    public $analysis;
    public $sessionId;
    public $parsedResult;

    public function mount($session_id) {
        $this->sessionId = $session_id;
        $this->analysis = SkinAnalysis::where('session_id', $this->sessionId)->firstOrFail();

        // Analiz sonucunu daha kullanışlı bir formata çevir
        $this->parseAnalysisResult();
    }

    private function parseAnalysisResult() {
        $result = $this->analysis->analysis_result;

        // Başlıkları bul
        preg_match_all('/\*\*(.*?):\*\*/', $result, $matches);

        $sections = [];
        if (isset($matches[1])) {
            $mainSections = $matches[1];

            foreach ($mainSections as $index => $section) {
                // Başlık ve içerik parçalarını bul
                $pattern = '/\*\*' . preg_quote($section, '/') . ':\*\*(.*?)(?=\*\*|$)/s';
                preg_match($pattern, $result, $contentMatch);

                if (isset($contentMatch[1])) {
                    $content = trim($contentMatch[1]);
                    // Alt maddeleri bul
                    $items = [];
                    preg_match_all('/(\d+\.\s.*?)(?=\d+\.|$)/s', $content, $itemMatches);

                    if (!empty($itemMatches[1])) {
                        foreach ($itemMatches[1] as $item) {
                            $items[] = trim($item);
                        }
                    } else {
                        // Alt madde yoksa içeriği direkt ekle
                        $items[] = $content;
                    }

                    $sections[$section] = $items;
                }
            }
        }

        $this->parsedResult = $sections;
    }

    public function downloadPdf() {
        $analysis = $this->analysis;
        $parsedResult = $this->parsedResult;

        $pdf = PDF::loadView('pdf.skin-analysis', compact('analysis', 'parsedResult'));

        // PDF Türkçe karakter desteği için yapılandırma
        $pdf->setOptions([
            'default-font' => 'DejaVu Sans',
            'encoding' => 'UTF-8',
            'font-dir' => storage_path('fonts/'),
            'font-cache' => storage_path('fonts/'),
            'enable-local-file-access' => true,
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'cilt-analizi.pdf');
    }

    public function render() {
        return view('livewire.skin-analysis-result');
    }
}
