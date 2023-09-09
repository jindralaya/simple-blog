<x-layout>
    <x-panel>
        <h1 class="font-bold leading-7 text-lg text-center">Login</h1>
        <x-splade-form action="{{ route('otentikasi') }}">
            <x-splade-input class="my-2" name="email" type="email" label="Email Kamu" placeholder="Alamat email kamu" />
            <x-splade-input class="my-2" name="password" type="password" label="Password Kamu"
                placeholder="Isi password kamu" />
            <x-splade-submit class="my-2 bg-[#176B87] text-gray-100 hover:bg-[#176B87]/80" label="Login"
                :spinner="true" />
        </x-splade-form>
    </x-panel>
</x-layout>
