<x-main-layout :showprofile="false">
    <span class="p-5">
        <h1 class="font-semibold text-xl">Applies to adverts</h2>
        @foreach ($company->adverts as $advert)
            @foreach ($advert->applications as $application)
                <div class="flex flex-row items-center border mx-5">
                    @php
                        $applicant = App\Models\User::where('id', $application->applicant_id)->get()->first();
                    @endphp
                    <p class="m-2">{{ $advert->title}}</p>
                    <p class="m-2">{{ $applicant->email}}</p>
                    <x-secondary-link href="{{ route('apply.show', $application) }}" class="m-2">
                        Details
                    </x-secondary-link>
                    <x-secondary-link href="{{ route('apply.show', $application) }}" class="m-2 text-green-500 hover:text-green-400 border-green-500 hover:border-green-400">
                        Accept
                    </x-secondary-link>
                    <x-secondary-link href="{{ route('apply.show', $application) }}" class="m-2 text-red-500 hover:text-red-400 border-red-500 hover:border-red-400">
                        Deny
                    </x-secondary-link>
                </div>
            @endforeach
        @endforeach
        </div>
    </span>
</x-main-layout>