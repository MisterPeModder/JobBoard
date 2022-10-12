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
                    @switch($application->status)
                        @case('new')
                            <p class="m-2 font-semibold text-xs text-cyan-300 bg-blue-900 border border-cyan-300 rounded-full p-1 items-center">
                                @tr('application.status.new') 
                            </p>
                            @break
                        @case('accepted')
                            <p class="m-2 font-semibold text-xs text-lime-400 bg-green-900 border border-lime-400 rounded-full p-1 items-center">
                                @tr('application.status.accepted') 
                            </p>
                            @break
                        @case('denied')
                            <p class="m-2 font-semibold text-xs text-yellow-400 bg-red-900 border border-yellow-400 rounded-full p-1 items-center">
                                @tr('application.status.denied') 
                            </p>
                            @break
                        @default
                            
                    @endswitch
                </div>
            @endforeach
        @endforeach
        </div>
    </span>
</x-main-layout>