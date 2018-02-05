<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Editar Aluno</h2>
    <a href="<?php echo site_url("c_alunos/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
    <a href="<?php echo site_url("c_alunos/excluir/".$alunos[0]->aluid)?>" class="btn btn-default pull-right">Excluir </a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_alunos/salvar/".$alunos[0]->aluid)?>" method="post">
        <div class="row">
        <div class="form-group col-md-8">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" value="<?php echo $alunos[0]->aluNome ?>" id="nome" placeholder="Nome" autofocus>
        </div>
        <div class="form-group col-md-4">
            <label for="nome">Matricula</label>
            <input type="text" class="form-control" name="matricula" value="<?php echo $alunos[0]->aluMatricula ?>" id="nome" placeholder="Matricula">
        </div>
        </div>
        <div class="form-group">
            <label for="tel1">Telefone 1:</label>
            <input type="text" class="form-control" name="telefone1" value="<?php echo $alunos[0]->aluTelefone1 ?>" id="tel1" placeholder="Telefone - 1">
        </div>
        <div class="form-group">
            <label for="tel2">Telefone 2:</label>
            <input type="text" class="form-control" name="telefone2" value="<?php echo $alunos[0]->aluTelefone2 ?>" id="tel2" placeholder="Telefone - 2">
        </div>
        <div class="form-group">
            <label for="textConteudo">Data Nascimento:</label>
            <input type="text" class="form-control tpData" name="nascimento" value="<?php echo date('d/m/Y',strtotime($alunos[0]->aluNascimento))  ?>" id="nome" placeholder="Data Nascimeto">
        </div>
        <a href="<?php echo site_url("c_alunos/listar")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
﻿

