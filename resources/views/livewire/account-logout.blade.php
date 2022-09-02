<div>
    <div x-data="{openLogout: false}" x-on:click.away="openLogout = false" class="relative w-full flex justify-end">
        <div x-on:click="openLogout = !openLogout" class="flex cursor-pointer items-center">
            @if(Auth::user()->avatar_path == NULL)
                <img class="w-9 h-9 mr-2" src="{{asset('images/user-default.png')}}" alt=""> 
            @else
                <img class="w-9 rounded-full h-9 mr-2" src="{{asset(Auth::user()->avatar_path)}}" alt="">
            @endif
            <p class="font-bold text-base">{{ Auth::user()->name }}</p>
            <button class="ml-4 w-9 h-9 rounded-lg bg-white flex items-center justify-center">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224 416c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L224 338.8l169.4-169.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-192 192C240.4 412.9 232.2 416 224 416z"/></svg>
            </button>
        </div>
        <div x-cloak x-show="openLogout" x-transition class="absolute top-full mt-3 right-0 w-72 p-4 bg-white rounded-lg shadow-sm">
            <p>{{ Auth::user()->name }}</p>
            <p class="text-gray-400">{{ Auth::user()->email }}</p>
            <span class="h-px w-full my-2 bg-gray-100 block"></span>
            <form class="" method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="w-full text-center py-3 block bg-[#f80000] text-white rounded-lg" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    logout
                </a>
            </form>
        </div>
    </div>



</div>
