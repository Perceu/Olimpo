<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Carne Detalhamento</h2>
    <a href="<?php echo site_url('c_carne/cadastrarParcelas/'.$carnes[0]->carNum)?>" class="btn btn-default btn-sm pull-right">Nova Parcela</a>
    <a href="<?php echo site_url('c_carne/imprimir_carne/'.$carnes[0]->carNum)?>" class="btn btn-default btn-sm pull-right">Reimprimir Carne</a>
    <a href="<?php echo site_url('c_carne/excluir_carne/'.$carnes[0]->carNum)?>" class="btn btn-default btn-sm pull-right">Excluir Carne</a>
    <?php if ($carnes[0]->carInativo){ ?>
      <a href="<?php echo site_url('c_carne/ativar_carne/'.$carnes[0]->carNum)?>" class="btn btn-default btn-sm pull-right">Ativar Carne</a>
    <?php }else{ ?>
      <a href="<?php echo site_url('c_carne/inativar_carne/'.$carnes[0]->carNum)?>" class="btn btn-default btn-sm pull-right">Inativar Carne</a>
    <?php } ?>
    <a href="<?php echo site_url('c_carne/gerenciador')?>" class="btn btn-default btn-sm pull-right">Voltar</a>
  </div>
  <div class="panel-body ">
    <fieldset>
      <legend>Aluno</legend>
      <ul class="list-inline">
        <li><b>Nome:</b><?php echo $carnes[0]->aluNome; ?></li>
        <li><b>Curso:</b><?php echo $carnes[0]->curNome; ?></li>
        <li><b>Telefones:</b><?php echo $carnes[0]->aluTelefone1." - ".$carnes[0]->aluTelefone2; ?></li>
      </ul>
    </fieldset>
    <form method='post' action="<?php echo site_url('c_carne/excluir_parcelas'); ?>">
    <input type="hidden" name="carne" value="<?php echo $carnes[0]->carNum; ?>">
    <table class="table table-hover dataTables">
      <thead>
        <tr>
          <th><input type="checkbox"/></th>
          <th>Parcela</th>
          <th>Data</th>
          <th>valor</th>
          <th>Valor Vencido</th>
          <th>Entrada</th>
          <th>pago</th>
          <th>ações</th>
        </tr>
      </thead>
      <tbody>
          <?php 
            $hoje = date("Ymd",time());
            foreach ($carnes as $carne) {
              $vencimento = date("Ymd",strtotime($carne->carVencimento));
              $class = "";
              $class = (($hoje<$vencimento)?$class:"class='danger'");
              $class = (($carne->carPago==0)?$class:"class='success'");
                echo "<tr ".$class.">";
                if ($carne->carPago==0){
                  echo "<th> <input type='checkbox' value='$carne->carId' name='parcelas[]' /> </th>";
                }else{
                  echo "<td></td>";
                }
                echo "<td>$carne->carParcela</td>";
                echo "<td>".date("d/m/Y",strtotime($carne->carVencimento))."</td>";
                echo "<td>".number_format($carne->carValor,2,',','.')."</td>";
                echo "<td>".number_format($carne->carValorVencido,2,',','.')."</td>";
                echo "<td>".(($carne->carPago==0)?"Não":"Sim")."</td>";
                if ($carne->reId){
                  echo "<td><a href='http://localhost/Olimpo/index.php/c_financeiro/visualizarEntrada/".$carne->reId."'>Visualizar Entrada</a></td>";
                }else{
                  echo "<td>Sem entrada registrada</td>";
                }
                if ($carne->carPago==0){
                  echo "<td><a href=".site_url('c_carne/registrarPagamento/'.$carne->carId)." class='btn btn-default btn-xs glyphicon glyphicon-usd'></a>";
                  echo "<a href=".site_url('c_carne/editarParcelas/'.$carne->carId)." class='btn btn-default btn-xs tiny glyphicon glyphicon-pencil'></a></td>";
                }else{
                  echo "<td></td>";
                }
              echo "</tr>" ;
            }
          ?>  
      </tbody>
    </table>
    <button type="submit" class="btn btn-default btn-xs">Excluir selecionados</button>
  </form>
  </div>
</div>
</div>