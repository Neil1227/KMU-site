<!-- Floating Button -->
<div id="chatToggle"><i class="bi bi-chat-left"></i></div>

<!-- Chatbox -->
<div id="chatbox">
    <div id="chatbox-header">
        AI Chatbot Assistant
        <button id="chatClose" style="background:none; border:none; color:white; font-size:16px; cursor:pointer;">
            <i class="bi bi-box-arrow-in-down-left"></i>
        </button>
    </div>
    <div id="chatbox-messages"></div>
    <div id="chatbox-input">
        <input type="text" id="userMessage" placeholder="Type a message..." />
        <button id="chat-send">Send</button>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/chatbox.js') }}"></script>

@endpush
