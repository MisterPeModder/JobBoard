{{-- List of all users, admin-only --}}

<x-main-layout title="{{ __('admin.users.title') }}">
    <main class="container mx-auto py-2 flex flex-col gap-2 px-2">
        <span class="flex flex-row flex-wrap gap-2 justify-start md:relative">
            <x-secondary-link :admin="true" href="{{ route('admin.index') }}" class="md:absolute md:left-0 md:top-0">
                @svg('resources/images/left-angle.svg', 'fill-admin group-hover:fill-admin-light mr-1')
                @tr('admin.back')
            </x-secondary-link>

            <h1 class="font-semibold text-xl w-full h-[2em] text-center order-first">
                @tr('admin.users.title')
            </h1>
        </span>

        <x-page-navigation :paginator="$users" width=5 class="border-t border-l-brd/10" />
        <section id="users" class="flex flex-row flex-wrap gap-2">
            @foreach ($users as $user)
                <x-user-entry :user=$user />
            @endforeach

            @if (count($users) == 0)
                <em class="text-gray-400 w-full text-center py-8">@tr('list.empty')</em>
            @endif
        </section>
        <x-page-navigation :paginator="$users" width=5 class="border-t border-l-brd/10" />

    </main>
</x-main-layout>
