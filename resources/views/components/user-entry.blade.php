{{-- A single entry in the list of admin users --}}

@props(['user'])

@php
$userUrl = route('users.edit', ['user' => $user, 'admin' => 1]);
$company = $user->company;
$iconUrl = $user->icon?->getUrl();
@endphp

<div {{ $attributes->merge(['id' => "user-$user->id"]) }}
    class="user relative bg-l-bgr-content rounded-md p-2 w-full border hover:border-2 hover:p-[calc(0.5rem-1px)] border-l-brd/10 hover:border-highlight">

    <div class="flex flex-row flex-wrap gap-2">
        @isset($iconUrl)
            <a href="{{ route('assets.edit', $user->icon) }}" class="font-semibold hover:underline shrink-0">
                <img src={{ $iconUrl }} alt="icon"
                    class="aspect-square h-20 p-1 border border-l-brd/10 border-solid rounded-xl">
            </a>
        @endisset

        <div class="border-l border-1 border-l-brd/10 pl-2 grid gap-1 grow-1 items-baseline">
            <a href="{{ $userUrl }}" class="font-semibold hover:underline col-span-2">
                <h2>{{ ($user->name !== null ? "$user->name " : '') . ($user->surname !== null ? "$user->surname " : '') . "(#$user->id)" }}
                    <h2>
            </a>

            <h3 class="col-start-1 text-base font-semibold">@tr('user.email')</h3>
            <p>{{ $user->email }}</p>

            <h3 class="col-start-1 text-base font-semibold">@tr('user.created_at')</h3>
            <p>{{ $user->created_at }}</p>

            <h3 class="col-start-1 text-base font-semibold">@tr('user.updated_at')</h3>
            <p>{{ $user->updated_at }}</p>

            <span class="col-start-1 flex flex-row flex-wrap gap-2 items-center">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @method('DELETE')
                    @csrf

                    <x-primary-button :disabled="$user->id === Auth::user()->id" :admin="true" class="flex flex-row gap-2">
                        @svg('resources/images/delete.svg', 'fill-white')
                        @tr('user.delete')
                    </x-primary-button>
                </form>

                <x-secondary-link :admin="true" href="{{ $userUrl }}"
                    class="font-semibold hover:underline col-span-2 flex flex-row gap-2">
                    @svg('resources/images/pen.svg', 'fill-admin')
                    @tr('admin.user.edit')
                </x-secondary-link>
            </span>
        </div>
    </div>
</div>
