<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SkinAnalysis extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'front_photo',
        'left_photo',
        'right_photo',
        'analysis_result',
        'session_id',
    ];

    // Fotoğraf yollarını tam URL'lere dönüştürme
    public function getFrontPhotoUrlAttribute() {
        return $this->front_photo ? Storage::disk('r2')->url($this->front_photo) : null;
    }

    public function getLeftPhotoUrlAttribute() {
        return $this->left_photo ? Storage::disk('r2')->url($this->left_photo) : null;
    }

    public function getRightPhotoUrlAttribute() {
        return $this->right_photo ? Storage::disk('r2')->url($this->right_photo) : null;
    }
}
