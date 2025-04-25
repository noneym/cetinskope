<?php

namespace App\Http\Controllers;

use App\Models\SkinAnalysis;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SkinAnalysisController extends Controller {
    public function index() {
        return view('skin-analysis.index');
    }

    public function result($session_id) {
        // Livewire component kullanacağımız için boş görünüm yeterli
        return view('skin-analysis.result', compact('session_id'));
    }

    public function downloadPdf($session_id) {
        $analysis = SkinAnalysis::where('session_id', $session_id)->firstOrFail();

        // Analiz sonucunu daha kullanışlı bir formata çevir
        $parsedResult = $this->parseAnalysisResult($analysis->analysis_result);

        $pdf = PDF::loadView('pdf.skin-analysis', compact('analysis', 'parsedResult'));

        // PDF Türkçe karakter desteği için yapılandırma
        $pdf->setOptions([
            'default-font' => 'DejaVu Sans',
            'encoding' => 'UTF-8',
            'font-dir' => storage_path('fonts/'),
            'font-cache' => storage_path('fonts/'),
            'enable-local-file-access' => true,
        ]);

        return $pdf->download('cilt-analizi.pdf');
    }

    private function parseAnalysisResult($result) {
        // SkinAnalysisResult bileşenindeki ile aynı fonksiyon
        preg_match_all('/\*\*(.*?):\*\*/', $result, $matches);

        $sections = [];
        if (isset($matches[1])) {
            $mainSections = $matches[1];

            foreach ($mainSections as $index => $section) {
                $pattern = '/\*\*' . preg_quote($section, '/') . ':\*\*(.*?)(?=\*\*|$)/s';
                preg_match($pattern, $result, $contentMatch);

                if (isset($contentMatch[1])) {
                    $content = trim($contentMatch[1]);
                    $items = [];
                    preg_match_all('/(\d+\.\s.*?)(?=\d+\.|$)/s', $content, $itemMatches);

                    if (!empty($itemMatches[1])) {
                        foreach ($itemMatches[1] as $item) {
                            $items[] = trim($item);
                        }
                    } else {
                        $items[] = $content;
                    }

                    $sections[$section] = $items;
                }
            }
        }

        return $sections;
    }
}
