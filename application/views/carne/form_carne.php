<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Gerar Carnes</h2>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("/c_carne/imprimir")?>" method="post">
        <div class="row">
            <div class="form-group col-md-12">
                <label for="nome">Nome</label>
                <?php 
                    foreach ($alunos as $value) {
                        $o_aluno[$value->aluid] = $value->aluNome;
                    }
                    echo form_dropdown('alu_id', $o_aluno,'','class="form-control js-select2"');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="curso">Curso</label>
                <?php 
                    foreach ($cursos as $value) {
                        $o_curso[$value->curId] = $value->curNome;
                    }
                    echo form_dropdown('cur_id', $o_curso,'','class="form-control js-select2"');
                ?>
            </div>
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
            <div class="form-group col-md-6">
                <label for="mensalidade">Valor até o vencimento</label>
                <div class="input-group">
                    <div class="input-group-addon">R$</div>
                    <input class="form-control" type="text" name="mensalidade" id="mensalidade" />
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="mensalidade_vencida">Valor após o vencimento</label>
                <div class="input-group">
                    <div class="input-group-addon">R$</div>
                    <input class="form-control" type="text" name="mensalidade_vencida" id="mensalidade_vencida" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-default pull-right">Gerar</button>
            </div>
        </div>
    </form>
  </div>
</div>
</div>
</div>
            
