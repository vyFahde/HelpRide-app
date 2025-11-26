# Análise e Correção do Loop de Redirecionamento no Login

## Problema Identificado

O problema de **loop de redirecionamento** após o login ocorria porque, embora o usuário estivesse fornecendo credenciais corretas, o sistema de autenticação do Laravel não estava conseguindo validar a senha corretamente, fazendo com que o *middleware* de autenticação (`auth:motorista` ou `auth:passageiro`) redirecionasse o usuário de volta para a tela de login, em um ciclo infinito.

## Causa Raiz

A causa principal do problema estava no arquivo `app/Http/Controllers/LoginController.php`, especificamente no método `logar`.

O código original estava utilizando o campo `'senha'` no array de credenciais passado para o método `Auth::attempt()`:

```php
// Linha 24 (Original)
if (Auth::guard('motorista')->attempt(['usuario' => $credentials['usuario'], 'senha' => $credentials['senha']])) {
    // ...
}

// Linha 29 (Original)
if (Auth::guard('passageiro')->attempt(['usuario' => $credentials['usuario'], 'senha' => $credentials['senha']])) {
    // ...
}
```

O Laravel, por padrão, espera que o campo da senha no banco de dados e no array de credenciais seja **`'password'`**. Ao usar `'senha'`, o método `attempt` falhava silenciosamente na verificação da senha, retornando `false` e, consequentemente, não autenticando o usuário.

## Solução Implementada

A correção consistiu em alterar o nome do campo da senha de `'senha'` para **`'password'`** no método `Auth::attempt()` para ambos os *guards* (`motorista` e `passageiro`).

### Alterações em `app/Http/Controllers/LoginController.php`

O código foi corrigido da seguinte forma:

```php
// Linha 24 (Corrigida)
if (Auth::guard('motorista')->attempt(['usuario' => $credentials['usuario'], 'password' => $credentials['senha']])) {
    $request->session()->regenerate();
    return redirect()->intended(route('carona.publicar'));
}

// Linha 29 (Corrigida)
if (Auth::guard('passageiro')->attempt(['usuario' => $credentials['usuario'], 'password' => $credentials['senha']])) {
    $request->session()->regenerate();
    return redirect()->intended(route('passageiro.painel'));
}
```

**Observação Adicional:**

Aproveitei para corrigir o redirecionamento após o login para as rotas corretas que estão protegidas pelos *guards* específicos, conforme definido em `routes/web.php`:
*   **Motorista:** Redireciona para `route('carona.publicar')` (Linha 58 de `routes/web.php`).
*   **Passageiro:** Redireciona para `route('passageiro.painel')` (Linha 49 de `routes/web.php`).

O código original estava redirecionando para `route('home')` em ambos os casos, o que, embora não fosse a causa do loop, não levava o usuário para a área correta após a autenticação.

Com esta correção, o sistema de autenticação do Laravel agora consegue validar as credenciais corretamente, autenticar o usuário e redirecioná-lo para a área protegida apropriada, resolvendo o loop de redirecionamento.
