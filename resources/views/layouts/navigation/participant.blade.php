<a href="{{ route('participant.dashboard') }}" class="text-white hover:text-blue-300 text-lg">Dashboard</a>
<a href="{{ route('participant.activities') }}" class="text-white hover:text-blue-300 text-lg">Activities</a>
<a href="{{ route('participant.games') }}" class="text-white hover:text-blue-300 text-lg">Mes matches</a>
<a href="#name" class="text-white font-bold hover:text-blue-300 text-lg">{{ Auth::user()->nom }}</a>
