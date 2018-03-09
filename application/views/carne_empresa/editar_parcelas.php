<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Editando Parcelas</h2>
    <a href="<?php echo site_url("c_carne_empresa/cadastrarParcelas")?>" class="btn btn-default pull-right"> + Novo</a>
    <a href="<?php echo site_url("c_carne_empresa/excluir/".$parcela[0]->ecId)?>" class="btn btn-default pull-right">Excluir</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_carne_empresa/salvar/".$parcela[0]->ecId)?>" method="post">
        <div class="row">
        <div class="form-group col-md-12">
            <label for="nome">Vencimento</label>
            <input type="text" class="form-control tpData" name="ecVencimento" value="<?php echo date('d/m/Y',strtotime($parcela[0]->ecVencimento)) ?>" id="nome" placeholder="Nome" autofocus>
        </div> 
        <div class="form-group col-md-12">
            <label for="nome">Numero Parcela</label>
            <input type="text" class="form-control" name="ecParcela" value="<?php echo $parcela[0]->ecParcela ?>" id="nome" placeholder="Nome" autofocus>
        </div>          
        <div class="form-group col-md-12">
            <label for="nome">Valor</label>
            <input type="text" class="form-control" name="ecValor" value="<?php echo $parcela[0]->ecValor ?>" id="nome" placeholder="Nome" autofocus>
        </div>        
        <div class="form-group col-md-12">
            <label for="nome">Valor Vencido</label>
            <input type="text" class="form-control" name="ecValorVencido" value="<?php echo $parcela[0]->ecValorVencido ?>" id="nome" placeholder="Nome" autofocus>
        </div>
        </div>
        <a href="<?php echo site_url("c_carne_empresa/gerenciador")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
﻿
