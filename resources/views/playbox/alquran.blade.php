<x-layout>
    <x-panel class="flex flex-col pb-16">
        <x-splade-data :default="$alquran">
            <x-splade-lazy>
                <x-slot:placeholder>
                    {{-- mengulang elemen tersebut 1 kali --}}
                    @php
                        $repeatCount = 8;
                    @endphp
                    {{-- animate pulse --}}
                    <div class="grid grid-cols-1 md:grid-cols-4 sm:grid-cols-2 gap-6">
                        @foreach (range(1, $repeatCount) as $index)
                            <div class="relative rounded-lg border border-gray-300 border-1 p-6">
                                <div class="animate-pulse space-y-6 py-1">
                                    <div class="h-2 bg-slate-200 rounded"></div>
                                    <div class="space-y-3">
                                        <div class="grid grid-cols-3 gap-4">
                                            <div class="h-2 bg-slate-200 rounded col-span-2"></div>
                                            <div class="h-2 bg-slate-200 rounded col-span-1"></div>
                                        </div>
                                        <div class="h-2 bg-slate-200 rounded"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot:placeholder>
                {{-- content --}}
                <x-splade-form action="{{ route('alquran') }}" class="mb-6" method="GET">
                    <x-splade-input name="search" placeholder="Cari" />
                </x-splade-form>
                <h2
                    class="text-center font-bold uppercase bg-gray-50 border-x border-[#176B87] shadow-md text-[#176B87] p-2 mb-8">
                    Al-quran
                    online</h2>
                @if (count($alquran) < 1)
                    <p
                        class="flex justify-center items-center text-gray-600 shadow-md rounded-lg border border-gray-300 border-1 border-dashed p-6 @auth{{ Auth::user()->is_admin ? 'mt-6' : 'mt-0' }} @endauth">
                        Data kosong</p>
                    @if (Auth::check() && Auth::user()->is_admin)
                        <div
                            class="flex flex-row justify-end items-center gap-2 @auth{{ Auth::user()->is_admin ? 'border border-gray-300 border-dashed py-1 px-1 mb-6' : 'pt-0 mb-auto' }} @endauth">
                            <Link href="{{ route('alquran.sinkron') }}"
                                class="rounded-sm bg-blue-500 py-1 px-4 text-gray-100 text-sm">
                            <span>sinkron</span>
                            </Link>
                        </div>
                    @endif
                @else
                    <div class="grid grid-cols-1 md:grid-cols-4 sm:grid-cols-2 gap-6">
                        @foreach ($alquran as $alqurans)
                            <x-splade-defer
                                url="https://api.npoint.io/99c279bb173a6e28359c/data/{{ $alqurans->number }}">
                                <div
                                    class="bg-gray-100 shadow-md border border-[#176B87]/30 p-4">
                                    <p v-show="processing" class="text-sm text-gray-500 text-center">Loading...</p>
                                    <h2 class="font-medium" v-if="response">
                                        <p class="inline-block mr-1">{{ $alqurans->id }}.</p>
                                        <Link class="inline-block capitalize" v-text="response['nama']"
                                            href={{ route('alquran.detail', $alqurans->slug) }} />
                                        <p class="inline-block ml-1" v-text="response['asma']"></p>
                                    </h2>
                                    <p v-text="response['arti']" class="font-medium text-xs text-gray-500"></p>
                                    <div class="space-x-1">
                                        <p v-text="response['ayat']"
                                            class="inline-block mt-4 text-xs text-gray-500 font-medium"></p>
                                        <span class="inline-block text-xs text-gray-500 font-bold">Ayat,</span>
                                        <p v-text="response['type']"
                                            class="inline-block text-xs capitalize text-[#176B87] font-medium"></p>
                                    </div>
                                </div>
                            </x-splade-defer>
                        @endforeach
                    </div>
                    <span class="mt-6">
                        {{-- paginasi  --}}
                        {{ $alquran->appends(request()->input())->links() }}
                    </span>
                @endif
            </x-splade-lazy>
        </x-splade-data>
    </x-panel>
</x-layout>
