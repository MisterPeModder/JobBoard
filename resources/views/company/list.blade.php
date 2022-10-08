{{-- The list of companies in the 'GET /companies' route --}}

<x-main-layout :title="__('company.list.title')">
    <main class="container mx-auto py-2 divide-y divide-l-brd/10 flex flex-col gap-2">
        <section id="companies" class="flex flex-row flex-wrap gap-2 px-2">
            @foreach ($companies as $company)
                <x-company-entry :company=$company />
            @endforeach
        </section>
        <x-page-navigation :max=$maxPage :current=$currentPage width=5 />
    </main>
</x-main-layout>
