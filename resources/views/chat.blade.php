<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AI Chatbox</title>
    <style>
        #chatbox { border: 1px solid #ccc; padding: 10px; height: 400px; overflow-y: scroll; max-width:500px; margin:auto; }
        .user { color: blue; margin: 5px 0; }
        .bot { color: green; margin: 5px 0; }
        #messages { height: 300px; overflow-y: auto; margin-bottom: 10px; }
        input { width: 75%; }
    </style>
</head>
<body>

<div id="chatbox">
    <div id="messages"></div>
    <input type="text" id="userInput" placeholder="Type a message...">
    <button id="sendBtn">Send</button>
</div>

<!-- displays the user’s message. -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const input = document.getElementById("userInput");
    const sendBtn = document.getElementById("sendBtn");
    const messagesDiv = document.getElementById("messages");

    sendBtn.addEventListener("click", sendMessage);
    input.addEventListener("keydown", (e) => {
        if (e.key === "Enter") sendMessage();
    });

    async function sendMessage() {
        const message = input.value.trim();
        if (!message) return;

        // Show user message
        messagesDiv.innerHTML += `<div class="user"><b>You:</b> ${message}</div>`;
        input.value = "";
        messagesDiv.scrollTop = messagesDiv.scrollHeight;

        try {
            const response = await fetch("/chat", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ message })
            });

            if (!response.ok) throw new Error("Network error");

            const data = await response.json();
            messagesDiv.innerHTML += `<div class="bot"><b>Bot:</b> ${data.reply}</div>`;
            messagesDiv.scrollTop = messagesDiv.scrollHeight;

        } catch (err) {
            console.error("Error sending message:", err);
            messagesDiv.innerHTML += `<div class="bot"><b>Bot:</b> Error sending message</div>`;
        }
    }
});
</script>

</body>
</html>
