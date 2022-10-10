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
    <div class="shrink-0">
        <h3 class="font-semibold">
            @if ($member->id === $user?->id)
                {{ __('user.name.you', ['name' => $member->name, 'surname' => $member->surname]) }}
            @else
                {{ __('user.name', ['name' => $member->name, 'surname' => $member->surname]) }}
            @endif
        </h3>
        {{-- Only show member emails if the logged-in user is part of this company --}}
        @if ($user?->isMemberOf($company))
            <em>
                {{ $member->email }}
            </em>
        @endif
        <p>
            @if ($isOwner)
                @tr('user.role.owner')
            @else
                @tr('user.role.member')
            @endif
        </p>
    </div>
    @if ($editable && !$isOwner)
        <form method="POST"
            action="{{ route('companies.edit.member.remove', ['company' => $company, 'member' => $member]) }}"
            class="relative w-full h-full">
            @method('DELETE')
            @csrf

            <button type="submit" title="{{ __('company.members.delete') }}"
                class="absolute right-0 top-0 font-bold text-lg">&#10005;</button>

        </form>
    @endif
</div>
