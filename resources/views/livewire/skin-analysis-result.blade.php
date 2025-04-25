<div>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Cilt Analiz Sonuçlarınız</h2>
        <p class="text-gray-600">
            Sayın <span class="font-medium">{{ $analysis->name }}</span>, yapay zeka destekli detaylı cilt analiz raporunuz hazır.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="card p-4">
            <img src="{{ asset('storage/' . $analysis->front_photo) }}" alt="Ön Profil" class="w-full h-48 object-cover rounded-lg mb-2">
            <p class="text-center text-sm text-gray-600">Ön Profil</p>
        </div>
        <div class="card p-4">
            <img src="{{ asset('storage/' . $analysis->left_photo) }}" alt="Sol Profil" class="w-full h-48 object-cover rounded-lg mb-2">
            <p class="text-center text-sm text-gray-600">Sol Profil</p>
        </div>
        <div class="card p-4">
            <img src="{{ asset('storage/' . $analysis->right_photo) }}" alt="Sağ Profil" class="w-full h-48 object-cover rounded-lg mb-2">
            <p class="text-center text-sm text-gray-600">Sağ Profil</p>
        </div>
    </div>

    <div class="card p-6 mb-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Cilt Analiz Raporu</h3>

        @foreach($parsedResult as $section => $items)
        <div class="mb-6">
            <h4 class="text-xl font-semibold text-pink-700 mb-3">{{ $section }}</h4>
            <div class="bg-pink-50 p-4 rounded-lg">
                <ul class="list-disc list-inside space-y-2">
                    @foreach($items as $item)
                    <li class="text-gray-700">{!! nl2br(e($item)) !!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach

        <div class="mt-8 text-center">
            <button wire:click="downloadPdf" class="btn-primary inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                PDF Olarak İndir
            </button>
        </div>
    </div>

    <div class="card p-6 bg-pink-50">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Sonraki Adımlar</h3>
        <p class="text-gray-700 mb-4">
            Bu analiz genel bir değerlendirmedir ve profesyonel bir konsültasyon yerine geçmez.
            Daha detaylı bilgi ve kişiselleştirilmiş tedavi planı için Çetinkaya Beauty uzmanlarıyla yüz yüze görüşmenizi öneririz.
        </p>

        <div class="bg-white p-4 rounded-lg">
            <h4 class="font-medium text-gray-800 mb-2">Çetinkaya Beauty İletişim</h4>
            <ul class="space-y-2 text-gray-600">
                <li class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg>
                    <span>0212 123 4567</span>
                </li>
                <li class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span>info@cetinkayabeauty.com</span>
                </li>
                <li class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>İstanbul, Türkiye</span>
                </li>
            </ul>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center text-pink-600 hover:text-pink-800">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Ana Sayfaya Dön
            </a>
        </div>
    </div>
</div>