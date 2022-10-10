{{-- Image input widget with preview --}}
{{-- Requires the components/imageInput.ts script --}}

{{-- @param ?string $initial An initial image URL, can be null.
--}}
@props(['initial' => null])

<div class="w-full relative cursor-pointer">
    <div class="image-input aspect-square h-full p-1 border-l-brd/10 hover:border-highlight-light border-dashed border-4 rounded-xl bg-contain bg-no-repeat bg-center cursor-pointer hover:italic bg-origin-content"
        style="{{ $initial !== null ? 'background-image: url(' . $initial . ')' : '' }}">
        <div class="{{ 'image-input-hint absolute top-0 left-0 flex flew-col items-center justify-center w-full h-full p-1' . ($initial !== null ? ' hidden' : '') }}"
            aria-hidden>
            <p class="font-semibold text-l-brd/10 text-center">
                @tr('component.image_input.hint')
            </p>
        </div>
        <input type="file" accept="image/jpeg,image/png,image/webp" {!! $attributes->merge([
            'class' =>
                'file:w-full file:h-full h-full w-full file:bg-inherit file:border-none cursor-pointer file:cursor-pointer focus:outline-none file:invisible absolute top-0 left-0 z-10',
        ]) !!}>
    </div>
</div>
