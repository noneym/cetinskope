<?php

namespace App\Livewire;

use App\Models\SkinAnalysis;
use App\Services\GrokVisionService;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class SkinAnalysisForm extends Component {
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $frontPhoto;
    public $leftPhoto;
    public $rightPhoto;
    public $isLoading = false;
    public $sessionId = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'frontPhoto' => 'required|image|max:5120', // 5MB limit
        'leftPhoto' => 'required|image|max:5120',
        'rightPhoto' => 'required|image|max:5120',
    ];

    protected $messages = [
        'frontPhoto.required' => 'Ön profil fotoğrafı gereklidir.',
        'leftPhoto.required' => 'Sol profil fotoğrafı gereklidir.',
        'rightPhoto.required' => 'Sağ profil fotoğrafı gereklidir.',
        'frontPhoto.image' => 'Yüklenen dosya bir fotoğraf olmalıdır.',
        'leftPhoto.image' => 'Yüklenen dosya bir fotoğraf olmalıdır.',
        'rightPhoto.image' => 'Yüklenen dosya bir fotoğraf olmalıdır.',
        'frontPhoto.max' => 'Fotoğraf 5MB\'dan küçük olmalıdır.',
        'leftPhoto.max' => 'Fotoğraf 5MB\'dan küçük olmalıdır.',
        'rightPhoto.max' => 'Fotoğraf 5MB\'dan küçük olmalıdır.',
    ];

    public function mount() {
        $this->sessionId = (string) Str::uuid();
    }

    public function submit() {
        $this->validate();

        $this->isLoading = true;
        $this->dispatch('startAnalysis');

        // Fotoğrafları kaydet
        $frontPhotoPath = $this->frontPhoto->store('skin-photos', 'public');
        $leftPhotoPath = $this->leftPhoto->store('skin-photos', 'public');
        $rightPhotoPath = $this->rightPhoto->store('skin-photos', 'public');

        // Analiz için fotoğraf yollarını hazırla
        $photoPaths = [
            $frontPhotoPath,
            $leftPhotoPath,
            $rightPhotoPath
        ];

        // Grok Vision API ile analiz yap
        $grokService = new GrokVisionService();
        $analysisResult = $grokService->analyzeSkinPhotos($photoPaths);

        // Veritabanına kaydet
        $analysis = SkinAnalysis::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'front_photo' => $frontPhotoPath,
            'left_photo' => $leftPhotoPath,
            'right_photo' => $rightPhotoPath,
            'analysis_result' => $analysisResult,
            'session_id' => (string) $this->sessionId,
        ]);

        $this->isLoading = false;
        $this->dispatch('finishAnalysis');

        // Sonuç sayfasına yönlendir
        return redirect()->route('skin-analysis.result', ['session_id' => $this->sessionId]);
    }

    public function render() {
        return view('livewire.skin-analysis-form');
    }
}
