@if (session('success'))
    <p class="max-w-3xl bg-teal-500 text-white p-2 rounded my-2">
        {{ session('success') }}
    </p>
@endif
@if (session('warning'))
    <p class="max-w-3xl bg-red-500 text-white p-2 rounded my-2">
        {{ session('warning') }}
    </p>
@endif
@if (session('infos'))
    <p class="max-w-3xl bg-blue-500 text-white p-2 rounded my-2">
        {{ session('infos') }}
    </p>
@endif
@if (session('message'))
    <p class="max-w-3xl bg-black text-white p-2 rounded my-2">
        {{ session('message') }}
    </p>
@endif
