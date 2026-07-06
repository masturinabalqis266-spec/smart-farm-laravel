<aside class="fixed top-0 left-0 w-72 h-screen bg-green-800 text-white shadow-lg flex flex-col z-50">

    <div class="p-6 border-b border-green-700 flex items-center gap-3">
        <img src="{{ asset('image/logo.png') }}"
             alt="Logo"
             style="width:55px; height:55px;"
             class="rounded-full bg-white p-1">

        <div>
            <h2 class="text-2xl font-bold">Smart Farm</h2>
            <p class="text-green-200 text-sm">Worker Panel</p>
        </div>
    </div>

    <nav class="p-4 space-y-2">

        <a href="{{ route('worker.dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('worker.dashboard') ? 'bg-white text-green-800 shadow' : 'hover:bg-green-700' }}">
            📊 <span>Dashboard</span>
        </a>

        <a href="{{ route('worker.tasks.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('worker.tasks.*') ? 'bg-white text-green-800 shadow' : 'hover:bg-green-700' }}">
            📋 <span>My Tasks</span>
        </a>

        <a href="{{ route('worker.harvest.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('worker.harvest.*') ? 'bg-white text-green-800 shadow' : 'hover:bg-green-700' }}">
            🍈 <span>Harvest Record</span>
        </a>

        <a href="{{ route('worker.pest_reports.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('worker.pest.*') ? 'bg-white text-green-800 shadow' : 'hover:bg-green-700' }}">
            🐛 <span>Pest Report</span>
        </a>

        <a href="{{ route('worker.inventory.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('worker.inventory.*') ? 'bg-white text-green-800 shadow' : 'hover:bg-green-700' }}">
            📦 <span>Inventory Usage</span>
        </a>

    </nav>

    <div class="mt-auto p-4 border-t border-green-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                    class="w-full bg-white text-green-800 hover:bg-green-100 py-3 rounded-xl font-semibold">
                Logout
            </button>
        </form>
    </div>

</aside>