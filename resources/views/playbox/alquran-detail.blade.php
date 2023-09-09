<x-layout>
    <x-panel class="flex flex-col bg-gray-100 pb-16">
        <x-splade-data :default="$alquran">
            <x-splade-lazy>
                <x-slot:placeholder>
                    {{-- mengulang elemen tersebut 1 kali --}}
                    @php
                        $repeatCount = 1;
                    @endphp
                    {{-- animate pulse --}}
                    <div class="grid grid-cols-1 gap-6">
                        @foreach (range(1, $repeatCount) as $index)
                            <div class="relative rounded-lg border border-gray-300 border-1 p-14">
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
                @if (empty($alquran))
                    <p
                        class="flex justify-center items-center text-gray-600 shadow-md rounded-lg border border-gray-300 border-1 border-dashed p-6 @auth{{ Auth::user()->is_admin ? 'mt-6' : 'mt-0' }} @endauth">
                        Data kosong</p>
                @else
                    <div class="bg-gray-50 grid grid-cols-1 gap-6">
                        <x-splade-defer url="https://api.npoint.io/99c279bb173a6e28359c/data/{{ $alquran->number }}">
                            <p v-show="processing" class="text-sm text-gray-500 text-center">Loading...</p>
                            <div
                                class="shadow-md rounded-lg border bg-gray-50 border-gray-300 border-1 border-dashed p-4">
                                <div>
                                    <div class="px-4 sm:px-0">
                                        <h3 v-text="response.nama" class="leading-7 text-lg font-bold text-[#176B87]">
                                        </h3>
                                        <p v-text="response.arti"
                                            class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">
                                        </p>
                                    </div>
                                    <div class="mt-6 border-t border-gray-100">
                                        <dl class="divide-y divide-gray-100">
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="font-medium leading-6 text-gray-900">Surat</dt>
                                                <dd
                                                    v-text="response.nama "class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                </dd>
                                            </div>
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="font-medium leading-6 text-gray-900">Arti
                                                </dt>
                                                <dd v-text="response.arti"
                                                    class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                </dd>
                                            </div>
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="font-medium leading-6 text-gray-900">Asma
                                                </dt>
                                                <dd v-text="response.asma"
                                                    class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                </dd>
                                            </div>
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="font-medium leading-6 text-gray-900">Diturunkan di
                                                </dt>
                                                <dd v-text="response.type"
                                                    class="capitalize mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                </dd>
                                            </div>
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="font-medium leading-6 text-gray-900">Total ayat</dt>
                                                <dd v-text="response['ayat']"
                                                    class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                </dd>
                                            </div>
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="font-medium leading-6 text-gray-900">Keterangan</dt>
                                                <dd v-html="response['keterangan']"
                                                    class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                </dd>
                                            </div>
                                            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="font-medium leading-6 text-gray-900">Audio</dt>
                                                <dd class="mt-2 text-gray-900 sm:col-span-2 sm:mt-0">
                                                    <ul role="list"
                                                        class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                                        <li
                                                            class="flex items-center justify-between py-4 pl-4 pr-5 leading-6">
                                                            <div class="flex w-0 flex-1 items-center">
                                                                <audio controls>
                                                                    <source src="{{ $alquran->audio }}"
                                                                        type="audio/mpeg">
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                            </div>
                                                            <div class="ml-4 flex-shrink-0">
                                                                <Link away :href="`${response.audio}`"
                                                                    class="font-medium text-[#176B87] hover:text-[#176B87]/90">
                                                                Download
                                                                </Link>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </dd>
                                            </div>
                                            <x-splade-defer
                                                url="https://api.npoint.io/99c279bb173a6e28359c/surat/{{ $alquran->id }}">
                                                <div
                                                    class="overflow-auto max-h-96 max-w-60 px-4 py-6 grid grid-col-1 gap-4 sm:px-0">
                                                    {{-- <dt class="text-sm font-medium leading-6 text-gray-900">Baca --}}
                                                    </dt>
                                                    <dd v-for="item in response" :key="`${item.nomor}`"
                                                        class="mt-1 text-center leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                                    <dd class="font-bold" v-text="item.ar"></dd>
                                                    <dd v-text="item.id"></dd>
                                                    </dd>
                                                </div>
                                            </x-splade-defer>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </x-splade-defer>
                    </div>
                @endif
            </x-splade-lazy>
        </x-splade-data>
    </x-panel>
</x-layout>
