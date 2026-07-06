<aside class="fixed top-0 left-0 w-72 h-screen bg-green-800 text-white shadow-lg flex flex-col z-50">

    <div class="p-6 border-b border-green-700 flex items-center gap-3">
        <img src="{{ asset('image/logo.png') }}"
             style="width:55px; height:55px;"
             class="rounded-full bg-white p-1"
             alt="Logo">

        <div>
            <h2 class="text-2xl font-bold">Smart Farm</h2>
            <p class="text-green-200 text-sm">Manager Panel</p>
        </div>
    </div>

    <nav class="p-4 space-y-2">

        <a href="{{ route('manager.dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('manager.dashboard') ? 'bg-white text-green-800 shadow' : 'hover:bg-green-700' }}">
            📊 <span>Dashboard</span>
        </a>

        <a href="{{ route('manager.tasks.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('manager.tasks.*') ? 'bg-white text-green-800 shadow' : 'hover:bg-green-700' }}">
            ✅ <span>Assign Task</span>
        </a>

        <a href="{{ route('manager.crops.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('manager.crops.*') ? 'bg-white text-green-800 shadow' : 'hover:bg-green-700' }}">
            🌿 <span>Monitor Crop</span>
        </a>

        <a href="{{ route('manager.reports.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('manager.reports.*') ? 'bg-white text-green-800 shadow' : 'hover:bg-green-700' }}">
            🐛 <span>Review Report</span>
        </a>

        <a href="{{ route('manager.analytics.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('manager.analytics.*') ? 'bg-white text-green-800 shadow' : 'hover:bg-green-700' }}">
            📈 <span>View Analytics</span>
        </a>

        <a href="{{ route('manager.harvest.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('manager.harvest.*') ? 'bg-white text-green-800 shadow' : 'hover:bg-green-700' }}">
            🍈 <span>Manage Harvest</span>
        </a>

        <a href="{{ route('manager.export.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition
           {{ request()->routeIs('manager.export.*') ? 'bg-white text-green-800 shadow' : 'hover:bg-green-700' }}">
            📄 <span>Export Reports</span>
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