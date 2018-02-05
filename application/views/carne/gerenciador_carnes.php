<?php 
    $carnes_inativos = 0;
    $table = "";
    $valor_inativos = 0;
    $matriculas_ativas = 0;
    $valor_em_matriculas_ativas = 0;
    foreach ($carnes as $carne) {
      if ($carne->carInativo){
        $table .= "<tr class='warning'>";
        $inativo = "Inativo - ";
        $carnes_inativos += 1;
        $valor_inativos += $carne->aindaReceber;
      }else{
        $table .= "<tr>";
        $inativo = "";
        if (!empty($carne->aindaReceber)){
          $matriculas_ativas += 1;
          $valor_em_matriculas_ativas += $carne->aindaReceber;
        }
      }
      $table .= "<td>$inativo $carne->aluNome</td>";
      $table .= "<td>$carne->aluMatricula</td>";
      $table .= "<td>$carne->curNome</td>";
      $table .= "<td>".(!empty($carne->aindaReceber)?("R$ ".number_format($carne->aindaReceber,2,',','.')):('Quitado'))."</td>";
      $table .= "<td>$carne->pagos/$carne->parcelas</td>";
      $table .= "<td><a href=".site_url('c_carne/detalhes/'.$carne->carNum)." class='button tiny'>Detalhes</a></td>";
      $table .= "</tr>" ;
    }
  ?> 
<div class="row">
  <div class="col-lg-3 col-md-6">
    <div class="alert alert-info" role="alert">
      <strong>Carnes Ativos</strong><br>
      <?=$matriculas_ativas?>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="alert alert-success" role="alert">
      <strong>Valor em matriculas ativas</strong><br>
      R$ <?php echo number_format($valor_em_matriculas_ativas,2,',','.'); ?>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="alert alert-warning" role="alert">
      <strong>Numero de Carnes Inativos</strong><br>
      <?php echo $carnes_inativos; ?>
    </div>
  </div>
  <div class="col-lg-3 col-md-6">
    <div class="alert alert-danger" role="alert">
      <strong>Valor em carnes inativos</strong><br>
      R$ <?php echo number_format($valor_inativos,2,',','.'); ?>
    </div>
  </div>
</div>
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Carnes</h2>
    <a href="<?php echo site_url("c_carne/form_carnes")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body ">
    <table class="table table-hover dataTables">
      <thead>
        <tr>
          <th>Aluno</th>
          <th>Matricula</th>
          <th>Curso</th>
          <th>Total Ainda a receber</th>
          <th>Parcelas</th>
          <th>Detalhes</th>
        </tr>
      </thead>
      <tbody>
           <?=$table?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>