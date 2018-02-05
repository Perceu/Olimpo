<?php 
  $total = 0;
  $table = "";
  $count_peoples = 0;
  $parcelas_em_aberto = array();
  foreach ($carnesVencidos as $carne) {
      if (array_key_exists ($carne->empNome, $parcelas_em_aberto )){
        $parcelas_em_aberto[$carne->empNome]['numero'] += 1;
        $parcelas_em_aberto[$carne->empNome]['valor'] += $carne->ecValor;
      }else{
        $parcelas_em_aberto[$carne->empNome]['numero'] = 1;
        $parcelas_em_aberto[$carne->empNome]['valor'] = $carne->ecValor;
        $count_peoples += 1;
      }
      $table .= "<tr>";
      $table .= "<td><span class='hide'>".date("Ymd",strtotime($carne->ecVencimento))."</span> ".date("d/m/Y",strtotime($carne->ecVencimento))."</td>";
      $table .= "<td>$carne->empNome</td>";
      $table .= "<td>$carne->ecDescricao</td>";
      $table .= "<td>$carne->empTelefone1 - $carne->empTelefone2</td>";
      $table .= "<td>R$ ".number_format($carne->ecValor,2,',','.')."</td>";
      $table .= "<td><a href=".site_url('c_carne/registrarPagamento/'.$carne->ecId)." class='button tiny'>Pagar</a></td>";
      $table .= "</tr>";

      $total += $carne->ecValor;
  }
?> 
<div class="row">
  <div class="col-lg-3 col-md-6">
    <div class="alert alert-danger" role="alert">
      <strong>Total Em devedor na rua</strong><br>
      R$ <?php echo number_format($total,2,',','.'); ?>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="alert alert-warning" role="alert">
      <strong>Numero de empresas que estou devendo</strong><br>
      <?php echo $count_peoples; ?>
    </div>
  </div>

  <?php
    $list = "";
    $badged = 0;
    foreach ($parcelas_em_aberto as $pessoa => $row) {
      if ($row['numero']>2){
        $badged += 1;
        $list .= '<li class="list-group-item">';
        $list .= '<span class="badge">'.$row['numero'].'</span>';
        $list .= '<span class="badge">R$ '.number_format($row['valor'],2,',','.').'</span>';
        $list .= $pessoa;
        $list .= '</li>';
      }
    }
  ?>
  <div class="col-lg-3 col-md-6">
    <div class="alert alert-info" role="alert">
      <strong>Mensalidades com Atrazos</strong><br>
      <ul>
        <li>+2 mensalidades <a href="#"><span data-toggle="modal" data-target="#myModal" class="badge"><?=$badged?></span></a></li>
      </ul>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Pessoas com mais atrazos</h4>
          </div>
          <div class="modal-body">
            <ul class="list-group">
              <?=$list?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="alert alert-warning" role="alert">
      <strong>Os dados aqui são com previsão para daqui a 7 dias</strong><br>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <h2 class="panel-title pull-left">Carnes ha vencer</h2>
      </div>
      <div class="panel-body ">
        <table class="table table-hover dataTables">
          <thead>
            <tr>
              <th>Vencimento</th>
              <th>Empresa</th>
              <th>Descrição</th>
              <th>Telefones</th>
              <th>Valor</th>
              <th>Pagar</th>
            </tr>
          </thead>
          <tbody>
          <?php echo $table; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
