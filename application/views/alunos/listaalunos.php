<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Alunos</h2>    
    <a href="<?php echo site_url("c_alunos/cadastrar")?>" class="btn btn-default pull-right"> + Novo</a>
    <a href="<?php echo site_url('c_aniversariantes/imprimir'); ?>" class='btn btn-default pull-right'><span class="glyphicon glyphicon-print"></span> Aniversariantes</a>
  </div>
  <div class="panel-body ">
    <table class="table table-hover dataTables">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Matricula</th>
          <th>Telefones</th>
          <th>Editar</th>
        </tr>
      </thead>
      <tbody>
          <?php 
            foreach ($alunos as $aluno) {
               echo "<tr>";
                    echo "<td>$aluno->aluNome</td>";
                    echo "<td>$aluno->aluMatricula</td>";
                    echo "<td>$aluno->aluTelefone1 - $aluno->aluTelefone2</td>";
                    echo "<td><a href=".site_url('c_alunos/editar/'.$aluno->aluid)." class='button tiny'>Editar</a></td>";
               echo "</tr>" ;
            }
          ?>  
      </tbody>
    </table>
  </div>
</div>
</div>
</div>