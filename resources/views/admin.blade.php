<x-main-layout title="{{ __('admin.index.title') }}" :admin_link="false">
    <main class="mx-auto w-full md:w-10/12 lg:w-1/2 m-2 p-2 bg-l-bgr-content rounded-md border border-l-brd/10">
        <h1 class="font-semibold text-xl">@tr('admin.index.title')</h1>

        <nav class="flex flex-row flex-wrap gap-2 justify-center border-t border-l-brd/10 pt-2 mt-2">
            {{-- Not yet implemented --}}
            {{-- <x-primary-link :admin="true" href="#">@tr('admin.applications.title')</x-primary-link> --}}
            <x-primary-link :admin="true" href="{{ route('assets.index') }}">@tr('admin.assets')</x-primary-link>
            <x-primary-link :admin="true" href="{{ route('companies.index', ['admin' => true]) }}">@tr('admin.companies.title')
            </x-primary-link>
            <x-primary-link :admin="true" href="{{ route('users.index') }}">@tr('admin.users')</x-primary-link>
        </nav>

        <section class="border-t border-l-brd/10 pt-2 mt-2">
            <h2 class="font-semibold text-md">@tr('admin.statistics')</h2>

            <ul class="list-disc list-inside">
                <li>{{ 'Adverts: ' . \App\Models\Advert::count() }}</li>
                <li>{{ 'Applications: ' . \App\Models\Application::count() }}</li>
                <li>{{ 'Assets: ' . \App\Models\Asset::count() }}</li>
                <li>{{ 'Blobs: ' . \App\Models\Blob::count() }}</li>
                <li>{{ 'Companies: ' . \App\Models\Company::count() }}</li>
                <li>{{ 'Users: ' . \App\Models\User::count() }}</li>
            </ul>
        </section>
    </main>
</x-main-layout>
