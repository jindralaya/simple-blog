<x-layout>
    <x-panel class="flex flex-col pb-16">
        <x-splade-data :default="$blog">
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
                @if (empty($blog))
                    <p
                        class="flex justify-center items-center text-gray-600 shadow-md rounded-lg border border-gray-300 border-1 border-dashed p-6 @auth{{ Auth::user()->is_admin ? 'mt-6' : 'mt-0' }} @endauth">
                        Data kosong</p>
                @else
                    <div class="flex flex-col justify-center items-center space-y-2 my-10">
                        <span class="font-medium text-lg leading-6 capitalize">
                            {{ $blog->title }}
                        </span>
                        <span class="text-sm font text-gray-400">
                            {{ $blog->created_at->format('d M Y') }}
                        </span>
                        <span class="text-sm font text-gray-500">
                            {{ $blog->user->name }}
                        </span>
                    </div>
                    <div class="">
                        <p class="text-gray-800">
                            {!! $blog->content !!}
                        </p>
                    </div>
                @endif
            </x-splade-lazy>
        </x-splade-data>
    </x-panel>
</x-layout>
