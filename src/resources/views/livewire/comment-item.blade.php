<div x-data="{
    replying: false,
    showReply: false,
    editing: false,
    showEdit: false,
    deleted: false
}"
x-on:replied.window="replying = false"
x-on:edited.window="editing = false"
x-show="!deleted" x-transition:leave.duration.900ms
class="my-6">
    <div>
        <div class="flex items-center space-x-2">
            <img src="" alt="" class="bg-black rounded-full size-8">
            <div class="font-semibold">{{ $comment->user->name }}</div>
            <div class="text-sm">{{ $comment->created_at->diffForHumans() }}</div>
        </div>

        @can('update', $comment)
            <template x-if="showEdit">
                <div x-show="editing" x-transition>
                    <form wire:submit="updateComment" class="mt-4">
                        <div>
                            <x-textarea class="w-full" rows="4" wire:model="updateForm.body" />
                            <x-input-error :messages="$errors->get('updateForm.body')" />
                        </div>
                        <div class="flex items-baseline space-x-2">
                            <x-primary-button class="mt-2">
                                Update
                            </x-primary-button>
                            <x-secondary-button @click="editing=false" class="text-sm text-gray-500">Cancel</x-secondary-button>
                        </div>
                    </form>
                </div>
            </template>
        @endcan

        <div x-show="!editing" class="mt-4">{{ $comment->body }}</div>

        <div x-show="!editing" class="mt-6 text-sm flex items-center space-x-3">
            @can('reply', $comment)
                <button class="text-gray-500" @click="replying=!replying; showReply=true">Reply</button>
            @endcan

            @can('update', $comment)
                <button class="text-gray-500" @click="editing=true; showEdit=true">Edit</button>
            @endcan

            @can('delete', $comment)
                <button class="text-gray-500" wire:confirm="정말로 삭제하시겠습니까?" wire:click="deleteComment" @click="deleted=true">Delete</button>
            @endcan
        </div>

        <template x-if="showReply">
            <div x-show="replying" x-transition>
                <form wire:submit="postReply" class="mt-4">
                    <div>
                        <x-textarea placeholder="Reply to {{ $comment->user->name }}" class="w-full" rows="4" wire:model="replyForm.body" />
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

        @if (is_null($comment->parent_id) && $comment->replies->isNotEmpty())
            <div class="ml-8 mt-8">
                @foreach($comment->replies as $reply)
                    <livewire:comment-item :comment="$reply" :key="$reply->id" />
                @endforeach
            </div>
        @endif
    </div>
</div>
