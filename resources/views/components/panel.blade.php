<div class="py-8 mx-4 sm:mx-auto">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden sm:rounded-lg">
            <div {{ $attributes->class(['' => true]) }}>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
