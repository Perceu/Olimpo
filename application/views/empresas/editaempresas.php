<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Editar Empresa</h2>
    <a href="<?php echo site_url("c_empresa/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
    <a href="<?php echo site_url("c_empresa/excluir/".$empresas[0]->empid)?>" class="btn btn-default pull-right">Excluir </a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_empresa/salvar/".$empresas[0]->empid)?>" method="post">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" value="<?php echo $empresas[0]->empNome ?>" id="nome" placeholder="Nome" autofocus>
        </div>
        <div class="form-group">
            <label for="tel1">Telefone 1:</label>
            <input type="text" class="form-control" name="telefone1" value="<?php echo $empresas[0]->empTelefone1 ?>" id="tel1" placeholder="Telefone - 1">
        </div>
        <div class="form-group">
            <label for="tel2">Telefone 2:</label>
            <input type="text" class="form-control" name="telefone2" value="<?php echo $empresas[0]->empTelefone2 ?>" id="tel2" placeholder="Telefone - 2">
        </div>
        <a href="<?php echo site_url("c_empresa/listar")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
﻿

