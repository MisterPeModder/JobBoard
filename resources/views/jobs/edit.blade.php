{{-- Edit properties of an advert --}}

@php
$user = Illuminate\Support\Facades\Auth::user();
$formatter = new \NumberFormatter(App::getLocale(), \NumberFormatter::DECIMAL);

$prevUrl = url()->previous();
if ($prevUrl == url()->current()) {
    // if previous url is the same, just use the job page as the back target
    $prevUrl = route('jobs.index');
}
@endphp

<x-main-layout :title="__('advert.edit')">
    <main class="container mx-auto py-2 flex flex-col gap-2 px-2">
        <span class="flex flex-row justify-start gap-2">
            <x-secondary-link href="{{ $prevUrl }}" class="group">
                @svg('resources/images/left-angle.svg', 'fill-highlight group-hover:fill-highlight-light mr-1')
                @tr('company.show')
            </x-secondary-link>
            <x-primary-link href="{{ route('companies.jobs.index', $advert->company) }}">
                @tr('company.adverts')
            </x-primary-link>
        </span>

        {{-- General Information Section --}}
        <form method="POST" action="{{ route('jobs.update', $advert->id) }}" enctype="multipart/form-data"
            class="relative bg-l-bgr-content rounded-md p-2 w-full border border-l-brd/10">
            @method('PATCH')
            @csrf

            <h1 class="text-xl font-bold pb-2">@tr('advert.edit')</h1>

            <div class="w-full">
                {{-- Title --}}
                <div>
                    <x-input-label for="title" :value="__('form.field.title') . '*'" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                        :value="$advert->title" required autofocus />
                    <x-input-error field="title" class="mt-2" />
                </div>

                {{-- Location --}}
                <div class="mt-4">
                    <x-input-label for="location" :value="__('form.field.location')" />
                    <x-text-input id="location" class="block mt-1 w-full" type="text" name="location"
                        placeholder="{{ __('form.not_set') }}" :value="$advert->location ?? ''" autofocus />
                    <x-input-error field="location" class="mt-2" />
                </div>

                {{-- Short Description --}}
                <div class="mt-4">
                    <x-input-label for="short-description" :value="__('advert.short_description', [
                        'lines' => \App\Http\Requests\UpdateAdvertRequest::MAX_SHORT_DESC_LINES,
                    ]) . '*'" />

                    <x-text-area id="short-description" class="block mt-1 w-full"
                        style="{{ 'height: ' . \App\Http\Requests\UpdateAdvertRequest::MAX_SHORT_DESC_LINES * 2 . 'em' }}"
                        name="short-description" required autofocus>
                        {{ $advert->short_description }}
                    </x-text-area>
                    <x-input-error field="short-description" class="mt-2" />
                </div>

                {{-- Salary --}}
                <div class="mt-4 border-t border-l-brd/10 pt-4">
                    <h3 class="block font-semibold text-sm text-gray-700 pb-2">@tr('form.field.salary')</h3>
                    <div
                        class="flex flex-row flex-wrap gap-2 border border-l-brd/10 rounded-xl p-2 shadow-inner shadow-l-brd/10">
                        <div>
                            <x-input-label for="salary-min" :value="__('form.field.salary_min')" />
                            <x-text-input id="salary-min" class="block mt-1 w-full" type="number" step="0.01"
                                placeholder="{{ __('form.not_set') }}" name="salary-min" :value="$advert->salary_min ? $formatter->format($advert->salary_min) : ''" autofocus />
                        </div>
                        <div>
                            <x-input-label for="salary-max" :value="__('form.field.salary_max')" />
                            <x-text-input id="salary-max" class="block mt-1 w-full" type="number" step="0.01"
                                placeholder="{{ __('form.not_set') }}" name="salary-max" :value="$advert->salary_max ? $formatter->format($advert->salary_max) : ''" autofocus />
                        </div>
                        <div>
                            <x-input-label for="salary-currency" :value="__('form.field.salary_currency')" />
                            <x-select id="salary-currency" name="salary-currency">
                                <option value="" @selected($advert->salary_currency === null)>
                                    {{ __('form.not_set') }}
                                </option>
                                @foreach (\App\Enums\Currency::cases() as $currency)
                                    <option value="{{ $currency->value }}" @selected($advert->salary_currency === $currency)>
                                        {{ __('currency.name_and_symbol', ['name' => $currency->value, 'symbol' => $currency->symbol()]) }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                        <div>
                            <x-input-label for="salary-type" :value="__('form.field.salary_type')" />
                            <x-select id="salary-type" name="salary-type">
                                <option value="" @selected($advert->salary_type === null)>
                                    {{ __('form.not_set') }}
                                </option>
                                @foreach (\App\Enums\SalaryType::cases() as $type)
                                    <option value="{{ $type->value }}" @selected($advert->salary_type === $type)>
                                        {{ __("salary_type.$type->value") }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full">
                            <x-input-error field="salary-min" />
                            <x-input-error field="salary-max" />
                            <x-input-error field="salary-currency" />
                            <x-input-error field="salary-type" />
                        </div>
                    </div>
                </div>

                {{-- Job Type --}}
                <div class="mt-4">
                    <x-input-label for="job-type" :value="__('form.field.job_type')" />
                    <x-select id="job-type" name="job-type">
                        <option value="" @selected($advert->job_type !== null)>
                            {{ __('form.not_set') }}
                        </option>
                        @foreach (\App\Enums\JobType::cases() as $type)
                            <option value="{{ $type->value }}" @selected($advert->job_type === $type)>
                                {{ __("job_type.$type->value") }}
                            </option>
                        @endforeach
                    </x-select>
                </div>


                {{-- Full Description --}}
                <div class="mt-4 border-t border-l-brd/10 pt-4">
                    <x-input-label for="full-description" :value="__('advert.full_description') . '*'" />
                    <x-text-area id="full-description" class="block mt-1 w-full" name="full-description" required>
                        {{ $advert->full_description }}
                    </x-text-area>
                    <x-input-error field="full-description" class="mt-2" />
                </div>

                <div><em class="w-full">@tr('form.field.required_hint')</em></div>
            </div>

            <div class="w-full flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    @tr('company.edit')
                </x-primary-button>
            </div>
        </form>

        {{-- Danger Zone Section --}}
        <form method="POST" action="{{ route('jobs.destroy', $advert->id) }}"
            class="relative bg-l-bgr-content rounded-md p-2 w-full border border-l-brd/10">
            @method('DELETE')
            @csrf

            <h2 class="font-semibold pb-2">{{ 'Danger Zone' }}</h2>
            <x-primary-button class="ml-4" :disabled="!$user?->can('delete', $advert)">
                @tr('advert.delete')
            </x-primary-button>
        </form>
    </main>
</x-main-layout>
