<x-splade-data default="{ open: false }">
    <nav class="max-w-4xl border-[#176B87] mx-2 md:mx-auto lg:mx-auto">
        <div class="mt-6">
            {{-- quote --}}
            <div class="block justify-center items-center">
                <x-splade-defer url="https://api.quotable.io/random">
                    <blockquote class="text-center sm:mb-5 bg-gray-50 shadow-md border-x-4 border-[#176B87] p-4  italic">
                        <p v-show="processing">Loading random quote...</p>
                        <p v-if="response">
                            <p v-text="response.content" />
                            <cite>- <span class="font-medium" v-text="response.author"></span></cite>
                        </p>
                    </blockquote>
                </x-splade-defer>
            </div>
            {{-- avatar --}}
            <div
                class="flex flex-col sm:flex-row items-start sm:items-center justify-center sm:justify-between p-6 shadow-md bg-[#176B87]">
                <!-- Bagian kiri navbar -->
                <div class="flex items-center">
                    <img src="https://i.ibb.co/4T9xYSL/me.jpg" alt="Foto Profil"
                        class="w-16 h-16 rounded-full border-2 border-gray-200"> <!-- Avatar -->
                    <div class="flex flex-col ml-2">
                        <span class="text-gray-50 font-bold"> {{ 'Jaka Indralaya' }}</span> <!-- Nama Pengguna -->
                        <span class="text-gray-300 text-sm">{{ 'Fullstack Developer, Laravel Developer' }}</span>
                        <!-- Keterangan -->
                    </div>
                </div>
                <!-- Bagian kanan navbar -->
                <div class="mt-4">
                    <Link away
                        href="https://api.whatsapp.com/send/?phone=6282189065252&text=Halo%20kak%20saya%20mau%20bikin%20web%20nih,&type=phone_number&app_absent=0"
                        class="bg-gray-50 text-[#176B87] font-medium hover:bg-gray-200 px-6 py-2 rounded-md">Contact
                    </Link>
                </div>
            </div>
        </div>
    </nav>
    <div class="max-w-4xl mx-2 md:mx-auto lg:mx-auto mt-4 flex justify-end items-end sm:justify-between sm:items-start">
        <nav class="bg-[#176B87] p-4 w-full">
            <!-- Container untuk mengatur lebar navbar -->
            <div class="container mx-auto flex items-center justify-end sm:justify-between">
                <!-- Daftar menu -->
                <ul id="menu" class="hidden sm:flex sm:space-x-4">
                    <li>
                        <Link href="{{ route('home') }}"
                            class="text-gray-50 {{ request()->routeIs('home') ? 'underline' : 'hover:underline' }}">Home
                        </Link>
                    </li>
                    <li>
                        <Link href="{{ route('about') }}"
                            class="text-gray-50 {{ request()->routeIs('about') ? 'underline' : 'hover:underline' }}">
                        About me</Link>
                    </li>
                    <li>
                        <Link href="{{ route('playbox') }}"
                            class="text-gray-50 {{ request()->routeIs('playbox') ? 'underline' : 'hover:underline' }}">
                        Playbox</Link>
                    </li>
                    <li>
                        <Link href="{{ route('blog') }}"
                            class="text-gray-50 {{ request()->routeIs('blog') ? 'underline' : 'hover:underline' }}">Blog
                        </Link>
                    </li>
                    @auth
                        <li>
                            <Link href="{{ route('logout') }}"
                                class="text-gray-50 {{ request()->routeIs('logout') ? 'underline' : 'hover:underline' }}">Log
                            out
                            </Link>
                        </li>
                    @endauth
                </ul>

                <!-- Tombol menu (hanya ditampilkan pada layar kecil) -->
                <button class="block sm:hidden" @click="data.open = ! data.open">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 "
                        :style="{ fill: data.open ? '#f9fafb' : '#f9fafb' }" viewBox="0 0 512 512">
                        <path v-bind:class="{'hidden': data.open, 'inline-flex': ! data.open }"
                            d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM64 256c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H96c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                        <path v-bind:class="{'hidden': ! data.open, 'inline-flex': data.open }"
                            d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
                    </svg>
                </button>
            </div>
            <!-- Menu yang akan ditampilkan saat tombol diklik -->
            <div v-if="data.open" class="sm:hidden p-4 mt-2">
                <!-- Isi menu di sini -->
                <ul class="block">
                    <li>
                        <Link href="{{ route('home') }}"
                            class="text-gray-50 block {{ request()->routeIs('home') ? 'border-b border-gray-50' : 'hover:border-b hover:border-gray-50' }}">
                        Home
                        </Link>
                    </li>
                    <li>
                        <Link href="{{ route('about') }}"
                            class="text-gray-50 block {{ request()->routeIs('about') ? 'border-b border-gray-50' : 'hover:border-b hover:border-gray-50' }}">
                        About me
                        </Link>
                    </li>
                    <li>
                        <Link href="{{ route('playbox') }}"
                            class="text-gray-50 block {{ request()->routeIs('playbox') ? 'border-b border-gray-50' : 'hover:border-b hover:border-gray-50' }}">
                        Playbox
                        </Link>
                    </li>
                    <li>
                        <Link href="{{ route('blog') }}"
                            class="text-gray-50 block {{ request()->routeIs('blog') ? 'border-b border-gray-50' : 'hover:border-b hover:border-gray-50' }}">
                        Blog
                        </Link>
                    </li>
                    @auth
                        <li>
                            <Link href="{{ route('logout') }}"
                                class="text-gray-50 {{ request()->routeIs('blog') ? 'underline' : 'hover:underline' }}">Log
                            out
                            </Link>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>

        {{-- <div class="inline-flex"> --}}
        {{-- jika user is_admin --}}
        {{-- <button @click="data.open = ! data.open">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 " fill="currentColor"
                    viewBox="0 0 512 512">
                    <path v-bind:class="{'hidden': data.open, 'inline-flex': ! data.open }"
                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM64 256c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H96c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                    <path v-bind:class="{'hidden': ! data.open, 'inline-flex': data.open }"
                        d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
                </svg> --}}
        {{-- <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM64 256c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H96c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg> --}}
        {{-- </button> --}}
        <!-- Responsive Navigation Menu -->
        {{-- <div v-bind:class="{'block': data.open, 'hidden': ! data.open }" class="relative">
                <ul class="bg-gray-100 absolute mt-2 py-2 w-56 sm:w-80 top-6 right-0 shadow-md">
                    <li>
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">Opsi
                            1</a>
                        <Link href="{{ route('home') }}"
                            class="{{ request()->routeIs('home') ? 'block px-4 py-2 text-gray-600 hover:bg-[#176B87] hover:text-gray-50' : 'text-gray-900' }}">
                        Home</Link>
                    </li>
                </ul>
            </div> --}}
        {{-- </div> --}}
    </div>
</x-splade-data>
