<div>
    <form wire:submit.prevent="submit" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Ad Soyad</label>
                <input type="text" id="name" wire:model="name" class="form-control @error('name') border-red-500 @enderror" placeholder="Adınız Soyadınız">
                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-posta</label>
                <input type="email" id="email" wire:model="email" class="form-control @error('email') border-red-500 @enderror" placeholder="E-posta adresiniz">
                @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Telefon</label>
                <input type="tel" id="phone" wire:model="phone" class="form-control @error('phone') border-red-500 @enderror" placeholder="Telefon numaranız">
                @error('phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="border-t border-gray-200 pt-6">
            <h4 class="text-lg font-medium text-gray-800 mb-4">Fotoğraflarınızı Yükleyin</h4>
            <p class="text-gray-600 text-sm mb-4">En doğru analiz için iyi aydınlatılmış, net ve makyajsız çekilmiş fotoğraflar yükleyin.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ön Profil</label>
                    <label for="frontPhoto" class="input-file-label block @error('frontPhoto') border-red-500 @enderror">
                        <div x-data="{ preview: null }" x-init="
                            $wire.on('frontPhotoUpdated', (event) => {
                                if (event.temporaryUrl) {
                                    preview = event.temporaryUrl;
                                }
                            });
                        ">
                            <template x-if="preview">
                                <img :src="preview" alt="Ön profil fotoğrafı" class="w-full h-32 object-cover rounded mb-2">
                            </template>
                            <template x-if="!preview">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="mt-2 block text-sm text-gray-600">Ön profil fotoğrafını yükle</span>
                                </div>
                            </template>
                        </div>
                        <input type="file" id="frontPhoto" wire:model="frontPhoto" class="hidden" accept="image/*" x-on:change="
                            const file = $event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    $wire.dispatch('frontPhotoUpdated', { temporaryUrl: e.target.result });
                                };
                                reader.readAsDataURL(file);
                            }
                        ">
                    </label>
                    @error('frontPhoto')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sol Profil</label>
                    <label for="leftPhoto" class="input-file-label block @error('leftPhoto') border-red-500 @enderror">
                        <div x-data="{ preview: null }" x-init="
                            $wire.on('leftPhotoUpdated', (event) => {
                                if (event.temporaryUrl) {
                                    preview = event.temporaryUrl;
                                }
                            });
                        ">
                            <template x-if="preview">
                                <img :src="preview" alt="Sol profil fotoğrafı" class="w-full h-32 object-cover rounded mb-2">
                            </template>
                            <template x-if="!preview">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="mt-2 block text-sm text-gray-600">Sol profil fotoğrafını yükle</span>
                                </div>
                            </template>
                        </div>
                        <input type="file" id="leftPhoto" wire:model="leftPhoto" class="hidden" accept="image/*" x-on:change="
                            const file = $event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    $wire.dispatch('leftPhotoUpdated', { temporaryUrl: e.target.result });
                                };
                                reader.readAsDataURL(file);
                            }
                        ">
                    </label>
                    @error('leftPhoto')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sağ Profil</label>
                    <label for="rightPhoto" class="input-file-label block @error('rightPhoto') border-red-500 @enderror">
                        <div x-data="{ preview: null }" x-init="
                            $wire.on('rightPhotoUpdated', (event) => {
                                if (event.temporaryUrl) {
                                    preview = event.temporaryUrl;
                                }
                            });
                        ">
                            <template x-if="preview">
                                <img :src="preview" alt="Sağ profil fotoğrafı" class="w-full h-32 object-cover rounded mb-2">
                            </template>
                            <template x-if="!preview">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="mt-2 block text-sm text-gray-600">Sağ profil fotoğrafını yükle</span>
                                </div>
                            </template>
                        </div>
                        <input type="file" id="rightPhoto" wire:model="rightPhoto" class="hidden" accept="image/*" x-on:change="
                            const file = $event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    $wire.dispatch('rightPhotoUpdated', { temporaryUrl: e.target.result });
                                };
                                reader.readAsDataURL(file);
                            }
                        ">
                    </label>
                    @error('rightPhoto')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="btn-primary w-full" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submit">Cilt Analizi Başlat</span>
                <div wire:loading wire:target="submit" class="flex items-center justify-center">
                    <div class="spinner mr-2"></div>
                    <span>Bekleyin...</span>
                </div>
            </button>

            <p class="text-center text-gray-500 text-sm mt-3">
                Form bilgileriniz sadece analiz amacıyla kullanılacaktır.
            </p>
        </div>
    </form>

    <!-- Analiz Yükleniyor Modal -->
    <div x-data="{ show: false }" x-show="show" x-init="
            $wire.on('startAnalysis', () => { show = true });
            $wire.on('finishAnalysis', () => { show = false });
        " x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="modal" :class="{ 'show': show }"
        style="display: none;">
        <div class="modal-content">
            <div class="loading-animation">
                <div style="width: 120px; height: 120px; position: relative; margin: 0 auto 1rem auto;">
                    <div
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #f8bbd0 0%, #ec407a 100%); animation: pulse 2s infinite;">
                    </div>
                    <div
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 3px solid #ec407a; border-radius: 50%; animation: rotate 2s linear infinite;">
                    </div>
                    <div
                        style="position: absolute; top: 10px; left: 10px; width: calc(100% - 20px); height: calc(100% - 20px); border: 3px dashed #f48fb1; border-radius: 50%; animation: rotate 3s linear infinite reverse;">
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Cilt Analizi Yapılıyor</h3>
                <p class="text-gray-600 mb-4">Fotoğraflarınız yapay zeka tarafından analiz ediliyor...</p>
                <div class="loading-dots">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
                <p class="text-sm text-gray-500 mt-2">Bu işlem birkaç dakika sürebilir.</p>
            </div>
        </div>
    </div>
</div>