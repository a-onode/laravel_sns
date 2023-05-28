<div id="edit-tweet-{{ $tweetId }}" class="edit-modal hidden relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="fixed inset-0 bg-gray-500 bg-opacity-20 transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

            <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-lg transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <img class="inline-block h-10 w-10 rounded-full" src="{{ asset('storage/' . Auth::user()->image) }}">
                    </div>
                    <div class="min-w-0 flex-1">
                        <form action="{{ route('tweets.update', ['tweet' => $tweetId]) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="border-b border-gray-200 focus-within:border-indigo-600">
                                <label for="tweet" class="sr-only">投稿を編集する</label>
                                <textarea rows="3" name="tweet" id="tweet" class="block w-full resize-none border-0 border-b border-transparent p-0 pb-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-0 sm:text-sm sm:leading-6" placeholder="投稿を編集する">{{ $tweetText }}</textarea>
                            </div>
                            <div class="flex justify-end pt-2">
                                <div class="flex items-center justify-between space-x-3 px-2 py-2 sm:px-3">
                                    <div class="flex">
                                        <label class="group -my-2 -ml-2 inline-flex items-center rounded-full px-3 py-2 text-left text-gray-400">
                                            <svg class="-ml-1 mr-2 h-5 w-5 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-sm italic text-gray-500 group-hover:text-gray-600">ファイルを編集する</span>
                                            <input id="image" name="image" type="file" class="sr-only">
                                        </label>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="close-modal-button inline-flex items-center rounded-md px-3 py-2 text-sm font-semibold ttext-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" data-target="close-moodal-{{ $tweetId }}">キャンセル</button>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">編集する</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
