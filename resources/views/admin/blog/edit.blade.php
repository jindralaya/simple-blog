<x-layout>
    <x-panel class="flex flex-col bg-gray-100 pb-16">
        <x-splade-form class="space-y-4" :default="$blog" action="{{route('blog.update',$blog->id)}}" method="PUT">
            <x-splade-input name="title" autosize placeholder="Ketik judul"></x-splade-input>
            <x-splade-wysiwyg name="content" autosize />
            <x-splade-select name="tag[]" :options="$tags" option-label="tag" option-value="id" choices multiple placeholder="Kosongkan jika sama"/>
              <x-splade-group name="active" label="Active" inline>
                <x-splade-radio name="active" value="1" label="Yes" />
                <x-splade-radio name="active" value="0" label="No" />
            </x-splade-group>
            <x-splade-submit class="bg-[#176B87] text-gray-100 hover:bg-[#176B87]/80" label="Update" :spinner="true" />
        </x-splade-form>
    </x-panel>
</x-layout>