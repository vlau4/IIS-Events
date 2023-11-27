@if(session()->has('err'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)"
        x-show='show' class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-rose-800 text-white px-48 py-3 opacity-90">
        <p>
            {{session('err')}}
        </p>
    </div>
@endif