<!-- Navigation Menu -->
<nav class="hidden md:flex  space-x-6">
    <a href="#about" class="text-black hover:text-blue-300 text-lg">Dashboard</a>
    <a href="#activities" class="text-black hover:text-blue-300 text-lg">Activities</a>
    <a href="#events" class="text-black hover:text-blue-300 text-lg">Organistors</a>
    <form action="{{ route('logout') }}">
        <button type="submit">logout</button>
    </form>
</nav>
