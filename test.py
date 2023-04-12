from WABot import WABot

# cria uma instância do WABot
bot = WABot()

# inicia a conexão com o WhatsApp
bot.connect()

# envia a mensagem "Hello, World!" para o número de telefone +55 11 98765-4321
bot.send_message("+5511987654321", "Hello, World!")

# finaliza a conexão com o WhatsApp
bot.disconnect()


