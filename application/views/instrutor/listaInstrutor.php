<div class="row"> 
<div class="col-md-12"> 
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Instrutores</h2>
    <a href="<?php echo site_url("c_instrutor/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body ">
    
    <table class="table table-hover dataTables">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Editar</th>
          <th>Excluir</th>
        </tr>
      </thead>
      <tbody>
          <?php
          foreach ($instrutores as $instrutor) {
              echo '<tr>';
              echo "<td>$instrutor->insId</td>";
              echo "<td>$instrutor->insNome</td>";
              echo "<td><a href='".site_url('c_instrutor/editar/'.$instrutor->insId)."'class='button tiny'>Editar</a></td>";
              echo "<td><a href='".site_url('c_instrutor/excluir/'.$instrutor->insId)."'class='button tiny alert'>Excluir</a></td>";
              echo '</tr>';
          }
          ?>   
      </tbody>
    </table>
  </div>
</div>
</div>
</div>