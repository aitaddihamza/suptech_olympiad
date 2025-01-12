<!-- Navigation Menu -->
<a href="{{ route('admin.dashboard') }}" class="text-white hover:text-blue-300 text-lg">Dashboard</a>
<a href="{{ route('admin.activity.index') }}" class="text-white hover:text-blue-300 text-lg">Activities</a>
<a href="{{ route('admin.participant.index') }}" class="text-white hover:text-blue-300 text-lg">Participants</a>
<a href="{{ route('admin.game.index') }}" class="text-white hover:text-blue-300 text-lg">Matches</a>
<a href="#name" class="text-white font-bold hover:text-blue-300 text-lg">{{ Auth::user()->nom }} </a>
