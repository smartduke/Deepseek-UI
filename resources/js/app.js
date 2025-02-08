import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Add a simple function to dispatch the rename chat event
window.renameChat = function(chatId) {
    const currentTitle = document.querySelector(`[data-chat-id="${chatId}"]`)?.textContent || 'New Chat';
    window.dispatchEvent(new CustomEvent('rename-chat', {
        detail: { chatId, currentTitle }
    }));
}