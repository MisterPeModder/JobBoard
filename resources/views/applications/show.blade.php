<x-main-layout :showprofile="false">
    <table class=" pt-5 px-10">
        <thead>
            <tr class=" ">
                <th colspan="4" class="font-semibold text-xl text-center">Job Applications</th>
            </tr>
        </thead>
        <tr class=" ">
            <td>Adverts</td>
            <td>Applies to adverts</td>
            <td></td>
            <td>Status</td>
        </tr>
        @foreach ($company->adverts as $advert)
            @foreach ($advert->applications as $application)
                <tr class=" items-center border bg-white even:bg-gray-200">
                    @php
                        $applicant = App\Models\User::where('id', $application->applicant_id)->get()->first();
                    @endphp
                    <td class="shrink-0 border-4 border-gray-200 px-2">{{ $advert->title}}</td>
                    <td class="shrink-0 border-4 border-gray-200 px-2">{{ $applicant->email}}</td>
                    <td class="shrink-0 border-4 border-gray-200 px-2">
                        <x-secondary-link href="{{ route('apply.show', $application) }}" class="m-2">
                            Details
                        </x-secondary-link>    
                    </td>
                    
                    @switch($application->status)
                        @case('new')
                            <td class="shrink-0 text-center">
                                <span class="text-xs text-cyan-300 bg-blue-900 border border-cyan-300 rounded-full py-1 px-2 items-center">@tr('application.status.new')</span>
                            </td>
                            @break
                        @case('accepted')
                            <td class="shrink-0 text-center">
                                <span class="text-xs text-lime-400 bg-green-900 border border-lime-400 rounded-full py-1 px-2 items-center">@tr('application.status.accepted')</span>
                            </td>
                            @break
                        @case('denied')
                            <td class="shrink-0 text-center">
                                <span class="text-xs text-yellow-400 bg-red-900 border border-yellow-400 rounded-full py-1 px-2 items-center">@tr('application.status.denied')</span>
                            </td>
                            @break
                        @default
                    @endswitch
                </tr>
            @endforeach
        @endforeach
    </table>
</x-main-layout>