<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Editar Curso</h2>
    <a href="<?php echo site_url("c_curso/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
    <a href="<?php echo site_url("c_curso/excluir/".$curso[0]->curId)?>" class="btn btn-default pull-right"> Excluir</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("/c_curso/salvar/".$curso[0]->curId)?>" method="post">
        <div class="row">
        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" value="<?php echo $curso[0]->curNome ?>" id="nome" placeholder="Nome" autofocus>
        </div>
        <div class="form-group col-md-6 ">
            <label for="nome">Carga Horária</label>
            <input type="text" class="form-control" name="cargaHoraria" value="<?php echo $curso[0]->curCargHora ?>" id="nome" placeholder="Carga Horária" autofocus>
        </div>
        </div>
        <div class="form-group">
            <label for="textCurso">Cursos:</label>
            <textarea id="textCurso" class="form-control" rows="10" name="curso">
                <?php echo $curso[0]->curCursos ?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="textConteudo">Conteudo:</label>
            <textarea id="textConteudo" class="form-control" rows="10" name="conteudo">
                <?php echo $curso[0]->curConteudo ?>
            </textarea>
        </div>
        <a href="<?php echo site_url("c_curso/listar")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>

