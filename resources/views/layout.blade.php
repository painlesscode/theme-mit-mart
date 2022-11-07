<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{ app(\Painlesscode\ModuleConnector\TagInjector::class)->renderStylesTag() }}
</head>

<body class="font-sans antialiased">
    <div class="relative flex min-h-screen w-full flex-col" x-data="{ sidebarOpen : window.innerWidth >= 1024, width: window.innerWidth }" @resize.window="width = window.innerWidth" x-init="window.addEventListener('resize', () => { sidebarOpen = window.innerWidth >= 1024 })">
        <div class="z-10 flex w-full bg-gray-200 lg:justify-between shadow lg:shadow-none">
            <div class="p-4 cursor-pointer lg:hidden" x-on:click="sidebarOpen = !sidebarOpen">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                </svg>

            </div>
            <div class="flex flex-grow items-center justify-center lg:flex-grow-0">
                <div class="lg:shadow-r flex w-auto items-center justify-center self-stretch text-xl font-semibold lg:w-64 lg:bg-white">{{ config('app.name') }}</div>
            </div>
            <div class="lg:flex-grow flex justify-end lg:shadow" x-data="{ dropped: false }" x-on:click.outside="dropped = false">
                <div class="p-4 cursor-pointer" x-on:click="dropped = !dropped">{{ auth()->guard($guard)->user()->name ?? 'Unknown' }}</div>
                <div class="w-48 fixed top-14 right-0 bg-white rounded-b shadow z-10" x-show="dropped" x-transition:enter="transition origin-top ease-out duration-100" x-transition:enter-start="opacity-0 scale-y-0" x-transition:enter-end="opacity-100 scale-y-100" x-transition:leave="transition origin-top ease-in duration-100" x-transition:leave-start="opacity-100 scale-y-100" x-transition:leave-end="opacity-0 scale-y-0">
                    <div class="p-2 cursor-pointer hover:font-semibold">
                        @if(Route::has($logoutRouteName))
                        <form method="POST" action="{{ route($logoutRouteName) }}">
                            @csrf
                            <div onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </div>
                        </form>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        <div x-bind:class="sidebarOpen ? 'left-0' : '-left-64'" class="fixed transition-all top-0 bottom-0 z-0 flex w-64 flex-col bg-white pt-16 font-semibold text-gray-600 lg:left-0 nav-links">
            @foreach(app(\Painlesscode\ModuleConnector\Menu\MenuRegisterer::class)->getMenus($guard) as $menu)
            @if(count($menu->children) === 0)
            <div class="block w-full cursor-pointer">
                <a class="block p-2 hover:text-gray-800" href="{{ value($menu->target) }}">{{ __($menu->name) }}</a>
            </div>
            @else
            <div class="flex w-full cursor-pointer flex-wrap justify-between" x-data="{ open: false }">
                <div class="flex w-full justify-between" x-on:click="open = !open">
                    <div class="p-3">{{ __($menu->name) }}</div>
                    <div class="p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 transition" x-bind:class="open ? 'rotate-90' : ''">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex flex-wrap w-full border-l-2" x-show="open" x-on:active="open = true" x-transition:enter="transition origin-top ease-out duration-100" x-transition:enter-start="opacity-0 scale-y-0" x-transition:enter-end="opacity-100 scale-y-100" x-transition:leave="transition origin-top ease-in duration-100" x-transition:leave-start="opacity-100 scale-y-100" x-transition:leave-end="opacity-0 scale-y-0">
                    @foreach($menu->children as $submenu)
                    <div class="block w-full cursor-pointer">
                        <a class="block p-2 hover:text-gray-800" href="{{ $submenu->target }}">{{ __($submenu->name) }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <div class="ml-0 flex-grow lg:ml-64 bg-gray-200">
            {{ $slot ?? '' }}
        </div>
    </div>
    <script src="//unpkg.com/alpinejs"></script>
    <script type="text/javascript">
        window.onload = () => {
            const url = location.href.indexOf('?') > 0 ?
                location.href.substring(0, location.href.indexOf('?')) :
                location.href;
            document.querySelector('.nav-links').querySelectorAll("a").forEach(element => {
                if (url.match(new RegExp(`${element.href.replaceAll(/([./])/g, '\\$1')}\\\/?(create|\\d*\\\/edit|\\d*)$`))) {
                    element.classList.add('active')
                }
            })
            document.querySelectorAll("a.active").forEach(element => {
                element.classList.remove('hover:text-gray-800')
                'hover:text-gray-200 bg-gradient-to-r from-blue-700 to-sky-600 text-white mr-8 rounded-r-full'.split(' ')
                    .forEach(className => {
                        element.classList.add(className)
                    })
                element.dispatchEvent(
                    new CustomEvent("active", {
                        bubbles: true,
                    })
                );
            });
        };
    </script>
    {{ app(\Painlesscode\ModuleConnector\TagInjector::class)->renderScriptTag() }}
    {{ $script ?? '' }}
</body>

</html>
