<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Nova Categoria</h2>
    <a href="<?php echo site_url("c_categorias/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("c_categorias/gravar")?>" method="post">
        <div class="row">
        <div class="form-group col-md-12">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="rcNome" id="nome" placeholder="Nome" autofocus>
        </div>
        </div>
        <div class="row">
        <div class="form-group col-md-6">
          <label for="nome">Tipo categoria</label> <br>
            <label class="radio-inline"><input type="radio" name="rcSaida" value="0">Entrada</label>
            <label class="radio-inline"><input type="radio" name="rcSaida" value="1">Saida</label> 
        </div>
        <div class="form-group col-md-6">
            <label for="nome">Considera no caixa</label> <br>
            <label class="radio-inline"><input type="radio" name="rcDescontaCaixa" value="0" checked >Sim</label>
            <label class="radio-inline"><input type="radio" name="rcDescontaCaixa" value="1">Não</label> 
        </div>
        </div>
        <div class="row">
        <div class="form-group col-md-4">
            <label for="nome">Forças Transferencia para conta:</label> <br>
            <?php
                $o_con[0] = 'Usar a selecionada no pagamento';
                foreach ($contas as $value) {
                    $o_con[$value->conId] = $value->conNome;
                }
                echo form_dropdown('conId', $o_con,'','class="form-control js-select2"');
                ?>
        </div>
        <div class="form-group col-md-4">
            <label for="TaxaPagamento">Taxa de pagamento</label>
            <input type="text" class="form-control" name="TaxaPagamento" id="TaxaPagamento" placeholder="0.00% - 100.00%">
        </div>
        <div class="form-group col-md-4">
            <label for="mensalidade">Categoria da taxa:</label>
            <?php 
                $o_cats[0] = 'Não cobra taxa';
                foreach ($list_categorias as $value) {
                    $o_cats[$value->rcId] = $value->rcNome;
                }
                echo form_dropdown('rcIdTaxa', $o_cats,'','class="form-control js-select2"');
                ?>
        </div>
        </div>
        <a href="<?php echo site_url("c_curso/listar")?>" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-default">Salvar</button>
    </form>
  </div>
</div>
</div>
</div>