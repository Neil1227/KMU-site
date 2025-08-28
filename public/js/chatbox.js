document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("userMessage");
    const sendBtn = document.getElementById("chat-send");
    const messages = document.getElementById("chatbox-messages");
    const chatToggle = document.getElementById("chatToggle");
    const chatbox = document.getElementById("chatbox");
    const chatClose = document.getElementById("chatClose");

    // Toggle chatbox open
    chatToggle?.addEventListener("click", () => {
        chatbox.style.display = "flex";
        chatToggle.style.display = "none";
        input.focus();
    });

    // Toggle chatbox close
    chatClose?.addEventListener("click", () => {
        chatbox.style.display = "none";
        chatToggle.style.display = "flex";
    });

    // Add message to chat
    function addMessage(sender, text) {
        const div = document.createElement("div");
        div.classList.add(sender);
        div.innerHTML = `<span class="timestamp">${new Date().toLocaleTimeString()}</span> ${text}`;
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }

    // Send message to backend
    async function sendMessage() {
        const text = input.value.trim();
        if (!text) return;

        addMessage("user", text);
        input.value = "";

        // Typing indicator
        const typingDiv = document.createElement("div");
        typingDiv.classList.add("bot");
        typingDiv.innerHTML = `
        <span class="timestamp">${new Date().toLocaleTimeString()}</span> 
        <span class="typing">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </span>`;

        messages.appendChild(typingDiv);

        try {
            const response = await fetch("/chat", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ message: text })
            });

            if (!response.ok) throw new Error("Network error");

            const data = await response.json();
            typingDiv.remove();
            addMessage("bot", data.reply);

        } catch (err) {
            typingDiv.remove();
            console.error("Error sending message:", err);
            addMessage("bot", "Error sending message: " + err.message);
        }
    }

    // Attach listeners
    sendBtn?.addEventListener("click", sendMessage);
    input?.addEventListener("keydown", (e) => {
        if (e.key === "Enter") sendMessage();
    });
});
