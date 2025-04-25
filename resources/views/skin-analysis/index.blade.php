@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Yapay Zeka Destekli Cilt Analizi</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Üç farklı açıdan çekilmiş yüz fotoğraflarınızı yükleyin, gelişmiş yapay zeka teknolojimiz
            ile anlık cilt analizi alın ve kişiselleştirilmiş bakım önerilerine ulaşın.
        </p>
    </div>

    <div class="card p-6">
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Nasıl Çalışır?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-pink-50 p-4 rounded-lg text-center">
                    <div class="w-16 h-16 mx-auto bg-pink-200 rounded-full flex items-center justify-center mb-3">
                        <span class="text-pink-600 text-2xl font-bold">1</span>
                    </div>
                    <h4 class="font-medium text-gray-800 mb-2">Fotoğraflarınızı Yükleyin</h4>
                    <p class="text-gray-600 text-sm">Önden, sağ ve sol profilden çekilmiş 3 fotoğrafınızı sistem yükleyin.</p>
                </div>
                <div class="bg-pink-50 p-4 rounded-lg text-center">
                    <div class="w-16 h-16 mx-auto bg-pink-200 rounded-full flex items-center justify-center mb-3">
                        <span class="text-pink-600 text-2xl font-bold">2</span>
                    </div>
                    <h4 class="font-medium text-gray-800 mb-2">Yapay Zeka Analizi</h4>
                    <p class="text-gray-600 text-sm">Gelişmiş AI teknolojimiz cildinizi detaylı olarak analiz eder.</p>
                </div>
                <div class="bg-pink-50 p-4 rounded-lg text-center">
                    <div class="w-16 h-16 mx-auto bg-pink-200 rounded-full flex items-center justify-center mb-3">
                        <span class="text-pink-600 text-2xl font-bold">3</span>
                    </div>
                    <h4 class="font-medium text-gray-800 mb-2">Raporunuzu Alın</h4>
                    <p class="text-gray-600 text-sm">Detaylı cilt analiz raporunuzu görüntüleyin ve PDF olarak indirin.</p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-6">Cilt Analizi Formu</h3>

            @livewire('skin-analysis-form')
        </div>
    </div>

    <div class="mt-12 bg-gray-50 p-6 rounded-lg">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Çetinkaya Beauty Hakkında</h3>
        <p class="text-gray-600 mb-4">
            Çetinkaya Beauty, en son teknoloji ve deneyimli uzmanları ile cilt bakımı ve güzellik hizmetleri sunan bir merkezdir.
            Kişiye özel tedavi planları ve profesyonel yaklaşımımız ile müşterilerimizin memnuniyetini en üst düzeye çıkarmak için çalışıyoruz.
        </p>
        <p class="text-gray-600">
            CetinScope, Çetinkaya Beauty'nin ücretsiz cilt analiz platformudur. Yapay zeka teknolojisi sayesinde, cildinizin durumunu hızlıca analiz edip size en uygun tedavi
            önerilerini sunuyoruz.
        </p>
    </div>
</div>
@endsection