<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('通知') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul role="list" class="divide-y divide-gray-100">
                        @foreach ($notifications as $notification)
                            @if ($notification->type === 1)
                                <li class="relative flex justify-between gap-x-6 py-5">
                                    <div class="flex gap-x-4">
                                        <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ asset('storage/' . $notification->serveUser->image) }}">
                                        <div class="min-w-0 flex-auto">
                                            <a href="{{ route('users.show', ['user' => $notification->serve_id]) }}" class="text-sm font-semibold leading-6 text-gray-900">
                                                {{ $notification->serveUser->name }}さんがいいねしました。
                                            </a>
                                            <p class="text-xs leading-5 text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                            <a href="{{ route('tweets.show', ['tweet' => $notification->tweet_id]) }}" class="mt-1 flex text-xs leading-5 text-gray-500">{{ $notification->tweets->tweet }}</a>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-x-4">

                                        <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </li>
                            @elseif ($notification->type === 2)
                                <li class="relative flex justify-between gap-x-6 py-5">
                                    <div class="flex gap-x-4">
                                        <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ asset('storage/' . $notification->serveUser->image) }}">
                                        <div class="min-w-0 flex-auto">
                                            <a href="{{ route('users.show', ['user' => $notification->serve_id]) }}" class="text-sm font-semibold leading-6 text-gray-900">
                                                {{ $notification->serveUser->name }}さんコメントしました。
                                            </a>
                                            <p class="text-xs leading-5 text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                            <a href="{{ route('tweets.show', ['tweet' => $notification->tweet_id]) }}" class="mt-1 flex text-xs leading-5 text-gray-500">{{ $notification->tweets->tweet }}</a>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-x-4">
                                        <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </li>
                            @else
                                <li class="relative flex justify-between gap-x-6 py-5">
                                    <div class="flex gap-x-4">
                                        <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ asset('storage/' . $notification->serveUser->image) }}">
                                        <div class="min-w-0 flex-auto">
                                            <a href="{{ route('users.show', ['user' => $notification->serve_id]) }}" class="text-sm font-semibold leading-6 text-gray-900">
                                                {{ $notification->serveUser->name }}さんがあなたをフォローしました。
                                            </a>
                                            <p class="text-xs leading-5 text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-x-4">
                                        <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
