{{-- The list of companies in the 'GET /companies' route --}}

<x-main-layout :title="__('company.list.title')" :companies_link="false">
    <main class="container mx-auto py-2 flex flex-col gap-2 px-2">
        <span class="flex flex-row flex-wrap gap-2 justify-between lg:relative">
            @if ($admin)
                <x-secondary-link :admin="true" href="{{ route('admin.index') }}"
                    class="lg:absolute lg:left-0 lg:top-0">
                    @svg('resources/images/left-angle.svg', 'fill-admin group-hover:fill-admin-light mr-1')
                    @tr('admin.back')
                </x-secondary-link>
            @endif

            <h1 class="font-semibold text-xl w-full h-[2em] text-center order-first">
                @if ($admin)
                    @tr('company.list.title.admin')
                @else
                    @tr('company.list.title')
                @endif
            </h1>

            @can('create', App\Models\Company::class)
                <x-primary-link :admin="$admin" href="{{ route('companies.create', $admin ? ['admin' => 1] : []) }}"
                    class="lg:absolute lg:right-0 lg:top-0">
                    @tr('company.create.title')
                </x-primary-link>
            @endcan
        </span>
        <section id="companies" class="flex flex-row flex-wrap gap-2">
            @foreach ($companies as $company)
                <x-company-entry :company=$company :admin="$admin" />
            @endforeach

            @if (count($companies) == 0)
                <em class="text-gray-400 w-full text-center py-8">@tr('list.empty')</em>
            @endif
        </section>
        <x-page-navigation :paginator="$companies" width=5 class="border-t border-l-brd/10" />
    </main>
</x-main-layout>
