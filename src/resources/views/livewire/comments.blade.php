<section class="bg-white py-8 lg:py-16">
    <div class="max-w-2xl mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900">
                Discussion (3)
            </h2>
        </div>

        @if ($comments->count())
            {{-- Comment Body --}}
            @foreach ($comments as $comment)
                <livewire:comment :$comment :key="$comment->id" />
            @endforeach

            <div class="my-5">
                {{ $comments->links() }}
            </div>
        @else
            <p class="text-gray-900">No Comments Yet</p>
        @endif

        {{-- Main Comment Form --}}
        <form class="mb-6" wire:submit="postComment">
            <div class="py-2 mb-4">
                <label for="comment" class="sr-only">Your comment</label>
                <textarea wire:model="form.body" id="comment" style="resize: none;" placeholder="Write a comment..." rows="4" class="shadow-sm block rounded-md w-full
                @if($errors->has('form.body'))
                    text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 border-red-300
                @else
                    text-gray-900 focus:ring-blue-500 focus:border-blue-500 border-gray-300
                @endif"></textarea>
                <x-input-error :messages="$errors->get('form.body')" class="mt-2" />
            </div>

            <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-blue-800">
                Comment
            </button>
        </form>

        {{-- Show Likes Here --}}

    </div>
</section>
