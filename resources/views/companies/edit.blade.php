{{-- Edit properties of a company  --}}

@php
$id = $company->id;
$name = $company->name;
$description = $company->description;
$location = '';

if ($company->location !== null) {
    $location = $company->location;
}

$iconUrl = $company->icon?->getUrl();
$members = App\Models\User::where('company_id', $company->id)->get();
$user = Illuminate\Support\Facades\Auth::user();
@endphp

<x-main-layout :title="__($admin ? 'company.edit.title.admin' : 'company.edit.title')">
    <main class="container mx-auto py-2 flex flex-col gap-2 px-2">
        <span class="flex flex-row justify-start gap-2">
            @if ($admin)
                <x-secondary-link :admin="true"
                    href="{{ route('companies.show', ['company' => $company->id, 'admin' => 1]) }}" class="group">
                    @svg('resources/images/left-angle.svg', 'fill-admin group-hover:fill-admin-light mr-1')
                    @tr('company.show.admin')
                </x-secondary-link>
            @else
                <x-secondary-link href="{{ route('companies.show', $company->id) }}" class="group">
                    @svg('resources/images/left-angle.svg', 'fill-highlight group-hover:fill-highlight-light mr-1')
                    @tr('company.show')
                </x-secondary-link>
            @endif
            @can('create-advert', $company)
                <x-secondary-link :admin="$admin" href="{{ route('companies.jobs.create', ['company' => $company]) }}"
                    class="group">
                    <span
                        class="{{ $admin ? 'fill-admin group-hover:fill-admin-light' : 'fill-highlight group-hover:fill-highlight-light' }} ">
                        @svg('resources/images/star-outline.svg', 'mr-1')
                    </span>
                    @tr('advert.create')
                </x-secondary-link>
            @endcan
        </span>

        {{-- General Information Section --}}
        <form method="POST" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data"
            class="relative bg-l-bgr-content rounded-md p-2 w-full border border-l-brd/10">
            @method('PATCH')
            @csrf

            @if ($admin)
                <input type="hidden" name="admin" value="1">
            @endif

            <div class="w-full flex flex-row flex-wrap">
                <div
                    class="w-2/5 md:w-1/6 lg:w-1/12 flex flex-col md:items-center pb-2 md:pb-0 md:pr-2 md:text-center gap-2">
                    @isset($iconUrl)
                        <x-image-input id="icon" name="icon" :initial="$iconUrl" />
                    @else
                        <x-image-input id="icon" name="icon" />
                    @endisset
                    <x-input-label for="icon" :value="__('form.field.icon.edit')" />
                    <x-input-error field="icon" class="mt-2" />
                    @if ($admin)
                        <p>{{ "id: $company->id" }}</p>
                    @endif
                </div>
                <div
                    class="w-full md:w-5/6 lg:w-11/12 border-t md:border-t-0 md:border-l border-l-brd/10 pt-2 md:pt-0 pl-2">
                    {{-- Name --}}
                    <div>
                        <x-input-label for="name" :value="__('form.field.name') . '*'" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="$name" required autofocus />
                        <x-input-error field="name" class="mt-2" />
                    </div>

                    {{-- Location --}}
                    <div class="mt-4">
                        <x-input-label for="location" :value="__('form.field.location')" />
                        <x-text-input id="location" class="block mt-1 w-full" type="text" name="location"
                            :value="$location" autofocus />
                        <x-input-error field="location" class="mt-2" />
                    </div>


                    {{-- Description --}}
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('form.field.description') . '*'" />
                        <x-text-area id="description" class="block mt-1 w-full" name="description">
                            {{ $description }}
                        </x-text-area>
                        <x-input-error field="description" class="mt-2" />
                    </div>

                    {{-- Creation Date --}}
                    @if ($admin)
                        <div class="mt-4">
                            <x-input-label for="creation-date" :value="__('form.field.creation_date') . '*'" />
                            <x-text-input id="creation-date" class="block mt-1 w-full" type="text"
                                name="creation-date" :value="$company->created_at" autofocus />
                            <x-input-error field="creation-date" class="mt-2" />
                        </div>
                    @endif

                    <div><em class="w-full">@tr('form.field.required_hint')</em></div>
                </div>

                <div class="w-full flex items-center justify-end mt-4">
                    <x-primary-button :admin="$admin" class="ml-4">
                        @tr('company.edit')
                    </x-primary-button>
                </div>
            </div>
        </form>

        {{-- Members Section --}}
        <div class="relative bg-l-bgr-content rounded-md p-2 w-full border border-l-brd/10 flex flex-col gap-2">
            <h2 class="font-semibold pb-2">{{ __('company.members.edit', ['count' => $members->count()]) }}</h2>
            <div class="flex flex-row flex-wrap gap-2">
                @foreach ($members as $member)
                    <x-company-member :admin="$admin" :member="$member" :editable="true" />
                @endforeach
            </div>

            <form method="POST" action="{{ route('companies.edit.member.add', $company) }}">
                @csrf

                @if ($admin)
                    <input type="hidden" name="admin" value="1">
                @endif

                <x-input-label for="new-member" :value="__('form.field.new_member') . '*'" />
                <x-text-input id="new-member" class="mt-1" type="text" name="new-member" :value="old('new-member')"
                    placeholder="user@example.com" required autofocus />

                <x-primary-button :admin="$admin" class="ml-4">
                    @tr('company.members.add')
                </x-primary-button>
                <x-input-error field="new-member" class="mt-2" />
            </form>
        </div>

        {{-- Danger Zone Section --}}
        <form method="POST" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data"
            class="relative bg-l-bgr-content rounded-md p-2 w-full border border-l-brd/10">
            @method('DELETE')
            @csrf

            <h2 class="font-semibold pb-2">{{ 'Danger Zone' }}</h2>

            @if ($admin)
                <input type="hidden" name="admin" value="1">
            @endif

            <x-primary-button :admin="$admin" class="ml-4" :disabled="!$user?->can('delete', $company)">
                @tr('company.delete')
            </x-primary-button>
        </form>
    </main>
</x-main-layout>
