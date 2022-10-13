<x-main-layout title="404">
    <main class="flex flex-col items-center m-4">
        <h1 class="text-2xl font-bold">404</h1>
        <em class="text-gray-400 w-full text-center py-8">@tr('not_found')</em>
        <span class="flex flex-row flex-wrap gap-4">
            <a href="/" class="underline font-semibold">@tr('not_found.main_page')</a>
            <a href="{{ route('jobs.index') }}" class="underline font-semibold">@tr('not_found.job_list')</a>
        </span>
    </main>
</x-main-layout>
