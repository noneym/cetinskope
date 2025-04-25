<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->front_photo ? asset('storage/' . $this->front_photo) : null;
    }

    public function getLeftPhotoUrlAttribute() {
        return $this->left_photo ? asset('storage/' . $this->left_photo) : null;
    }

    public function getRightPhotoUrlAttribute() {
        return $this->right_photo ? asset('storage/' . $this->right_photo) : null;
    }
}
