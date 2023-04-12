const qrcode = require('qrcode-terminal');

console.log('Escaneie o código QR para se conectar ao WhatsApp Web:');
qrcode.generate('https://web.whatsapp.com', { small: true });

