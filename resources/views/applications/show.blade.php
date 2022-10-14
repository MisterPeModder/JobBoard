<x-main-layout :showprofile="false">
    <div class="flex flex-col p-2">
        <div class="">
            <h1 class="font-semibold text-xl text-center">Job Applications</h1>
        </div>
        <div class="flex flex-row flex-wrap text-center">
            <p class="w-4/12">@tr('application.adverts')</p>
            <p class="w-4/12">@tr('application.applicant')</p>
            <p class="w-2/12"></p>
            <p class="w-1/12">@tr('application.status')</p>
        </div>
        @foreach ($company->adverts as $advert)
            @foreach ($advert->applications as $application)
                <div class="flex flex-row flex-wrap items-center text-center even:bg-gray-200 py-2">
                    @php
                        $applicant = App\Models\User::where('id', $application->applicant_id)
                            ->get()
                            ->first();
                    @endphp
                    <p class="w-4/12">{{ $advert->title }}</p>
                    <p class="w-4/12">{{ $applicant->email }}</p>
                    @can('view', $application)
                        <x-secondary-link href="{{ route('application.show', $application) }}">
                            @tr('application.details')
                        </x-secondary-link>
                    @endcan
                    <div class="w-1/12"></div>
                    @switch($application->status)
                        @case('new')
                            <p class="text-xs text-cyan-300 bg-blue-900 border border-cyan-300 rounded-full py-1 px-2">
                                @tr('application.status.new')
                            </p>
                        @break

                        @case('accepted')
                            <p class="text-xs text-lime-400 bg-green-900 border border-lime-400 rounded-full py-1 px-2">
                                @tr('application.status.accepted')
                            </p>
                        @break

                        @case('denied')
                            <p class="text-xs text-yellow-400 bg-red-900 border border-yellow-400 rounded-full py-1 px-2">
                                @tr('application.status.denied')
                            </p>
                        @break

                        @default
                    @endswitch
                </div>
            @endforeach
        @endforeach
    </div>
</x-main-layout>
