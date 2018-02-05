<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Editar turno</h2>
    <a href="<?php echo site_url("c_turno/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
    <a href="<?php echo site_url("c_turno/excluir/".$turnos[0]->turId)?>" class="btn btn-default pull-right">Excluir </a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_turno/salvar/".$turnos[0]->turId)?>" method="post">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="turNome" value="<?php echo $turnos[0]->turNome ?>" autofocus>
        </div>
        <div class="form-group">
            <label for="tel1">Hora Inicial:</label>
            <input type="text" class="form-control tpTime" name="turIni" value="<?php echo date('H:i',strtotime($turnos[0]->turIni)) ?>">
        </div>
        <div class="form-group">
            <label for="tel2">Hora Final:</label>
            <input type="text" class="form-control tpTime" name="turFim" value="<?php echo date('H:i',strtotime($turnos[0]->turFim)) ?>" >
        </div>
        <a href="<?php echo site_url("c_turno/listar")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
﻿

