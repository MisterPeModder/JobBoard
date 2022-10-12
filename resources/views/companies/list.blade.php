{{-- The list of companies in the 'GET /companies' route --}}

<x-main-layout :title="__('company.list.title')" :companies_link="false">
    <main class="container mx-auto py-2 flex flex-col gap-2 px-2">
        <span class="flex flex-row justify-between">
            <h1 class="font-semibold text-xl">@tr('company.list.title')</h1>
            @can('create', App\Models\Company::class)
                <x-primary-link href="{{ route('companies.create') }}">
                    @tr('company.create.title')
                </x-primary-link>
            @endcan
        </span>
        <section id="companies" class="flex flex-row flex-wrap gap-2">
            @foreach ($companies as $company)
                <x-company-entry :company=$company />
            @endforeach

            @if (count($companies) == 0)
                <em class="text-gray-400 w-full text-center py-8">@tr('list.empty')</em>
            @endif
        </section>
        <x-page-navigation :paginator="$companies" width=5 class="border-t border-l-brd/10" />
    </main>
</x-main-layout>
