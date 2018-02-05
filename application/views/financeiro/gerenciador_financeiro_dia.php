<?php 
	$table_saidas = "";
	$totalSaidas = 0;
	foreach ($saidasPorCategoria as $key => $value) {
		$table_saidas .= '<div class="col-md-12">';
		$table_saidas .= '<div class="panel panel-default">';
		$table_saidas .= '<div class="panel-heading" role="tab" id="headingOne">';
		$table_saidas .= '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$value->rcid.'" aria-controls="collapse'.$value->rcid.'">';
		$table_saidas .= '<label class="panel-title">';
		$table_saidas .= $value->rcNome;
		$table_saidas .= '</label>';
		$table_saidas .= '<label class="pull-right">R$ '.number_format($value->valor,2,',','.')."<label>";
		$table_saidas .= '</a>';
		$table_saidas .= '</div>';
		$table_saidas .= '<div id="collapse'.$value->rcid.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">';
		$table_saidas .= '<div class="panel-body" style="padding:0">';
		$table_saidas .= "<table class='table table-striped table-condensed'>";
		foreach ($saidas as $key2 => $row) {
			if($row->rcid == $value->rcid){
				$table_saidas .= "<tr>";
				$table_saidas .= "<td>";
				$table_saidas .= $row->conNome;
				$table_saidas .= "</td>";
				$table_saidas .= "<td>";
				$table_saidas .= $row->turNome;
				$table_saidas .= "</td>";
				$table_saidas .= "<td>R$ ";
				$table_saidas .= number_format($row->valor,2,',','.');
				$table_saidas .= "</td>";
				$table_saidas .= "</tr>";
				$totalSaidas += $row->valor;
			}
		}
		$table_saidas .= "</table>";
		$table_saidas .= '</div>';
		$table_saidas .= '</div>';
		$table_saidas .= '</div>';
		$table_saidas .= '</div>';
	}
	$table_entradas = "";
	$totalEntradas = 0;
	$totalEntradasOutros = 0;
	foreach ($entradasPorCategoria as $key => $categoria) {
		$table_entradas .= '<div class="col-md-12">';
		$table_entradas .= '<div class="panel panel-default">';
		$table_entradas .= '<div class="panel-heading" role="tab" id="headingOne">';
		$table_entradas .= '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$categoria->rcid.'" aria-controls="collapse'.$categoria->rcid.'">';
		$table_entradas .= '<label class="panel-title">';
		$table_entradas .= $categoria->rcNome;
		$table_entradas .= '</label>';
		$table_entradas .= '<label class="pull-right">R$ '.number_format($categoria->valor,2,',','.')."<label>";
		$table_entradas .= '</a>';
		$table_entradas .= '</div>';
		$table_entradas .= '<div id="collapse'.$categoria->rcid.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">';
		$table_entradas .= '<div class="panel-body" style="padding:0">';
		$table_entradas .= "<table class='table table-striped table-condensed'>";
		foreach ($entradas as $key2 => $row) {
			if($row->rcid == $categoria->rcid){
				$table_entradas .= "<tr>";
				$table_entradas .= "<td>";
				$table_entradas .= $row->conNome;
				$table_entradas .= "</td>";
				$table_entradas .= "<td>";
				$table_entradas .= $row->turNome;
				$table_entradas .= "</td>";
				$table_entradas .= "<td>R$ ";
				$table_entradas .= number_format($row->valor,2,',','.');
				$table_entradas .= "</td>";
				$table_entradas .= "</tr>";
				if (!$categoria->rcDescontaCaixa){
					$totalEntradas += $row->valor;
				}else{
					$totalEntradasOutros += $row->valor;
				}
			}
		}
		$table_entradas .= "</table>";
		$table_entradas .= '</div>';
		$table_entradas .= '</div>';
		$table_entradas .= '</div>';
		$table_entradas .= '</div>';
	}
	$table_entradas .= '<hr></hr>';
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
</script>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
		  		<div class="form-inline">
			    	<div class="form-group input-group-sm">
					    <?php 
					      $day = $this->uri->segment(3);
					      $month = $this->uri->segment(4);
					      $year = $this->uri->segment(5);
					      if(!empty($month)){
					        $date = $day."/".$month."/".$year;
					      }else{
					        $date = date('d/m/Y');
					      }
					    ?>
			      		<input type="filtrar" value="<?php echo empty($date)?"":$date ?>" class="form-control tpData" id="filtro" placeholder="Data">
		    		</div>
			    	<button type="submit" onclick="filtroDate()" class="btn btn-default btn-sm">Filtrar</button>
		  		</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
  <div class="col-lg-2 col-md-6">
    <div class="alert alert-info" role="alert">
      <strong>Total Entradas</strong><br>
      R$ <?=number_format($totalEntradasOutros + $totalEntradas,2,',','.')?>
    </div>
  </div>
  <div class="col-lg-2 col-md-6">
    <div class="alert alert-info" role="alert">
      <strong>Entradas em conta</strong><br>
      R$ <?=number_format($totalEntradasOutros,2,',','.')?>
    </div>
  </div>
  <div class="col-lg-2 col-md-6">
    <div class="alert alert-success" role="alert">
      <strong>Entradas em dinheiro</strong><br>
      R$ <?=number_format($totalEntradas,2,',','.')?>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="alert alert-warning" role="alert">
      <strong>Total de Saidas(em dinheiro)</strong><br>
      <?=number_format($totalSaidas,2,',','.')?>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
	<?php
	$diferenca = $totalEntradas-$totalSaidas;
	$class="success";
	if ($diferenca<0) {
		$class="danger";
	}
	?>	
    <div class="alert alert-<?=$class?>" role="alert">
      <strong>Diferença(em dinheiro)</strong><br>
      R$ <?=number_format($diferenca,2,',','.')?>
    </div>
  </div>
</div>
<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading">Entradas - <?php echo $date ?></div>
		<div class="panel-body">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<?=$table_entradas?>
			</div>
		</div>
	</div>
</div>
<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading">Saidas- <?php echo $date ?></div>
		<div class="panel-body">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<?=$table_saidas?>
			</div>
		</div>
	</div>
</div>
<div class="row">
</div>