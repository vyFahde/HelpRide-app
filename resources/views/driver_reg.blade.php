<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faça seu Cadastro na HelpRide</title>
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head> 
<body>
  <div class="cadastro-container">
      <h2>Cadastro de Motorista</h2>


<div class="section">
  <h2>Dados Pessoais</h2>
    <form>
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" id="nome" name="nome" minlength="3" maxlength="100" required>

      <label for="cpf">CPF</label>
      <input type="text" id="cpf" name="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-00" required>

      <label for="nascimento">Data de Nascimento</label>
      <input type="date" id="nascimento" name="nascimento" required>

      <label for="celular">Celular</label>
      <input type="tel" id="celular" name="celular" pattern="\(\d{2}\)\s\d{5}-\d{4}" placeholder="(99) 99999-9999" required>

      <label for="email">E-mail</label>
      <input type="email" id="email" name="email" required>

      <label for="usuario">Usuário</label>
      <input type="text" id="usuario" name="usuario" minlength="3" maxlength="20" required>

      <label for="senha">Senha</label>
      <input type="password" id="senha" name="senha" minlength="7" required>

      <label for="foto">Foto (opcional)</label>
      <input type="file" id="foto" name="foto" accept="image/*">
    </div> <!--Form Group-->
  </div> <!--Section-->

  <div class="section">
    <h2>Dados da CNH</h2>

    <div class="form-group">
      <label for="cnh">Nº CNH</label>
      <input type="text" id="cnh" name="cnh" pattern="\d{11}" maxlength="11" placeholder="Somente números" required>


      <label for="validade">Data de Validade</label>
      <input type="date" id="validade" name="validade" required>
    </div> <!--Form Group-->
  </div> <!--Section-->

  <div class="section">
    <h2>Dados do Veículo</h2>

    <div class="form-group">
      <label for="modelo">Modelo</label>
      <input type="text" id="modelo" name="modelo" required>

      <label for="placa">Placa</label>
      <input type="text" id="placa" name="placa" 
              pattern="([A-Z]{3}[0-9][A-Z0-9][0-9]{2})|([A-Z]{3}[0-9]{4})" 
              placeholder="XXX0X00 ou XXX0000" required>

      <label for="ano">Ano</label>
      <input type="date" id="ano" name="ano" required>

      <label for="cor">Cor</label>
      <input type="text" id="cor" name="cor" required>
    </div> <!--Form Group-->
  </div> <!--Section-->
    <div class="btn-global">
        <button type="submit">Cadastrar</button>
            
        <div class="btn-voltar">
            <a href="index.html"></a>
            <button type="button" onclick="window.history.back()">Voltar</button>
            </a>
        </div> <!--btn voltar-->
    </div> <!--form-group-->
</form>
    
</body>
</html>