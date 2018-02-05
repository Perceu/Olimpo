<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Novo Turno</h2>
    <a href="<?php echo site_url("c_turno/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_turno/gravar")?>" method="post">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="turNome" autofocus>
        </div>
        <div class="form-group">
            <label for="tel1">Hora Inicial</label>
            <input type="text" class="tpTime form-control" name="turIni">
        </div>
        <div class="form-group">
            <label for="tel2">Hora Final</label>
            <input type="text" class="tpTime form-control" name="turFim">
        </div>
        <a href="<?php echo site_url("c_turno/listar")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
﻿

