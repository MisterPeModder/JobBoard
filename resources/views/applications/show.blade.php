<x-main-layout :showprofile="false">
    <table class="w-full mt-5">
        <thead>
            <tr>
                <th class="font-semibold text-xl mt-5">Applies to adverts</th>
            </tr>
        </thead>
        @foreach ($company->adverts as $advert)
            @foreach ($advert->applications as $application)
                <tr class="flex flex-row items-center border">
                    @php
                        $applicant = App\Models\User::where('id', $application->applicant_id)->get()->first();
                    @endphp
                    <td class="border">{{ $advert->title}}</td>
                    <td>{{ $applicant->email}}</td>
                    <td>
                        <x-secondary-link href="{{ route('apply.show', $application) }}" class="m-2">
                            Details
                        </x-secondary-link>    
                    </td>
                    @switch($application->status)
                        @case('new')
                            <td class="m-2 text-xs text-cyan-300 bg-blue-900 border border-cyan-300 rounded-full py-1 px-2 items-center">
                                @tr('application.status.new') 
                            </td>
                            @break
                        @case('accepted')
                            <td class="m-2 text-xs text-lime-400 bg-green-900 border border-lime-400 rounded-full py-1 px-2 items-center">
                                @tr('application.status.accepted') 
                            </td>
                            @break
                        @case('denied')
                            <td class="m-2 text-xs text-yellow-400 bg-red-900 border border-yellow-400 rounded-full py-1 px-2 items-center">
                                @tr('application.status.denied') 
                            </td>
                            @break
                        @default
                    @endswitch
                </tr>
            @endforeach
        @endforeach
    </table>
</x-main-layout>