<!-- resources/views/chat/partials/rename-modal.blade.php -->
<div x-data="{ 
    isOpen: false, 
    chatId: null,
    newTitle: '',
    async saveTitle() {
        try {
            const response = await fetch(`/chat/${this.chatId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({ title: this.newTitle })
            });
            if (response.ok) {
                window.location.reload();
            }
        } catch (error) {
            console.error('Error updating title:', error);
        }
    }
}" 
    @rename-chat.window="
        isOpen = true; 
        chatId = $event.detail.chatId;
        newTitle = $event.detail.currentTitle;
    "
>
    <div x-show="isOpen" 
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
         x-transition>
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-96"
             @click.away="isOpen = false">
            <h3 class="text-lg font-medium mb-4 text-gray-900 dark:text-white">Rename Chat</h3>
            <input type="text" 
                   x-model="newTitle"
                   class="w-full border dark:border-gray-600 rounded-lg p-2 mb-4 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
            <div class="flex justify-end space-x-2">
                <button @click="isOpen = false" 
                        class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200">
                    Cancel
                </button>
                <button @click="saveTitle()" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>