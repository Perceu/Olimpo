<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Registro de Debito</h2>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("/c_carne_empresa/efetuarPagamento/".$parcela[0]->ecId)?>" method="post">
        <fieldset>
            <legend><?php echo $parcela[0]->empNome ?></legend>
            <label>Parcela:</label><?php echo $parcela[0]->ecParcela; ?>
            <label>Descricao:</label><?php echo $parcela[0]->ecDescricao; ?>
        </fieldset>

        <div class="form-group">
            <label for="mensalidade">Descrição da Saida:</label>
            <input class="form-control" type="text" name="rsDescricao" value="Debito - <?php echo $parcela[0]->ecDescricao; ?>" id="mensalidade" />
        </div>        
        <div class="form-group">
            <label for="mensalidade">Data da Saida:</label>
            <input class="form-control tpData" type="text" value="<?php echo date('d/m/Y'); ?>" name="rsData" id="mensalidade" />
        </div>
        <div class="form-group">
            <label for="mensalidade">Categorias:</label>
                <?php 
                    foreach ($categorias as $value) {
                        $o_aluno[$value->rcId] = $value->rcNome;
                    }
                    echo form_dropdown('rsCategoria', $o_aluno,'','class="form-control js-select2"');
                ?>
        </div>        
        <div class="form-group">
            <label for="mensalidade">Turnos:</label>
                <?php 
                    $turId = '';
                    foreach ($turnos as $value) {
                        $o_turno[$value->turId] = $value->turNome;
                        $horaIni = date('Hi',strtotime($value->turIni));
                        $horaFim = date('Hi',strtotime($value->turFim));
                        $hora = date('Hi');
                        if(($hora>$horaIni) and ($hora<$horaFim)){
                           $turId = $value->turId;
                        }
                    }
                    echo form_dropdown('turId', $o_turno, $turId,'class="form-control js-select2"');
                ?>
        </div>
        <div class="form-group">
            <label for="mensalidade">Conta:</label>
                <?php 
                    if ($this->session->userdata['Perfil']==0) {
                        foreach ($contas as $value) {
                            $o_con[$value->conId] = $value->conNome;
                        }
                        echo form_dropdown('conId', $o_con,$this->session->userdata['Conta'],'class="form-control js-select2"');
                    }else{
                        foreach ($contas as $value) {
                            $o_con[$value->conId] = $value->conNome;
                        }
                        echo form_dropdown('conId', $o_con,$this->session->userdata['Conta'],'disabled="" class="disabled form-control"');
                    }
                ?>
        </div> 
        <div class="form-group">
            <label for="mensalidade">Valor Debitado:</label>
            <div class="input-group">
                <div class="input-group-addon">R$</div>
                <input class="form-control" type="text" name="rsValor" value="<?php echo str_replace('.',',',$parcela[0]->ecValor) ?>" id="mensalidade" />
            </div>
        </div>
        <button type="submit" class="btn btn-default">Debitar</button>
    </form>
  </div>
</div>
</div>
﻿
            
