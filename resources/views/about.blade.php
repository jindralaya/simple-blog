<x-layout>
    <x-panel class="flex flex-col pb-16">
        <x-splade-data :default="$about">
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
                @if (Auth::check() && Auth::user()->is_admin)
                    <div
                        class="flex flex-row justify-end items-center gap-2 @auth{{ Auth::user()->is_admin ? 'border border-gray-300 border-dashed py-1 px-1' : 'pt-0' }} @endauth">
                        @if (empty($about))
                            <Link href="{{ route('about.add') }}"
                                class="rounded-sm bg-blue-500 py-1 px-4 text-gray-100 text-sm">
                            <span>add</span>
                            </Link>
                        @endif
                        @if (isset($about))
                            <Link href="{{ route('about.edit') }}"
                                class="rounded-sm bg-blue-500 py-1 px-4 text-gray-100 text-sm">
                            <span>edit</span>
                            </Link>
                            <Link href="{{ route('about.delete', $about->id) }}" confirm
                                class="rounded-sm bg-red-500 py-1 px-4 text-gray-100 text-sm" method="DELETE">
                            <span>delete</span>
                            </Link>
                        @endif
                    </div>
                @endif
                @if (empty($about))
                    <p
                        class="flex justify-center items-center text-gray-600 shadow-md rounded-lg border border-gray-300 border-1 border-dashed p-6 @auth{{ Auth::user()->is_admin ? 'mt-6' : 'mt-0' }} @endauth">
                        Data kosong</p>
                @else
                    <div class="">
                        <p class="text-gray-800 @auth{{ Auth::user()->is_admin ? 'mt-6' : 'mt-0' }} @endauth">
                            {!! $about->content !!}
                        </p>
                    </div>
                @endif
            </x-splade-lazy>
        </x-splade-data>
    </x-panel>
</x-layout>
