<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Novo Curso</h2>
    <a href="<?php echo site_url("c_curso/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("/c_curso/gravar")?>" method="post">
        <div class="row">
        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" autofocus>
        </div>
        <div class="form-group col-md-6">
            <label for="nome">Carga Horária</label>
            <input type="text" class="form-control" name="cargaHoraria" id="nome" placeholder="Carga Horária" autofocus>
        </div>
        </div>
        <div class="form-group">
            <label for="textCurso">Cursos:</label>
            <textarea id="textCurso" class="form-control" rows="10" name="curso"></textarea>
        </div>
        <div class="form-group">
            <label for="textConteudo">Conteudo:</label>
            <textarea id="textConteudo" class="form-control" rows="10" name="conteudo"></textarea>
        </div>
        <a href="<?php echo site_url("c_curso/listar")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
﻿

