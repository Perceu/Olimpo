<?php 
  $total = 0;
  $table = "";
  $count_peoples = 0;
  $parcelas_em_aberto = array();
  foreach ($carnesVencidos as $carne) {
      if (array_key_exists ($carne->aluNome, $parcelas_em_aberto )){
        $parcelas_em_aberto[$carne->aluNome]['numero'] += 1;
        $parcelas_em_aberto[$carne->aluNome]['valor'] += $carne->carValor;
      }else{
        $parcelas_em_aberto[$carne->aluNome]['numero'] = 1;
        $parcelas_em_aberto[$carne->aluNome]['valor'] = $carne->carValor;
        $count_peoples += 1;
      }
      $table .= "<tr>";
      $table .= "<td><span class='hide'>".date("Ymd",strtotime($carne->carVencimento))."</span> ".date("d/m/Y",strtotime($carne->carVencimento))."</td>";
      $table .= "<td>$carne->aluNome</td>";
      $table .= "<td>$carne->curNome</td>";
      $table .= "<td>$carne->aluTelefone1 - $carne->aluTelefone2</td>";
      $table .= "<td>R$ ".number_format($carne->carValor,2,',','.')."</td>";
      $table .= "<td><a href=".site_url('c_carne/registrarPagamento/'.$carne->carId)." class='button tiny'>Pagar</a></td>";
      $table .= "</tr>";

      $total += $carne->carValor;
  }
?> 
<div class="row">
  <div class="col-lg-3 col-md-6">
    <div class="alert alert-danger" role="alert">
      <strong>Total Em especie na rua</strong><br>
      R$ <?php echo number_format($total,2,',','.'); ?>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="alert alert-warning" role="alert">
      <strong>Numero de pessoas com atrazos</strong><br>
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
  <div class="col-lg-6 col-md-6">
    <div class="alert alert-info" role="alert">
      <strong>Pessoas com Atrazos</strong><br>
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
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <h2 class="panel-title pull-left">Carnes Vencidos</h2>
      </div>
      <div class="panel-body ">
        <table class="table table-hover dataTables">
          <thead>
            <tr>
              <th>data</th>
              <th>aluno</th>
              <th>Curso</th>
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
