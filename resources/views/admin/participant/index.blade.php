@extends('layouts.app')
@section('title', 'tous les participants')
@section('content')

    <div class="flex flex-col max-w-7xl mx-auto mt-8 overflow-x-auto">
        <form action="{{ route('admin.participant.index') }}" method="GET" class="flex items-center gap-2 mb-2 pt-4">
            @csrf
            <input type="text" class="border border-solid p-2 rounded" name="prenom" placeholder="prénom"
                value="{{ $inputs['prenom'] ?? '' }}">
            <input type="text" class="border border-solid p-2 rounded" name="nom" placeholder="nom"
                value="{{ $inputs['nom'] ?? '' }}">
            <select name="activity" class="border border-solid p-2 rounded bg-white flex-1">
                <option value="ping_pong"
                    {{ isset($inputs['activity']) && $inputs['activity'] == 'ping_pong' ? 'selected' : '' }}>Ping Pong
                </option>
                <option value="chess" {{ isset($inputs['activity']) && $inputs['activity'] == 'chess' ? 'selected' : '' }}>
                    Chess</option>
                <option value="tous" {{ !isset($inputs['activity']) ? 'selected' : '' }}>Tous</option>
            </select>
            <button class="btn bg-black">Rechercher</button>
        </form>
        @include('shared.flash')
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-medium">Tous les participants </h1>
        </div>
        <table class="min-w-full divide-y divide-gray-200 mt-4">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prénom </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activitées
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($participants as $participant)
                    <tr class="hover:bg-papayawhip">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $participant->nom }} </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $participant->prenom }} </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $participant->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @for ($i = 0; $i < count($participant->activities); $i++)
                                @if ($i == count($participant->activities) - 1)
                                    {{ $participant->activities[$i]->name }}
                                @else
                                    {{ $participant->activities[$i]->name . ' && ' }}
                                @endif
                            @endfor
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center mt-4">
                            Aucun participant trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-2">{{ $participants->links() }} </div>
    </div>

@endsection
