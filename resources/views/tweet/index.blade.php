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
                        <div class="container px-5 py-24 mx-auto">
                            @foreach ($tweets as $tweet)
                                <div class="-my-8 divide-y-2 divide-gray-100">
                                    <div class="py-8 flex flex-wrap md:flex-nowrap">
                                        <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                                            <span class="font-semibold title-font text-gray-700">{{ $tweet->user->name }}</span>
                                            <span class="mt-1 text-gray-500 text-sm">12 Jun 2019</span>
                                        </div>
                                        <div class="md:flex-grow">
                                            <p class="leading-relaxed">{{ $tweet->tweet }}</p>
                                            <span class="mt-1 text-gray-500 text-sm">{{ $tweet->created_at->diffForHumans() }}</span>
                                            <i class="fa-regular fa-message"></i>{{ $tweet->comments->count() }}
                                            <i class="fa-regular fa-heart"></i>{{ $tweet->favorites->count() }}

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
