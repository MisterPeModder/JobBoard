@php
    $applicant = App\Models\User::where('id', $application->applicant_id)->get()->first();
    $iconUrl = $applicant->icon?->getUrl();
    $attachments = $application->attachments;
@endphp
<x-main-layout :showprofile="false">
    <h1 class="font-semibold text-xl text-center pt-5">@tr('application.details.each')</h1>

    <div class="flex flex-col p-5">
        @isset($iconUrl)
            <div class="flex flex-row flex-wrap">
                <p class="w-1/4">@tr('form.field.icon')</p> 
                <img src={{ $iconUrl }} alt="icon"
                    class="aspect-square p-1 border border-l-brd/10 border-solid rounded-full h-[4em]">
            </div>
        @endisset
        <div class="flex flex-row flex-wrap">
            <p class="w-1/4">@tr('application.name')</p> 
            <p class="w-3/4">{{ $applicant->name }}</p>
        </div>
        @isset($applicant->surname)
            <div class="flex flex-row flex-wrap">
                <p class="w-1/4">@tr('application.surname')</p> 
                <p class="w-3/4">{{ $applicant->surname }}</p>
            </div>
        @endisset
        <div class="flex flex-row flex-wrap">
            <p class="w-1/4">@tr('application.email')</p> 
            <p class="w-3/4">{{ $applicant->email }}</p>
        </div>
            <div class="flex flex-row flex-wrap">
                <p class="w-1/4">@tr('application.content')</p> 
                {{ $application->content }}
            </div>
            <div class="flex flex-row flex-wrap">
            <p class="w-1/4">@tr('application.attachments')</p>
            @foreach ($attachments as $attachment)
                @if ($attachment->mime_type == 'application/pdf')
                    <a href="{{ $attachment->getUrl() }}" target="_blank" class="w-1/4 text-center underline text-blue-900">@tr('application.pdf')</a>
                @else
                    <img src="{{ $attachment->getUrl() }}" alt="@tr('application.image')" class="w-1/4">
                @endif
            @endforeach
        </div>
        <div class="flex flex-row flex-wrap">
            <div class="w-8/12"></div>
            <form method="POST" action="{{ route("application.updateAccepted", $application) }}">
                @method('PUT')
                @csrf
                <button type="submit" class="bg-green-700 hover:bg-green-500 transition ease-in-out duration-150 text-white rounded-xl p-2 text-sm flex items-center whitespace-nowrap font-semibold">
                    @tr('application.accept')</button>
            </form>
            <div class="w-1/12"></div>
            <form method="POST" action="{{ route("application.updateDenied", $application) }}">
                @method('PUT')
                @csrf
                <button class="bg-red-700 hover:bg-red-500 transition ease-in-out duration-150 text-white rounded-xl p-2 text-sm flex items-center whitespace-nowrap font-semibold">
                    @tr('application.deny')</button>
            </form>
        </div>
    </div>
</x-main-layout>