<section class="relative h-72 bg-sky-900 flex flex-col justify-center align-center text-center space-y-4 mb-4">
    <div
        class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
        style="background-image: url('images/background.png')"
    ></div>

    <div class="z-10">
        <h1 class="text-6xl font-bold uppercase text-white">
            Meet<span class="text-black">Up</span>
        </h1>
        <p class="text-2xl text-gray-200 font-bold my-4">
            Find an event and have fun!
        </p>
        @auth
        @else
        <div class="inline-block text-white text-lg">
            <a href="/register" class="text-base inline-block border-2 border-white text-white py-2 px-4 mx-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">
                Sign Up
            </a>
            or
            <a href="/login" class="text-base inline-block border-2 border-white text-white py-2 px-4 mx-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">
                Log In
            </a>
        </div>
        <div class="text-white py-1 text-lg">
            to List an Event
        </div>
        @endauth
    </div>
</section>