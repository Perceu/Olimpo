<?php 
  $total_mes = 0;
  $table_mes = "";
  foreach ($movimentosMes as $alunos) {
      $table_mes .= "<tr>";
      $table_mes .= "<td>".date("d/m/Y",strtotime($alunos->rsData))."</td>";
      $table_mes .= "<td>".$alunos->turNome."</td>";
      $table_mes .= "<td>$alunos->rsDescricao</td>";
      $table_mes .= "<td>$alunos->rcNome</td>";
      $table_mes .= "<td>R$ ".number_format($alunos->rsValor,2,',','.')."</td>";
      $table_mes .= "<td><a href=".site_url('c_financeiro/editarSaida/'.$alunos->rsId)." class='button tiny'>Editar</a></td>";
      $total_mes += $alunos->rsValor;
  }

  $total_dia = 0;
  $table_dia = "";
  foreach ($movimentosDia as $row) {
      $table_dia .= "<tr>";
      $table_dia .= "<td>".date("d/m/Y",strtotime($row->rsData))."</td>";
      $table_dia .= "<td>".$row->turNome."</td>";
      $table_dia .= "<td>$row->rsDescricao</td>";
      $table_dia .= "<td>$row->rcNome</td>";
      $table_dia .= "<td>R$ ".number_format($row->rsValor,2,',','.')."</td>";
      $table_dia .= "<td><a href=".site_url('c_financeiro/editarSaida/'.$row->rsId)." class='button tiny'>Editar</a></td>";
      $table_dia .= "</tr>" ;
      $total_dia +=$row->rsValor;
  }
?>  

<style type="text/css">
  .label{
    margin-left: 3px;
  }
</style>
<script type="text/javascript">
  function filtroDate(e){
    e.preventDefault();
    var url = '<?php echo site_url("c_financeiro/ralatorioMovimentosSaida"); ?>';
    var date = document.getElementById('filtro').value;
    window.location.href = url+'/'+date;
  }
</script>

<div class="col-md-12 ">
  <div class="panel panel-default">
    <div class="panel-heading clearfix">
      <div class="form-inline">
        <form method="post" class="form-group input-group-sm">
        <?php 
          $day = $this->uri->segment(3);
          $month = $this->uri->segment(4);
          $year = $this->uri->segment(5);
          if(!empty($day)){
            $date = $day."/".$month."/".$year;
          }else{
            $date = "";
          }
        ?>
          <input name="dia" type="filtrar" value="<?php echo empty($date)?"":$date ?>" class="form-control tpData" id="filtro" placeholder="Data">
          <button onclick="filtroDate(event)" class="btn btn-default btn-sm">Filtrar</button>
          <button type="submit" class="btn btn-default btn-sm" formaction="<?php echo site_url("c_financeiro/imprimir_relatorio_dia_saidas"); ?>">Relatório do Dia</button>
          <button type="submit" class="btn btn-default btn-sm" formaction="<?php echo site_url("c_financeiro/imprimir_relatorio_mes_saidas"); ?>">Relatório do Mês</button>
        </form>
      </div>
    </div>
  </div>
<br>
  <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#dia" aria-controls="d" role="dia" data-toggle="tab">Dia</a></li>
    <li role="presentation"><a href="#mes" aria-controls="mes" role="tab" data-toggle="tab">Mês</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="dia">
      <div class="row">
        <div class="col-lg-8 col-md-6">
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="alert alert-info" role="alert">
            <strong>Total Saidas</strong><br>
            R$ <?=number_format($total_dia,2,',','.')?>
          </div>
        </div>
      </div>
      <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h2 class="panel-title pull-left">Saidas do dia - <?php echo $conta[0]->conNome ?></h2>
        </div>
        <div class="panel-body ">
          <table class="table table-hover dataTables">
            <thead>
              <tr>
                <th>Data</th>
                <th>Turno</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Valor</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody>
                <?=$table_dia?>
            </tbody>
          </table>
        </div>
      </div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="mes">
      <div class="row">
        <div class="col-lg-8 col-md-6">
          <canvas id="gastosPorCategoria"></canvas>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="alert alert-info" role="alert">
            <strong>Total Saidas</strong><br>
            R$ <?=number_format($total_mes,2,',','.')?>
          </div>
        </div>
      </div>
      ﻿<div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <h2 class="panel-title pull-left">Saidas do mês - <?php echo $conta[0]->conNome; ?></h2>
        </div>
        <div class="panel-body ">
        <div class="row">
          <?php  
            echo '<div class="hide" id="json-pie">'.json_encode($movimentosPorCategoria).'</span>';
          ?>
          </div>
          <table class="table table-hover dataTables">
            <thead>
              <tr>
                <th>Data</th>
                <th>Turno</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Valor</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody>
              <?=$table_mes?>
            </tbody>
          </table>
        </div>
      </div>
      </div>
  </div>
</div>
</div>
<script>

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

var ctx = document.getElementById('gastosPorCategoria').getContext('2d');
console.log($('#json-pie').html());
var infos = JSON.parse($('#json-pie').html());
var data = {labels: Array(), datasets: [{data:Array(), backgroundColor:Array()}]}
infos.forEach(function(element){
  data.labels.push(element.rcNome);
  data.datasets[0].data.push(element.valor);
  data.datasets[0].backgroundColor.push(getRandomColor());
})
console.log(data);
var myPieChart = new Chart(ctx,{
    type: 'pie',
    data: data
});
</script>