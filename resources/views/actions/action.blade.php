<a
    @if(\Illuminate\Support\Facades\Route::has($action))
        href="{{ route($action, [$key]) }}"
    @else
        href="#"
        wire:click.prevent="{{ $action }}({{ $key }})"
    @endif
>
    <svg class="w-5 h-5 text-gray-700 hover:text-gray-500 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        @yield('icon')
    </svg>
</a>