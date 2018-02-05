<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Carne Detalhamento</h2>
    <a href="<?php echo site_url('c_carne_empresa/cadastrarParcelas/'.$carnes[0]->ecNum)?>" class="btn btn-default btn-sm pull-right">Nova Parcela</a>
    <a href="<?php echo site_url('c_carne_empresa/excluir_carne/'.$carnes[0]->ecNum)?>" class="btn btn-default btn-sm pull-right">Excluir Carne</a>
    <a href="<?php echo site_url('c_carne_empresa/gerenciador')?>" class="btn btn-default btn-sm pull-right">Voltar</a>
  </div>
  <div class="panel-body ">
    <fieldset>
      <legend>Aluno</legend>
      <ul class="list-inline">
        <li><b>Empresa:</b><?php echo $carnes[0]->empNome; ?></li>
        <li><b>Descricao:</b><?php echo $carnes[0]->ecDescricao; ?></li>
        <li><b>Telefones:</b><?php echo $carnes[0]->empTelefone1." - ".$carnes[0]->empTelefone2; ?></li>
      </ul>
    </fieldset>
    <form method='post' action="<?php echo site_url('c_carne_empresa/excluir_parcelas'); ?>">
    <input type="hidden" name="carne" value="<?php echo $carnes[0]->ecNum; ?>">
    <table class="table table-hover dataTables">
      <thead>
        <tr>
          <th><input type="checkbox"/></th>
          <th>Parcela</th>
          <th>Data</th>
          <th>valor</th>
          <th>Valor Vencido</th>
          <th>pago</th>
          <th>ações</th>
        </tr>
      </thead>
      <tbody>
          <?php 
            $hoje = date("Ymd",time());
            foreach ($carnes as $carne) {
              $vencimento = date("Ymd",strtotime($carne->ecVencimento));
              $class = "";
              $class = (($hoje<$vencimento)?$class:"class='danger'");
              $class = (($carne->ecPago==0)?$class:"class='success'");
                echo "<tr ".$class.">";
                if ($carne->ecPago==0){
                  echo "<th> <input type='checkbox' value='$carne->ecId' name='parcelas[]' /> </th>";
                }else{
                  echo "<td></td>";
                }
                echo "<td>$carne->ecParcela</td>";
                echo "<td>".date("d/m/Y",strtotime($carne->ecVencimento))."</td>";
                echo "<td>".number_format($carne->ecValor,2,',','.')."</td>";
                echo "<td>".number_format($carne->ecValorVencido,2,',','.')."</td>";
                echo "<td>".(($carne->ecPago==0)?"Não":"Sim")."</td>";
                if ($carne->ecPago==0){
                  echo "<td><a href=".site_url('c_carne_empresa/registrarPagamento/'.$carne->ecId)." class='btn btn-default btn-xs glyphicon glyphicon-usd'></a>";
                  echo "<a href=".site_url('c_carne_empresa/editarParcelas/'.$carne->ecId)." class='btn btn-default btn-xs tiny glyphicon glyphicon-pencil'></a></td>";
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