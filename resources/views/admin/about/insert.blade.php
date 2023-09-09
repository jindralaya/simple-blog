<x-layout>
    <x-panel class="flex flex-col bg-gray-100 pb-16">
        <x-splade-form class="space-y-4" action="{{route('about.insert')}}">
            <x-splade-wysiwyg name="content" autosize/>
            <x-splade-submit class="bg-[#176B87] text-gray-100 hover:bg-[#176B87]/80" label="Save" :spinner="true" />
        </x-splade-form>
    </x-panel>
</x-layout>