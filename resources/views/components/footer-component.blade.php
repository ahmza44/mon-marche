{{-- resources/views/components/footer-component.blade.php --}}

<footer class="relative bg-white border-t border-gray-100 mt-16 overflow-hidden">

    <div class="pointer-events-none absolute inset-0" aria-hidden="true">
        <div style="position:absolute;width:600px;height:600px;border-radius:50%;
                    background:radial-gradient(circle,rgba(255,122,0,0.05) 0%,transparent 70%);
                    top:-250px;left:-150px;"></div>
        <div style="position:absolute;width:500px;height:500px;border-radius:50%;
                    background:radial-gradient(circle,rgba(255,154,53,0.04) 0%,transparent 70%);
                    bottom:-200px;right:-100px;"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 pt-14 pb-0">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 pb-12 border-b border-gray-100">

            {{-- BRAND --}}
            <div class="md:col-span-4 flex flex-col">

                <a href="{{ route('customer.accueil') }}"
                   class="inline-flex items-center gap-3 mb-5 w-fit">

                    <div class="w-11 h-11 rounded-2xl overflow-hidden flex items-center justify-center"
                         style="background:linear-gradient(135deg,#FF7A00,#FF9A35);
                                box-shadow:0 6px 20px rgba(255,122,0,0.32);">
                        <img src="{{ asset('storage/logo/logo.png') }}"
                             class="w-full h-full object-contain" alt="Mon Marché">
                    </div>

                    <span class="brand-font text-gray-900 text-xl font-extrabold tracking-tight">
                        Mon <span class="text-orange-500">Marché</span>
                    </span>
                </a>

                <p class="text-sm text-gray-500 leading-relaxed mb-6 max-w-[270px]">
                    Votre supermarché en ligne au Maroc — produits frais, livraison rapide
                    et paiement 100&nbsp;% sécurisé.
                </p>

                {{-- Social --}}
                <div class="flex gap-2 mt-auto">
                    @foreach([
                        ['icon'=>'facebook',  'href'=>'#'],
                        ['icon'=>'instagram', 'href'=>'#'],
                        ['icon'=>'linkedin',  'href'=>'#'],
                        ['icon'=>'twitter',   'href'=>'#'],
                    ] as $s)
                    <a href="{{ $s['href'] }}"
                       class="group w-9 h-9 rounded-xl flex items-center justify-center
                              border border-gray-200 bg-gray-50 text-gray-400
                              hover:bg-orange-500 hover:border-orange-500 hover:text-white
                              transition-all duration-200">

                        <i data-lucide="{{ $s['icon'] }}"
                           class="w-3.5 h-3.5 transition-transform group-hover:scale-110"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- LINKS --}}
            <div class="md:col-span-8 grid grid-cols-2 sm:grid-cols-3 gap-8">

                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[2px] text-orange-500 mb-5">
                        Navigation
                    </p>

                    <ul class="space-y-3">
                        @foreach([
                            ['label'=>'Accueil',    'route'=>'customer.accueil',    'icon'=>'home'],
                            ['label'=>'Produits',   'route'=>'customer.products',   'icon'=>'shopping-bag'],
                            ['label'=>'Catégories', 'route'=>'customer.categories','icon'=>'layout-grid'],
                            ['label'=>'Panier',     'route'=>'customer.cart',      'icon'=>'shopping-cart'],
                        ] as $link)
                        <li>
                            <a href="{{ route($link['route']) }}"
                               class="group inline-flex items-center gap-2 text-sm text-gray-500
                                      hover:text-orange-500 transition-colors font-medium">

                                <i data-lucide="{{ $link['icon'] }}"
                                   class="w-4 h-4 text-gray-300 group-hover:text-orange-500
                                          transition-all group-hover:scale-110"></i>

                                {{ $link['label'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[2px] text-orange-500 mb-5">
                        Aide
                    </p>

                    <ul class="space-y-3">
                        @foreach([
                            ['label'=>'Comment commander', 'icon'=>'help-circle'],
                            ['label'=>'Livraison',         'icon'=>'truck'],
                            ['label'=>'FAQ',               'icon'=>'message-circle'],
                        ] as $item)
                        <li>
                            <a href="#"
                               class="group inline-flex items-center gap-2 text-sm text-gray-500
                                      hover:text-orange-500 transition-colors font-medium">

                                <i data-lucide="{{ $item['icon'] }}"
                                   class="w-4 h-4 text-gray-300 group-hover:text-orange-500
                                          transition-all group-hover:scale-110"></i>

                                {{ $item['label'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[2px] text-orange-500 mb-5">
                        Contact
                    </p>

                    <ul class="space-y-3.5">
                        @foreach([
                            ['icon'=>'map-pin', 'text'=>'Casablanca, Maroc'],
                            ['icon'=>'phone',   'text'=>'+212 6XX-XXXXXX'],
                            ['icon'=>'mail',    'text'=>'contact@monmarche.ma'],
                            ['icon'=>'clock',   'text'=>'Lun – Sam : 8h – 21h'],
                        ] as $c)
                        <li class="flex items-start gap-3">

                            <span class="w-7 h-7 rounded-lg bg-orange-50 border border-orange-100
                                         flex items-center justify-center flex-shrink-0 mt-0.5">

                                <i data-lucide="{{ $c['icon'] }}"
                                   class="w-3.5 h-3.5 text-orange-500"></i>

                            </span>

                            <span class="text-sm text-gray-500 font-medium leading-tight pt-1">
                                {{ $c['text'] }}
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>

        {{-- NEWSLETTER --}}
        <div class="py-8 border-b border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-6">

            <div>
                <p class="text-sm font-bold text-gray-900 mb-0.5">
                    Restez informé des offres 🛒
                </p>
                <p class="text-xs text-gray-400">
                    Recevez nos promotions directement dans votre boîte mail.
                </p>
            </div>

            <form class="flex items-center gap-2 w-full sm:w-auto">

                <div class="relative flex-1 sm:w-64">
                    <i data-lucide="mail"
                       class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400"></i>

                    <input type="email"
                           placeholder="votre@email.com"
                           class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-gray-200
                                  bg-gray-50 text-sm text-gray-700
                                  focus:outline-none focus:ring-2 focus:ring-orange-500
                                  focus:border-orange-500 focus:bg-white transition">
                </div>

                <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold text-white
                               bg-orange-500 hover:bg-orange-600 transition"
                        style="box-shadow:0 4px 14px rgba(255,122,0,0.28);">
                    S'abonner
                </button>
            </form>
        </div>

        {{-- BOTTOM --}}
        <div class="py-6 flex flex-col sm:flex-row items-center justify-between gap-3">

            <p class="text-xs text-gray-400">
                © {{ date('Y') }}
                <span class="font-semibold text-gray-600">Mon Marché</span>.
                Tous droits réservés.
            </p>

            <div class="flex items-center gap-4">

                {{-- ONLY DELIVERY (payment removed) --}}
                <span class="inline-flex items-center gap-1.5 text-xs text-gray-400 font-medium">
                    <i data-lucide="truck" class="w-4 h-4 text-orange-400"></i>
                    Livraison rapide
                </span>

            </div>

            <p class="text-xs text-gray-400">
                Développé par
                <span class="font-semibold text-orange-500">Hamza Sellami</span>
            </p>
        </div>

    </div>
</footer>