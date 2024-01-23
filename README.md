# PHP WordPress Password Reset and SMS Notification

Este script PHP foi desenvolvido para ser usado em conjunto com WordPress, e tem o propósito de permitir a redefinição de senhas de usuários e enviar uma notificação por SMS utilizando a API do Twilio.

## Funcionalidades

O script realiza as seguintes tarefas:

1. **Obtenção de Parâmetros da URL:**
   - Extrai parâmetros da URL, especialmente o CPF do usuário.

2. **Validação de Usuário Existente:**
   - Verifica se o usuário com o CPF fornecido está registrado no WordPress.

3. **Redefinição de Senha:**
   - Caso o usuário exista, a senha é redefinida para a nova senha fornecida na URL.

4. **Envio de SMS:**
   - Utiliza a API do Twilio para enviar uma mensagem SMS contendo a nova senha para o número de telefone associado ao usuário.

5. **Redirecionamento ou Mensagem de Erro:**
   - Redireciona o usuário para a página apropriada ou exibe uma mensagem de erro, dependendo do resultado da operação.

## Configuração

Antes de usar este script, você precisa configurar algumas variáveis:

- `$accountSID`: Substitua com o SID da sua conta Twilio.
- `$authKey`: Substitua com a chave de autenticação da sua conta Twilio.
- `$sendNumber`: Substitua com o número Twilio do qual as mensagens SMS serão enviadas.

Lembre-se de garantir que a biblioteca Twilio esteja instalada no seu ambiente PHP para usar a função `wpcodetips_send_sms`. Consulte a documentação do [Twilio PHP](https://www.twilio.com/docs/libraries/php) para mais informações.

## Uso

Você pode integrar este script em suas páginas WordPress ou usá-lo como um arquivo autônomo. Certifique-se de que o WordPress esteja carregado antes de chamar este script.

**Exemplo de URL para Redefinir Senha:**
```
https://seusite.com/resetar-senha/?cpf=12345678901&phone=5551234567&password=NovaSenha123
```

## Atenção

Este script deve ser usado com cuidado e em conformidade com as políticas de segurança. Certifique-se de que a URL de redefinição de senha não seja acessível publicamente e que a comunicação com a API do Twilio seja segura.

---

**Observação:** Substitua as variáveis específicas, como `$accountSID`, `$authKey`, e ajuste o URL do redirecionamento conforme necessário para corresponder à sua configuração específica.
