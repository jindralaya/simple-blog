<x-layout>
    <x-panel class="flex flex-col pb-16">
        {{-- heading --}}
        <div class="font-bold mb-3">
            Blog terbaru
        </div>
        <x-splade-data :default="$blog">
            <x-splade-lazy>
                <x-slot:placeholder>
                    {{-- mengulang elemen tersebut 6 kali --}}
                    @php
                        $repeatCount = 6;
                    @endphp
                    {{-- animate pulse --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
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
                @if (count($blog) < 1)
                    <p class="flex justify-center items-center text-gray-600 shadow-md p-6">
                        Data kosong</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach ($blog as $blogs)
                            <div class="bg-gray-100 shadow-md border border-[#176B87]/30 p-4">
                                <h2 class="font-medium leading-6 mb-2">
                                    <Link class="capitalize" href="blog/{{ $blogs->slug }}">
                                    {{ $blogs->title }}
                                    </Link>
                                </h2>
                                <div class="flex flex-row justify-between items-center text-gray-400 text-xs mb-6">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 inline-block mr-1"
                                            fill="currentColor"
                                            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                            <path
                                                d="M128 0c13.3 0 24 10.7 24 24V64H296V24c0-13.3 10.7-24 24-24s24 10.7 24 24V64h40c35.3 0 64 28.7 64 64v16 48V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V192 144 128C0 92.7 28.7 64 64 64h40V24c0-13.3 10.7-24 24-24zM400 192H48V448c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V192zM329 297L217 409c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47 95-95c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                                        </svg>
                                        {{ $blogs->created_at->format('d m Y') }}
                                    </span>
                                    {{-- blog tags --}}
                                    <div class="flex flex-row justify-start gap-2">
                                        {{-- array bg-color --}}
                                        @php
                                            $bgClasses = ['bg-red-400', 'bg-blue-400', 'bg-green-400', 'bg-yellow-400', 'bg-purple-400'];
                                        @endphp
                                        @foreach ($blogs->tags as $tag)
                                            {{-- cek agar bg-color tidak sama --}}
                                            @php
                                                // mengacak kelas dari array
                                                $randomIndex = array_rand($bgClasses);
                                                $randomBgClass = $bgClasses[$randomIndex];
                                                // Menghapus kelas yang sudah dipilih dari array
                                                unset($bgClasses[$randomIndex]);
                                                // Mengatur ulang indeks array
                                                $bgClasses = array_values($bgClasses);
                                            @endphp
                                            <span class="capitalize">
                                                <div class="inline-block p-1 {{ $randomBgClass }} rounded-full"></div>
                                                {{ $tag->tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                <p class="text-gray-500">
                                    {{ Str::of(strip_tags($blogs->content))->words(25, '...') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <span class="mt-6">
                        {{-- paginasi  --}}
                        {{ $blog->links() }}
                    </span>
                @endif
            </x-splade-lazy>
        </x-splade-data>
    </x-panel>
</x-layout>
