﻿<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Gerar Carnes</h2>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_carne_fornecedores/imprimir")?>" method="post">
            <div class="form-group">
                <label for="nome">Nome</label>
                <?php 
                    foreach ($fornecedores as $value) {
                        $o_aluno[$value->forid] = $value->forNome;
                    }
                    echo form_dropdown('for_id', $o_aluno,'','class="form-control js-select2"');
                ?>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input class="form-control" type="text" name="descricao" id="descricao" />
            </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="n_parcela">Nº de parcela</label>
                <input class="form-control" type="text" name="n_parcela" id="n_parcela" />
            </div>
            <div class="form-group col-md-6">
                <label for="vencimento">Primeiro Vencimento</label>
                <input class="form-control tpData" id="data" type="text" name="vencimento" />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="mensalidade">Valor até o vencimento</label>
                <div class="input-group">
                    <div class="input-group-addon">R$</div>
                    <input class="form-control" type="text" name="mensalidade" id="mensalidade" />
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-default">Gerar</button>
    </form>
  </div>
</div>
</div>
﻿
            
