<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Empresas</h2>
    <a href="<?php echo site_url("c_empresa/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
  </div>
  <div class="panel-body ">
    <table class="table table-hover dataTables">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Telefones</th>
          <th>Editar</th>
        </tr>
      </thead>
      <tbody>
          <?php 
            foreach ($empresas as $empresa) {
               echo "<tr>";
                    echo "<td>$empresa->empNome</td>";
                    echo "<td>$empresa->empTelefone1 - $empresa->empTelefone2</td>";
                    echo "<td><a href=".site_url('c_empresa/editar/'.$empresa->empid)." class='button tiny'>Editar</a></td>";
               echo "</tr>" ;
            }
          ?>  
      </tbody>
    </table>
  </div>
</div>
</div>