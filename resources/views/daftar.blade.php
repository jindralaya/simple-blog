<x-layout>
    <x-panel>
        <h1 class="font-bold leading-7 text-lg text-center">Register</h1>
        <x-splade-form action="{{ route('daftar.user') }}" method="POST">
            <x-splade-input class="my-2" name="name" type="text" label="Nama" placeholder="Nama kamu" />
            <x-splade-input class="my-2" name="email" type="email" label="Email" placeholder="Alamat email kamu" />
            <x-splade-input class="my-2" name="password" type="password" label="Password" placeholder="Isi password kamu" />
            <x-splade-input class="my-2" name="password_confirmation" type="password" label="Password Confirmation" placeholder="Isi password kamu" />
            <x-splade-submit class="my-2 bg-[#176B87] text-gray-100 hover:bg-[#176B87]/80" label="Register" :spinner="true" />
        </x-splade-form>
    </x-panel>
</x-layout>
