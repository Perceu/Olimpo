<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Editar Instrutor</h2>
    <a href="<?php echo site_url("c_instrutor/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("/c_instrutor/salvar/".$instrutor[0]->insId)?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $instrutor[0]->insNome ?>" placeholder="Nome" autofocus>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Assinatura</label>
            <input type="file" name="assinatura" id="assinatura">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>
</div>
</div>
﻿