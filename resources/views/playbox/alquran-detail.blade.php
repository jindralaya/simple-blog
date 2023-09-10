<x-layout>
    <x-panel class="flex flex-col pb-16">
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
                    <div class="grid grid-cols-1 gap-6 mx-2 lg:mx-auto">
                        <div>
                            <x-splade-defer
                                url="https://api.npoint.io/99c279bb173a6e28359c/data/{{ $alquran->number }}">
                                <p v-show="processing" class="text-gray-500 text-center">Loading...</p>
                                <div class="px-4 sm:px-0">
                                    <h3 v-if="response" v-text="response.nama"
                                        class="text-base font-semibold leading-7 text-[#176B87]" />
                                    <p v-if="response" v-text="response.arti"
                                        class="mt-1 max-w-2xl leading-6 text-gray-500" />
                                </div>
                                <div class="mt-6 border-t border-[#176B87]">
                                    <dl class="divide-y divide-gray-100">
                                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                            <dt class="font-medium leading-6 text-gray-900">Nama</dt>
                                            <dd v-if="response" v-text="response.nama"
                                                class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0" />
                                        </div>
                                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                            <dt class="font-medium leading-6 text-gray-900">Arti</dt>
                                            <dd v-if="response" v-text="response.arti"
                                                class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0" />
                                        </div>
                                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                            <dt class="font-medium leading-6 text-gray-900">Asma</dt>
                                            <dd v-if="response" v-text="response.asma"
                                                class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0" />
                                        </div>
                                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                            <dt class=" font-medium leading-6 text-gray-900">Total ayat
                                            </dt>
                                            <dd v-if="response" v-text="response.ayat"
                                                class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0" />
                                        </div>
                                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                            <dt class=" font-medium leading-6 text-gray-900">Diturunkan di
                                            </dt>
                                            <dd v-if="response" v-text="response.type"
                                                class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0" />
                                        </div>
                                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                            <dt class="font-medium leading-6 text-gray-900">Keterangan</dt>
                                            <dd v-if="response" v-html="response.keterangan"
                                                class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0" />
                                        </div>
                                        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                            <dt class="font-medium leading-6 text-gray-900">Audio</dt>
                                            <dd class="mt-2 text-gray-900 sm:col-span-2 sm:mt-0">
                                                <ul role="list"
                                                    class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                                    <li
                                                        class="flex items-center justify-between py-4 pl-4 pr-5 leading-6">
                                                        <div class="flex w-0 flex-1 items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                                viewBox="0 0 512 512" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M499.1 6.3c8.1 6 12.9 15.6 12.9 25.7v72V368c0 44.2-43 80-96 80s-96-35.8-96-80s43-80 96-80c11.2 0 22 1.6 32 4.6V147L192 223.8V432c0 44.2-43 80-96 80s-96-35.8-96-80s43-80 96-80c11.2 0 22 1.6 32 4.6V200 128c0-14.1 9.3-26.6 22.8-30.7l320-96c9.7-2.9 20.2-1.1 28.3 5z" />
                                                            </svg>
                                                            <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                                                <span class="truncate font-medium">
                                                                    <audio controls>
                                                                        <source src="{{ $alquran->audio }}"
                                                                            type="audio/mpeg">
                                                                        Your browser does not support the audio element.
                                                                    </audio>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="ml-4 flex-shrink-0">
                                                            <Link away href="{{ $alquran->audio }}"
                                                                class="font-medium text-[#176B87] hover:text-[#176B87]/80">
                                                            Download</Link>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </x-splade-defer>
                            <x-splade-defer url="https://api.npoint.io/99c279bb173a6e28359c/surat/{{ $alquran->id }}">
                                <p v-show="processing" class="text-gray-500 text-center">Loading...</p>
                                <div class="px-4 grid grid-cols-1 space-y-6 overflow-y-auto max-h-96">
                                    {{-- <dt class="font-medium leading-6 text-gray-900">Keterangan</dt> --}}
                                    <dd v-for="(item, index) in response" :key="index"
                                        class="mt-1 leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                                        <dd v-text="item.ar" class="font-bold" />
                                        <dd v-text="item.id" />
                                    </dd>
                                </div>
                            </x-splade-defer>
                        </div>
                    </div>
                @endif
            </x-splade-lazy>
        </x-splade-data>
    </x-panel>
</x-layout>
