<div x-data="{
    replying: false,
    showReply: false
}"
x-on:replied.window="replying = false"
class="my-6">
    <div>
        <div class="flex items-center space-x-2">
            <img src="" alt="" class="bg-black rounded-full size-8">
            <div class="font-semibold">{{ $comment->user->name }}</div>
            <div class="text-sm">{{ $comment->created_at->diffForHumans() }}</div>
        </div>

        <div class="mt-4">{{ $comment->body }}</div>

        <div class="mt-6 text-sm flex items-center space-x-3">
            <button class="text-gray-500" @click="replying=!replying; showReply=true">Reply</button>
        </div>

        <template x-if="showReply">
            <div x-show="replying" x-transition>
                <form wire:submit="postReply" class="mt-4">
                    <div>
                        <x-textarea placeholder="Post a comment" class="w-full" rows="4" wire:model="replyForm.body" />
                        <x-input-error :messages="$errors->get('replyForm.body.body')" />
                    </div>

                    <div class="flex items-baseline space-x-2">
                        <x-primary-button class="mt-2">
                            Reply
                        </x-primary-button>
                        <x-secondary-button @click="replying = false" class="text-sm text-gray-500">Cancel</x-secondary-button>
                    </div>
                </form>
            </div>
        </template>

        @if ($comment->replies->isNotEmpty())
            <div class="ml-8 mt-8">
                @foreach($comment->replies as $reply)
                    <livewire:comment-item :comment="$reply" :key="$reply->id" />
                @endforeach
            </div>
        @endif
    </div>
</div>
