<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Turnos</h2>
    <a href="<?php echo site_url("c_turno/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body ">
    <table class="table table-hover dataTables">
      <thead>
        <tr>
          <th>Turno</th>
          <th>Hora Inicial</th>
          <th>Hora Final</th>
          <th>Editar</th>
        </tr>
      </thead>
      <tbody>
          <?php 
            foreach ($turnos as $turno) {
                echo "<tr>";
                echo "<td>$turno->turNome</td>";
                echo "<td>".date('H:i',strtotime($turno->turIni))."</td>";
                echo "<td>".date('H:i',strtotime($turno->turFim))."</td>";
                echo "<td><a href=".site_url('c_turno/editar/'.$turno->turId)." class='button tiny'>Editar</a></td>";
                echo "</tr>";
            }
          ?>  
      </tbody>
    </table>
  </div>
</div>
</div>
</div>