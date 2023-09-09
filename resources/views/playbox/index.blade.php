<x-layout>
    <x-panel class="flex flex-col pb-16">
        <x-splade-data>
            <x-splade-lazy>
                <x-slot:placeholder>
                    {{-- mengulang elemen tersebut 1 kali --}}
                    @php
                        $repeatCount = 8;
                    @endphp
                    {{-- animate pulse --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-3 gap-6">
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
                <h2
                    class="flex flex-col justify-center items-center uppercase bg-gray-50 border-x border-[#176B87] shadow-md text-[#176B87] p-2 mb-8">
                    <span class="font-bold">Playbox</span>
                    <span class="text-xs font-medium text-gray-400">Play the game</span>
                </h2>

                <div class="bg-gray-100 grid grid-cols-1 md:grid-cols-3 sm:grid-cols-3 gap-6">
                    <div class="shadow-md border bg-gray-100 border-[#176B87]/30 ">
                        <img src="https://images.unsplash.com/photo-1580398828792-09bcf359539f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                            alt="image" class="w-full h-28 object-cover mb-4 filter brightness-50 blur-xs">
                        <div class="flex flex-col justify-center items-center">
                            <h3 class="font-medium leading-6 capitalize">Al-quran online</h3>
                            <p class="text-gray-400 text-sm px-4">
                               Berisi semua surat - surat didalam al-quran
                            </p>
                            <Link href="{{route('alquran')}}" class="bg-[#176B87] text-center text-gray-200 w-full px-2 py-1 mt-4 hover:bg-[#176B87]/80">Play</Link>
                        </div>
                    </div>
                </div>
            </x-splade-lazy>
        </x-splade-data>
    </x-panel>
</x-layout>
