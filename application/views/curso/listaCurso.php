<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Cursos</h2>
    <a href="<?php echo site_url("c_curso/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body ">
    <table class="table table-hover dataTables">
      <thead>
        <tr>
          <th>ID</th>
          <th>Curso</th>
          <th>Carga Horaria</th>
          <th>Editar</th>
        </tr>
      </thead>
      <tbody>
          <?php 
            foreach ($cursos as $curso) {
               echo "<tr>";
                    echo "<td>$curso->curId</td>";
                    echo "<td>$curso->curNome</td>";
                    echo "<td>$curso->curCargHora h</td>";
                    echo "<td><a href=".site_url('c_curso/editar/'.$curso->curId)." class='button tiny'>Editar</a></td>";
               echo "</tr>" ;
            }
          ?>  
      </tbody>
    </table>
  </div>
</div>
</div>
</div>