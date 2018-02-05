<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Criando Parcelas</h2>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_carne_empresa/gravar/".$carnes[0]->ecNum)?>" method="post">
        <input type="hidden" name="empId" value="<?php echo $carnes[0]->empId ?>">
        <div class="row">
        <div class="form-group col-md-3">
            <label for="Vencimento">Vencimento</label>
            <input type="text" class="form-control tpData" name="ecVencimento" value="" id="Vencimento" placeholder="Vencimento" autofocus>
        </div>           
        <div class="form-group col-md-3">
            <label for="numParcela">Numero de parcelas</label>
            <input type="text" class="form-control" name="ecParcela" value="" id="numParcela" >
        </div>                  
        <div class="form-group col-md-3">
            <label for="valor">Valor</label>
            <input type="text" class="form-control" name="ecValor" value="" id="valor" >
        </div>        
        <div class="form-group col-md-3">
            <label for="valorVencido">Valor Vencido</label>
            <input type="text" class="form-control" name="ecValorVencido" value="" id="valorVencido" >
        </div>
        </div>
        <a href="<?php echo site_url("c_carne_empresa/gerenciador")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
﻿