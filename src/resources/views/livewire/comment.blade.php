<div x-data="{ isReplying: $wire.entangle('isReplying') }">
    <article class="my-6 text-base bg-white rounded-lg">
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900">
                    <img src="{{ $comment->user->avatar() }}" alt="{{ $comment->user->name }}" class="mr-2 w-6 h-6 rounded-full">
                    {{ $comment->user->name }}
                </p>

                <p class="text-sm text-gray-600">
                    {{ $comment->created_at->diffForHumans() }}
                </p>
            </div>
        </footer>

        <!-- Comment Body -->
        <p class="text-gray-500">
            {{ $comment->body }}
        </p>

        <!-- Reply, Edit, Delete Section -->
        <div class="flex items-center mt-4 space-x-4">
            @if (!$comment->parent_id)
                <button @click="isReplying=!isReplying" type="button" class="flex items-center text-sm text-gray-500 hover:underline">
                    <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Reply
                </button>
            @endif

            <button type="button" class="flex items-center text-sm text-gray-500 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                Edit
            </button>

            <button type="button" class="flex items-center text-sm text-gray-500 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
                Delete
            </button>
        </div>
    </article>

    {{-- Reply form --}}
    <form wire:submit="storeReply" class="mb-6 ml-8 lg:ml-12" x-show="isReplying" x-transition>
        <label for="comment" class="sr-only">Your comment</label>
        <textarea wire:model="form.body" id="comment" style="resize: none;" placeholder="Write a reply..." rows="2" class="shadow-sm block rounded-md w-full
        @if($errors->has('form.body'))
            text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 border-red-300
        @else
            text-gray-900 focus:ring-blue-500 focus:border-blue-500 border-gray-300
        @endif"></textarea>
        <x-input-error :messages="$errors->get('form.body')" class="mt-2" />

        <button type="submit" class="inline-flex items-center py-1.5 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-blue-800 mt-4">
            Reply
        </button>

        <button @click="isReplying=!isReplying" type="button" class="py-1.5 px-3 text-xs font-medium text-gray-900 shadow-sm ring-1 ring-inset bg-white ring-gray-300 hover:bg-gray-50 rounded-lg">
            Cancel
        </button>
    </form>

    <div class="mt-6 ml-8 lg:ml-12">
        @foreach ($comment->replies as $reply)
            <livewire:comment :comment="$reply" :key="$reply->id" />
        @endforeach
    </div>
</div>
