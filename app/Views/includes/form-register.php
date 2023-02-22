<form action="?a=register_submit" method="POST" class="needs-validation" novalidate>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="firstName">Nome</label>
        <input type="text" class="form-control" id="nome" name="c_nome" placeholder="Ex: João Silva"  required>
        <div class="invalid-feedback">
          Nome requerido
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <label for="lastName">Telefone</label>
        <input type="text" class="form-control" id="telefone" name="c_telefone" placeholder="Ex: 21999992222"  required>
        <div class="invalid-feedback">
          Telefone requerido
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="c_email" placeholder="Ex: seu@email.com" >
      <div class="invalid-feedback">
        Insira um email válido
      </div>
    </div>

    <div class="col-md-3 mb-3">
        <label for="zip">CEP</label>
        <input type="text" class="form-control" id="cep" name="c_cep" placeholder="Ex: 20351900"  required>
        <div class="invalid-feedback">
          Insira um CEP válido
        </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="address">Endereço</label>
        <input type="text" class="form-control" id="logradouro" name="c_logradouro" placeholder="Ex: Rua das flores" required >
        <div class="invalid-feedback">
          Insira um Endereço válido
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <label for="address">Nº</label>
        <input type="text" class="form-control" id="numero" name="c_numero" placeholder="Ex: 1234" required>
        <div class="invalid-feedback">
          Insira um Nº válido
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label for="email">Bairro</label>
      <input type="text" class="form-control" id="bairro" name="c_bairro" placeholder="Ex: Jacarepagua">
      <div class="invalid-feedback">
        Insira seu Bairro
      </div>
    </div>

    <div class="mb-3">
      <label for="password">Senha</label>
      <input type="password" class="form-control" id="senha" name="c_senha" placeholder="Insira sua senha">
      <div class="invalid-feedback">
        Insira sua senha
      </div>
    </div>

    <div class="mb-3">
      <label for="password">Confirmar Senha</label>
      <input type="password" class="form-control" id="confirma_senha" name="c_confirma_senha" placeholder="Insira sua senha">
      <div class="invalid-feedback">
        Repita sua senha
      </div>
    </div>

    <hr class="mb-4">
    <button class="btn btn-dark btn-lg btn-block" type="submit">Cadastrar</button>
  </form>