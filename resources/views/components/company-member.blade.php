{{-- A removale (if enabled) company member card --}}

@props(['member', 'editable' => false])

@php
$iconUrl = $member->icon?->getUrl();
$company = $member->company;
$isOwner = $company->owner_id === $member->id;
$background = $isOwner ? 'bg-highlight-light/10' : 'bg-l-bgr-main';
$user = Illuminate\Support\Facades\Auth::user();
@endphp

<div
    {{ $attributes->merge(['class' => "flex flex-row border-2 border-highlight/10 items-center gap-2 $background rounded-xl w-full md:w-[calc(50%-0.5rem)] lg:w-[calc(25%-0.5rem)] pt-1 pl-1 pb-1 pr-2"]) }}>
    @isset($iconUrl)
        <img src={{ $iconUrl }} alt="icon"
            class="aspect-square p-1 border border-l-brd/10 border-solid rounded-full h-[4em]">
    @endisset
    <div class="shrink-0 flex flex-col w-[calc(calc(100%-4em)-0.5rem)]">
        <span class="flex flex-row flex-between">
            <h3 class="font-semibold shrink-0">
                @if ($member->id === $user?->id)
                    {{ __('user.name.you', ['name' => $member->name, 'surname' => $member->surname]) }}
                @else
                    {{ __('user.name', ['name' => $member->name, 'surname' => $member->surname]) }}
                @endif
            </h3>

            @if ($editable && !$member->owns($company))
                @can('update-members', $company)
                    <form method="POST"
                        action="{{ route('companies.edit.member.remove', ['company' => $company, 'member' => $member]) }}"
                        class="relative w-full h-full">
                        @method('DELETE')
                        @csrf

                        <button type="submit" title="{{ __('company.members.delete') }}"
                            class="absolute right-0 top-0 font-bold text-lg">&#10005;</button>

                    </form>
                @endcan
            @endif
        </span>
        {{-- Only show member emails if the logged-in user is part of this company --}}
        @if ($user?->isMemberOf($company))
            <em class="overflow-hidden">
                {{ $member->email }}
            </em>
        @endif
        <span class="flex flex-row justify-between">
            <p>
                @if ($isOwner)
                    @tr('user.role.owner')
                @else
                    @tr('user.role.member')
                @endif
            </p>
            @if ($editable && !$isOwner)
                @can('change-owner', $company)
                    <form method="GET"
                        action="{{ route('companies.edit.set-owner', ['company' => $company, 'owner' => $member]) }}">
                        @csrf

                        <button type="submit" title="{{ __('company.members.transfer_ownership') }}"
                            class="text-highlight hover:text-highlight-light">
                            @tr('company.members.transfer_ownership')
                        </button>
                    </form>
                @endcan
            @endif
        </span>

    </div>
</div>
