{{-- List of all assets, admin-only --}}

<x-main-layout title="{{ __('admin.assets.title') }}">
    <main class="container mx-auto py-2 flex flex-col gap-2 px-2">
        <span class="flex flex-row flex-wrap gap-2 justify-between md:relative">
            <x-secondary-link :admin="true" href="{{ route('admin.index') }}" class="md:absolute md:left-0 md:top-0">
                @svg('resources/images/left-angle.svg', 'fill-admin group-hover:fill-admin-light mr-1')
                @tr('admin.companies.back')
            </x-secondary-link>

            <h1 class="font-semibold text-xl w-full h-[2em] text-center order-first">
                @tr('admin.assets.title')
            </h1>

            <x-primary-link :admin="true" href="{{ route('companies.create', ['admin' => 1]) }}"
                class="md:absolute md:right-0 md:top-0">
                @tr('company.create.title')
            </x-primary-link>
        </span>

        <x-page-navigation :paginator="$assets" width=5 class="border-t border-l-brd/10" />
        <section id="assets" class="flex flex-row flex-wrap gap-2">
            @foreach ($assets as $asset)
                <x-asset-entry :asset=$asset />
            @endforeach

            @if (count($assets) == 0)
                <em class="text-gray-400 w-full text-center py-8">@tr('list.empty')</em>
            @endif
        </section>
        <x-page-navigation :paginator="$assets" width=5 class="border-t border-l-brd/10" />

    </main>
</x-main-layout>
