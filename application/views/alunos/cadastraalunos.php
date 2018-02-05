<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Novo Aluno</h2>
    <a href="<?php echo site_url("c_alunos/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_alunos/gravar")?>" method="post">
        <div class="row">
        <div class="form-group col-md-8">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" autofocus>
        </div>
        <div class="form-group col-md-4">
            <label for="nome">Matricula</label>
            <input type="text" class="form-control" name="matricula" id="nome" placeholder="Matricula">
        </div>
        </div>
        <div class="form-group">
            <label for="tel1">Telefone 1:</label>
            <input type="text" class="form-control" name="telefone1" id="tel1" placeholder="Telefone - 1">
        </div>
        <div class="form-group">
            <label for="tel2">Telefone 2:</label>
            <input type="text" class="form-control" name="telefone2" id="tel2" placeholder="Telefone - 2">
        </div>
        <div class="form-group">
            <label for="textConteudo">Data Nascimento:</label>
            <input type="text" class="form-control tpData" name="nascimento" id="nome" placeholder="Data Nascimeto">
        </div>        
        <a href="<?php echo site_url("c_curso/listar")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
﻿

