<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($tweet->user->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white px-4 pt-5 sm:px-6">
                <x-flash-message />
                <div class="flex space-x-4">
                    <div class="relative flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $tweet->user->image) }}">
                        @if ($tweet->user->isOnline())
                            <span class="absolute right-0 top-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-white"></span>
                        @else
                            <span class="absolute right-0 top-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                        @endif
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm font-semibold text-gray-900">
                                    <a href="#" class="hover:underline">{{ $tweet->user->name }}</a>
                                </p>
                                <p class="text-sm text-gray-500">
                                    <a href="#" class="hover:underline">{{ $tweet->created_at->diffForHumans() }}</a>
                                </p>
                            </div>
                            @if ($tweet->user_id === Auth::id())
                                <x-tweet.dropdown :tweet="$tweet" />
                            @endif
                        </div>
                        <a href="{{ route('tweets.show', ['tweet' => $tweet->id]) }}">
                            <p class="mt-2 text-gray-500">{{ $tweet->tweet }}</p>
                        </a>
                        @if (!is_null($tweet->image))
                            <div class="mx-auto max-w-7xl px-4 pt-4 sm:px-6 lg:px-8">
                                <div class="flex justify-center mx-auto max-w-4xl">
                                    <img src="{{ asset('storage/' . $tweet->image) }}" class="rounded-lg shadow-md">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul role="list" class="space-y-6">
                        @foreach ($tweet->comments as $comment)
                            <li>
                                <div class="relative pb-2">
                                    <div class="relative flex items-start space-x-3">
                                        <div class="relative">
                                            <img class="flex h-10 w-10 items-center justify-center rounded-full bg-white ring-8 ring-white" src="{{ asset('storage/' . $comment->user->image) }}">
                                            <span class="absolute -bottom-0.5 -right-1 rounded-tl bg-white px-0.5 py-px">
                                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 001.28.53l3.58-3.579a.78.78 0 01.527-.224 41.202 41.202 0 005.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0010 2zm0 7a1 1 0 100-2 1 1 0 000 2zM8 8a1 1 0 11-2 0 1 1 0 012 0zm5 1a1 1 0 100-2 1 1 0 000 2z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <div>
                                                <div class="text-sm">
                                                    <a href="#" class="font-medium text-gray-900">{{ $comment->user->name }}</a>
                                                </div>
                                                <p class="mt-0.5 text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                            </div>
                                            <div class="mt-2 text-sm text-gray-700">
                                                <p>{{ $comment->comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-6 flex gap-x-3">
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" class="h-6 w-6 flex-none rounded-full bg-gray-50">
                        <form action="{{ route('comments.store') }}" method="post" class="relative flex-auto">
                            @csrf
                            <div class="overflow-hidden rounded-lg pb-12 shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
                                <label for="comment" class="sr-only"></label>
                                <textarea rows="2" name="comment" id="comment" class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="コメントを追加する"></textarea>
                                <input type="hidden" name="tweet_id" id="tweet_id" value="{{ $tweet->id }}">
                            </div>
                            <div class="absolute inset-x-0 bottom-0 flex justify-end py-2 pl-3 pr-2">
                                <button type="submit" id="submit-button" class="inline-flex items-center rounded-md bg-indigo-200 px-3 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">コメントする</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const textField = document.getElementById('comment');
        const submitButton = document.getElementById('submit-button');

        textField.addEventListener('keyup', () => {
            if (textField.value !== '') {
                submitButton.disabled = false;
                submitButton.classList.remove('bg-indigo-200');
                submitButton.classList.add('bg-indigo-600', 'hover:bg-indigo-500');
            } else {
                submitButton.disabled = true;
                submitButton.classList.remove('bg-indigo-600', 'hover:bg-indigo-500');
                submitButton.classList.add('bg-indigo-200');
            }
        });
    </script>
</x-app-layout>
