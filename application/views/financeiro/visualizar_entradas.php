<div class="row">
    <div class="col-md-12">

<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Visualizar Entradas</h2>
    <a href="<?php echo site_url("c_financeiro/editarEntrada/".$entrada[0]->reId)?>" class="btn btn-default pull-right"> Editar</a>
  </div>
  <div class="panel-body">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="mensalidade">Data da entrada:</label><?php echo date('d/m/Y',strtotime($entrada[0]->reData)); ?>
            </div>
            <div class="form-group col-md-6">
                <label for="mensalidade">Turnos:</label>
                    <?php 
                        foreach ($turnos as $value) {
                            if ($entrada[0]->turId == $value->turId){
                                echo $value->turNome;
                            }
                        }
                    ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="mensalidade">Descrição da entrada:</label><?php echo $entrada[0]->reDescricao ?>
            </div>        
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="mensalidade">Conta:</label>
                    <?php 
                        foreach ($contas as $value) {
                            if ($entrada[0]->conId==$value->conId){
                                echo $value->conNome;
                            }
                        }
                    ?>
            </div>
            <div class="form-group col-md-6">
                <label for="mensalidade">Categorias:</label>
                <?php 
                    foreach ($categorias as $value) {
                        if ($entrada[0]->reCategoria == $value->rcId){
                            echo $value->rcNome;
                        }
                    }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="mensalidade">Valor Recebido: </label>R$ <?php echo $entrada[0]->reValor ?>
            </div>
        </div>
  </div>
</div>
</div>
</div>
            
