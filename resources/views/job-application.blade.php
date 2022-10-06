<x-layout title="Apply - Job Board" script="resources/js/jobApplication.ts">
    <main class="mx-auto p-2 my-2 w-11/12 bg-l-bgr-content rounded-md border-2 border-highlight">
        <h1 class="font-semibold">{{ $advert->title }}</h1>
        <form method="POST" action="{{ route('jobs.apply.store', $advert->id) }}" enctype="multipart/form-data"
            class="flex flex-row flex-wrap gap-2">
            @csrf

            <label for="name" class="w-full">@tr('advert.apply.name')*</label>
            <input id="name" class="w-full" name="name" type="text" required autofocus
                value="{{ old('name') }}">
            <x-input-error field="name" />

            <label for="surname" class="w-full">@tr('advert.apply.surname')</label>
            <input id="surname" class="w-full" name="surname" type="text" autofocus value="{{ old('surname') }}">
            <x-input-error field="surname" />

            <label for="email" class="w-full">@tr('advert.apply.email')*</label>
            <input id="email" class="w-full" name="email" type="email" required value="{{ old('email') }}">
            <x-input-error field="email" />

            <label for="phone-number" class="w-full">@tr('advert.apply.phone_number')</label>
            <input id="phone-number" class="w-full" name="phone-number" type="tel"
                value="{{ old('phone-number') }}">
            <x-input-error field="phone-number" />

            <label for="message" class="w-full">@tr('advert.apply.message')*</label>
            <textarea id="message" class="w-full" name="message" required
                maxlength={{ App\Http\Requests\StoreJobApplicationRequest::MAX_MESSAGE_SIZE + 4000 }}>{{ old('message') }}</textarea>
            <x-input-error field="message" />

            <label for="attachments" class="w-full">@tr('advert.apply.attachments')</label>
            <input id="attachments" class="w-full" name="attachments[]" type="file" multiple
                accept="image/jpeg,image/png,image/webp,application/pdf,application/msword,application/vnd.oasis.opendocument.text">
            <x-input-error field="attachments" />

            <em class="w-full">@tr('advert.apply.required_hint')</em>

            <button
                type="submit "class="bg-highlight hover:bg-highlight-light transition ease-in-out duration-150 text-white rounded-xl p-2 text-sm flex items-center whitespace-nowrap font-semibold ">
                @tr('advert.apply')
            </button>
        </form>
    </main>
</x-layout>
