<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font overflow-hidden">
                        <div class="container px-5 py-2 mx-auto">
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <form action="{{ route('tweets.store') }}" method="POST">
                                        @csrf
                                        <textarea id="tweet" name="tweet" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                        <div class="p-2 mt-2 w-full">
                                            <button type="submit" class="flex ml-auto flex-row-reverse text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded">ツイート</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @foreach ($tweets as $tweet)
                                <div class="border-b mb-4">
                                    <div class="py-8 flex flex-wrap md:flex-nowrap">
                                        <div class="h-20 w-20 sm:mr-10 inline-flex mr-auto flex-shrink-0">
                                            <a href="{{ route('users.show', ['user' => $tweet->user_id]) }}">
                                                <img src="{{ asset('images/' . $tweet->user->image) }}" class="">
                                            </a>
                                        </div>
                                        <div class="md:flex-grow">
                                            <span class="font-semibold title-font text-gray-700 mr-2">{{ $tweet->user->name }}</span>
                                            <span class="mt-1 text-gray-500 text-sm">{{ $tweet->created_at->diffForHumans() }}</span>
                                            <p class="leading-relaxed">{{ $tweet->tweet }}</p>
                                            <div class="flex justify-end mr-2">
                                                <a class="flex ml-2 justify-center items-center" href="#">
                                                    <i class="fa-regular fa-message text-lg"></i>
                                                    <p class="ml-1 text-lg">{{ $tweet->comments->count() }}</p>
                                                </a>
                                                <a class="flex ml-2 justify-center items-center" href="#">
                                                    <i class="fa-regular fa-heart text-lg"></i>
                                                    <p class="ml-1 text-lg">{{ $tweet->favorites->count() }}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
