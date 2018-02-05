<?php
$entradas_list = "";
$totalEntradas = 0;
$totalEntradasDetail = array();
foreach ($entradasPorCategoria as $key => $value) {
	$entradas_list .= '<div class="col-md-12">';
	$entradas_list .= '<div class="panel panel-default">';
	$entradas_list .= '<div class="panel-heading" role="tab" id="headingOne">';
	$entradas_list .= '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$value->rcid.'" aria-controls="collapse'.$value->rcid.'">';
	$entradas_list .= '<label class="panel-title">';
	$entradas_list .= $value->rcNome;
	$entradas_list .= '</label>';
	$entradas_list .= '<label class="pull-right">R$ '.number_format($value->valor,2,',','.')."<label>";
	$entradas_list .= '</a>';
	$entradas_list .= '</div>';
	$entradas_list .= '<div id="collapse'.$value->rcid.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">';
	$entradas_list .= '<div class="panel-body" style="padding:0">';
	$entradas_list .= "<table class='table table-striped table-condensed'>";
	foreach ($entradas as $key2 => $row) {
		if($row->rcid == $value->rcid){
			$entradas_list .= "<tr>";
			$entradas_list .= "<td>";
			$entradas_list .= $row->conNome;
			$entradas_list .= "</td>";
			$entradas_list .= "<td>";
			$entradas_list .= $row->turNome;
			$entradas_list .= "</td>";
			$entradas_list .= "<td class='text-right'>R$ ";
			$entradas_list .= number_format($row->valor,2,',','.');
			$entradas_list .= "</td>";
			$entradas_list .= "</tr>";
			$totalEntradas += $row->valor;
			if (array_key_exists ( $row->conNome , $totalEntradasDetail )){
				$totalEntradasDetail[$row->conNome] += $row->valor;
			}else{
				$totalEntradasDetail[$row->conNome] = $row->valor;
			}
		}
	}
	$entradas_list .= "</table>";
	$entradas_list .= '</div>';
	$entradas_list .= '</div>';
	$entradas_list .= '</div>';
	$entradas_list .= '</div>';
}

$saidas_list = "";
$totalSaidas = 0;
$totalSaidasDetail = array();
foreach ($saidasPorCategoria as $key => $value) {
	$saidas_list .= '<div class="col-md-12">';
	$saidas_list .= '<div class="panel panel-default">';
	$saidas_list .= '<div class="panel-heading" role="tab" id="headingOne">';
	$saidas_list .= '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$value->rcid.'" aria-controls="collapse'.$value->rcid.'">';
	$saidas_list .= '<label class="panel-title">';
	$saidas_list .= $value->rcNome;
	$saidas_list .= '</label>';
	$saidas_list .= '<label class="pull-right">R$ '.number_format($value->valor,2,',','.')."<label>";
	$saidas_list .= '</a>';
	$saidas_list .= '</div>';
	$saidas_list .= '<div id="collapse'.$value->rcid.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">';
	$saidas_list .= '<div class="panel-body" style="padding:0">';
	$saidas_list .= "<table class='table table-striped table-condensed'>";
	foreach ($saidas as $key2 => $row) {
		if($row->rcid == $value->rcid){
			$saidas_list .= "<tr>";
			$saidas_list .= "<td>";
			$saidas_list .= $row->conNome;
			$saidas_list .= "</td>";
			$saidas_list .= "<td>";
			$saidas_list .= $row->turNome;
			$saidas_list .= "</td>";
			$saidas_list .= "<td class='text-right'>R$ ";
			$saidas_list .= number_format($row->valor,2,',','.');
			$saidas_list .= "</td>";
			$saidas_list .= "</tr>";
			$totalSaidas += $row->valor;
			if (array_key_exists ( $row->conNome , $totalEntradasDetail )){
				if (isset($totalSaidasDetail[$row->conNome])){
					$totalSaidasDetail[$row->conNome] += $row->valor;								
				}else{
					$totalSaidasDetail[$row->conNome] = $row->valor;
				}
			}else{
				$totalSaidasDetail[$row->conNome] = $row->valor;
			}
		}
	}
	$saidas_list .= "</table>";
	$saidas_list .= '</div>';
	$saidas_list .= '</div>';
	$saidas_list .= '</div>';
	$saidas_list .= '</div>';
}
?>
<style type="text/css">
  .label{
    margin-left: 3px;
  }
</style>
<script type="text/javascript">
  function filtroDate(){
    var url = '<?php echo site_url("c_financeiro/".$this->uri->segment(2)); ?>';
    var date = document.getElementById('filtro').value;
    window.location.href = url+'/'+date;
  }  
  function printRel(c,e){
  	e.preventDefault();
    var url = c.href;
    var date = document.getElementById('filtro').value;
    console.log(url+'/'+date);
    window.location.href = url+'/'+date;

  }
</script>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<div class="form-inline">
					<div class="form-group input-group-sm">
					<?php 
					$month = $this->uri->segment(3);
					$year = $this->uri->segment(4);
					if(!empty($month)){
						$date = $month."/".$year;
					}else{
						$date = date('m/Y');
					}
					?>
					<input type="filtrar" value="<?php echo empty($date)?"":$date ?>" class="form-control tpDataMes" id="filtro" placeholder="Data">
				</div>
				<button type="submit" onclick="filtroDate()" class="btn btn-default btn-sm">Filtrar</button>
				<a onclick="printRel(this, event)" href='<?php echo site_url('c_financeiro/imprimir_relatorio_geral') ?>' class="btn btn-default btn-sm">Relatório do mês</a>
			</div>
		</div>
	</div>
	</div>
<div class="row">
  <div class="col-lg-2 col-md-6">
    <div class="alert alert-success" role="alert">
      <strong>Total de Entradas</strong><br>
      R$ <?php echo number_format($totalEntradas,2,',','.'); ?>
    </div>
  </div>
  <div class="col-lg-2 col-md-6">
    <div class="alert alert-danger" role="alert">
      <strong>Total de Saidas</strong><br>
      <?php echo number_format($totalSaidas,2,',','.'); ?>
    </div>
  </div>
  <div class="col-lg-2 col-md-6">
    <div class="alert alert-info" role="alert">
      <strong>Diferença</strong><br>
	  <?php 
		$diferenca = $totalEntradas-$totalSaidas;
		echo number_format($diferenca,2,',','.'); 
	  ?>
    </div>
  </div>
  <div class="col-lg-6 col-md-6">
  	<?php
		foreach ($totalEntradasDetail as $con => $value) {
			echo '<div class="col-md-6">';
			echo '<div class="alert alert-success" role="alert">';
			echo '<strong>+'.$con.'</strong><br>';
			echo number_format($value,2,',','.');
			echo'</div></div>';
		}

		foreach ($totalSaidasDetail as $con => $value) {
			echo '<div class="col-md-6">';
			echo '<div class="alert alert-danger" role="alert">';
			echo '<strong>-'.$con.'</strong><br>';
			echo number_format($value,2,',','.');
			echo'</div></div>';
		}
	?>
  </div>
</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Entradas - <?php echo $date ?></div>
			<div class="panel-body">
				<div class="panel-group clearfix" id="accordion" role="tablist" aria-multiselectable="true">
					<?=$entradas_list?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Saidas- <?php echo $date ?></div>
			<div class="panel-body">
				<div class="panel-group clearfix" id="accordion" role="tablist" aria-multiselectable="true">
					<?=$saidas_list?>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		
	</div>
	</div>