<x-main-layout>

    <p>Name: {{ $user->name }}</p>
    <p>Surname: {{ $user->surname }}</p>
    <p>Email: {{ $user->email }}</p>

    {{-- "Edit" widget, button to edit profile --}}
    <a href="{{ route('users.edit', Auth::user()) }}"
        lass="bg-highlight hover:bg-highlight-light transition ease-in-out duration-150 text-white rounded-full p-1.5 text-sm flex items-center whitespace-nowrap font-semibold">
        Edit</a>

</x-main-layout>