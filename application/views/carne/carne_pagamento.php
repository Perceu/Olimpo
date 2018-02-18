<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Registro de Pagamentos</h2>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("/c_carne/efetuarPagamento/".$parcela[0]->carId)?>" method="post">
        <div class="row">
            <fieldset class="col-md-12">
                <legend><?php echo $parcela[0]->aluNome ?></legend>
                <label>Parcela:</label><?php echo $parcela[0]->carParcela; ?>
                <label>Curso:</label><?php echo $parcela[0]->curNome; ?>
            </fieldset>

            <div class="form-group col-md-6">
                <label for="mensalidade">Descrição da entrada:</label>
                <input class="form-control" type="text" name="reDescricao" value="Pagamento de mensalidade" id="mensalidade" />
            </div>
            <div class="form-group col-md-6">
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
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="mensalidade">Data da entrada:</label>
                <input class="form-control tpData" type="text" value="<?php echo date('d/m/Y'); ?>" name="reData" id="mensalidade" />
            </div>
            <div class="form-group col-md-4">
                <label for="mensalidade">Categorias:</label>
                    <?php 
                        foreach ($categorias as $value) {
                            $o_aluno[$value->rcId] = $value->rcNome;
                        }
                        echo form_dropdown('reCategoria', $o_aluno,'','class="form-control js-select2"');
                        ?>
            </div>       
            <div class="form-group col-md-4">
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
        </div>     
        <div class="row">
            <div class="form-group col-md-12    ">
                <label for="mensalidade">Valor Recebido:</label>
                <div class="input-group">
                    <div class="input-group-addon">R$</div>
                    <input class="form-control" type="text" name="reValor" value="<?php echo str_replace('.',',',$parcela[0]->carValor) ?>" id="mensalidade" />
                </div>
            </div>
        </div>   
        <button type="submit" class="btn btn-default">Pagar</button>
    </form>
  </div>
</div>
</div>
﻿
            
