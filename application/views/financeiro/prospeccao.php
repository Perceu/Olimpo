<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			Grafico de movimentações de <?php echo $ano; ?>
		</div>
		<div class="panel-body">
			<div>
				<canvas id="mv_canvas" height="600" width="800"></canvas>
			</div>
		</div>
	</div>
</div>
<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			Prospecção para o ano de <?php echo $ano; ?>
		</div>
		<div class="panel-body">
			<div>
				<canvas id="pr_canvas" height="600" width="800"></canvas>
			</div>
		</div>
	</div>
</div>
<script>
	var barChartData = {
		labels : [
			<?php 
				if (count($entradas_pr) > count($saidas_pr)){
					foreach ($entradas_pr as $value) {
						echo "'".$value->carVencimento."',";
					}	
				}else{
					foreach ($saidas_pr as $value) {
						echo "'".$value->ecVencimento."',";
					}	
				}
			?>
		],
		datasets : [
			{
				backgroundColor: [
					'rgba(99, 255, 99, 0.5)',
					'rgba(99, 255, 99, 0.5)',
					'rgba(99, 255, 99, 0.5)',
					'rgba(99, 255, 99, 0.5)',
					'rgba(99, 255, 99, 0.5)',
					'rgba(99, 255, 99, 0.5)',
					'rgba(99, 255, 99, 0.5)',
					'rgba(99, 255, 99, 0.5)',
					'rgba(99, 255, 99, 0.5)',
					'rgba(99, 255, 99, 0.5)',
					'rgba(99, 255, 99, 0.5)',
					'rgba(99, 255, 99, 0.5)',
				],
				label: "Entradas",
				data : [
						<?php 
							if (count($entradas_pr) >= count($saidas_pr)){
								foreach ($entradas_pr as $value) {
									echo "'".$value->carValor."',";
								}
							}else{
								foreach ($saidas_pr as $car) {
									$encontrou = False;
									foreach ($entradas_pr as $value) {
										if ($value->carVencimento == $car->ecVencimento){
											echo "'".$value->carValor."',";
											$encontrou = true;
										}
									}
									if (!$encontrou){
										echo "'0',";
									}
								}
							}
						?>
				]
			},
			{
				backgroundColor: [
					'rgba(255, 99, 99, 0.5)',
					'rgba(255, 99, 99, 0.5)',
					'rgba(255, 99, 99, 0.5)',
					'rgba(255, 99, 99, 0.5)',
					'rgba(255, 99, 99, 0.5)',
					'rgba(255, 99, 99, 0.5)',
					'rgba(255, 99, 99, 0.5)',
					'rgba(255, 99, 99, 0.5)',
					'rgba(255, 99, 99, 0.5)',
					'rgba(255, 99, 99, 0.5)',
					'rgba(255, 99, 99, 0.5)',
					'rgba(255, 99, 99, 0.5)',
				],
				label: "saidas",
				data : [
						<?php 
							if (count($entradas_pr) > count($saidas_pr)){
								foreach ($entradas_pr as $ec) {
									$encontrou = False;
									foreach ($saidas_pr as $value) {
										if ($value->ecVencimento == $ec->carVencimento){
											echo "'".$value->ecValor."',";
											$encontrou = true;
										}
									}
									if (!$encontrou){
										echo "'0',";
									}
								}
							}else{
								foreach ($saidas_pr as $value) {
									echo "'".$value->ecValor."',";
								}
							}
						?>
				]
			}
		]

	}
	var ctx = document.getElementById("pr_canvas").getContext("2d");
	var myChar1 = new Chart(ctx, {
		type: 'bar',
		data: barChartData
	});
</script>
<script>
	var barChartData = {
		labels : [
			<?php 
				if (count($entradas_mv) > count($saidas_mv)){
					foreach ($entradas_mv as $value) {
						echo "'".$value->reData."',";
					}	
				}else{
					foreach ($saidas_mv as $value) {
						echo "'".$value->rsData."',";
					}	
				}
			?>
		],
		datasets : [
			{
				backgroundColor: ['rgba(99, 255, 99, 0.5)'],
				label: "Entradas",
				data : [
						<?php 
							if (count($entradas_mv) > count($saidas_mv)){
								foreach ($entradas_mv as $value) {
									echo "'".$value->reValor."',";
								}
							}else{
								foreach ($saidas_mv as $car) {
									$encontrou = False;
									foreach ($entradas_mv as $value) {
										if ($value->reData == $car->rsData){
											echo "'".$value->reValor."',";
											$encontrou = true;
										}
									}
									if (!$encontrou){
										echo "'0',";
									}
								}
							}
						?>

				]
			},
			{
				backgroundColor: ['rgba(255, 99, 99, 0.5)'],
				label: "saidas",
				data : [
						<?php 
							if (count($entradas_mv) > count($saidas_mv)){
								foreach ($entradas_mv as $ec) {
									$encontrou = False;
									foreach ($saidas_mv as $value) {
										if ($value->rsData == $ec->reData){
											echo "'".$value->rsValor."',";
											$encontrou = true;
										}
									}
									if (!$encontrou){
										echo "'0',";
									}
								}
							}else{
								foreach ($saidas_mv as $value) {
									echo "'".$value->rsValor."',";
								}
							}
						?>
				]
			}
		]

	}
	var ctx = document.getElementById("mv_canvas").getContext("2d");
	var myChar2 = new Chart(ctx, {
		type: 'bar',
		data: barChartData
	});
</script>	