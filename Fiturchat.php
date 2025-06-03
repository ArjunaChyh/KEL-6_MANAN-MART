<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Live Chat</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .container {
      display: flex;
      height: 100vh;
    }

    .sidebar {
      background: #f8f0f2;
      width: 250px;
      padding: 20px;
      border-right: 1px solid #ccc;
    }

    .home-icon img {
      width: 35px;
      height: auto;
    }

    .sidebar h2 {
      margin-top: 0;
    }

    .contact-list {
      list-style: none;
      padding: 0;
    }

    .contact-list li {
      background: #ccc;
      padding: 10px;
      margin: 10px 0;
      border-radius: 10px;
      cursor: pointer;
      display: flex;
      align-items: center;
    }

    .contact-list li::before {
      content: "👤";
      margin-right: 10px;
    }

    .chat-area {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    header {
      background: #f4f4f4;
      padding: 10px;
      display: flex;
      align-items: center;
    }

    header .back-btn {
      background: none;
      border: none;
      font-size: 24px;
      margin-right: 10px;
      cursor: pointer;
    }

    .chat-box {
      flex: 1;
      background: #dbdbdb;
      padding: 20px;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }

    .message {
      max-width: 60%;
      padding: 10px;
      border-radius: 10px;
      margin: 5px 0;
    }

    .user {
      background: #00bfff;
      color: white;
      align-self: flex-start;
    }

    .agent {
      background: white;
      color: black;
      align-self: flex-end;
    }

    .no-message {
      color: #555;
      font-style: italic;
      align-self: center;
      margin-top: 30px;
    }

    .input-area {
      display: flex;
      padding: 10px;
      background: #fceef2;
      border-top: 1px solid #ccc;
    }

    .input-area input {
      flex: 1;
      padding: 10px;
      border: none;
      border-radius: 5px;
    }

    .input-area button {
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      margin-left: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    <aside class="sidebar">
      <a href="keranjang.php">
      <div class="home-icon" a href="keranjang.php">
        <img src="images/home.png" alt="Sembako Ilustrasi">
      </div>
      </a>
      <h2>Chat</h2>
      <ul class="contact-list">
        <li onclick="openChat('Kontak 1')">Kontak 1</li>
        <li onclick="openChat('Kontak 2')">Kontak 2</li>
        <li onclick="openChat('Kontak 3')">Kontak 3</li>
        <li onclick="openChat('Kontak 4')">Kontak 4</li>
        <li onclick="openChat('Kontak 5')">Kontak 5</li>
        <li onclick="openChat('Kontak 6')">Kontak 6</li>
      </ul>
    </aside>

    <main class="chat-area">
      <header>
        <button class="back-btn">&larr;</button>
        <h3 id="contact-name">Kontak 1</h3>
      </header>
      <div class="chat-box" id="chat-box">
        <div class="no-message" id="no-message">Tidak ada pesan</div>
      </div>
      <div class="input-area">
        <input type="text" id="message-input" placeholder="Ketik pesan di sini" />
        <button onclick="sendMessage()">&#9658;</button>
      </div>
    </main>
  </div>

  <script>
    function sendMessage() {
      const input = document.getElementById('message-input');
      const chatBox = document.getElementById('chat-box');
      const noMessage = document.getElementById('no-message');
      const text = input.value.trim();

      if (text !== '') {
        if (noMessage) {
          noMessage.style.display = 'none';
        }

        const msg = document.createElement('div');
        msg.className = 'message user';
        msg.textContent = text;
        chatBox.appendChild(msg);
        input.value = '';
        chatBox.scrollTop = chatBox.scrollHeight;
      }
    }

    function openChat(contactName) {
      document.getElementById('contact-name').textContent = contactName;
      const chatBox = document.getElementById('chat-box');
      chatBox.innerHTML = '<div class="no-message" id="no-message">Tidak ada pesan</div>';
    }
  </script>
</body>

</html>