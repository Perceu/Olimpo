<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h2 class="panel-title pull-left">Gerar Diplomas</h2>
  </div>
  <div class="panel-body">
    <form action="<?php echo site_url("/c_diploma/imprimir")?>" method="post">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" autofocus>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="curso">Curso</label>
                    <select type="text" name="curso" class="form-control js-select2" id="curso" >
                        <?php 
                            foreach ($cursos as $curso) {
                                echo "<option value='$curso->curId'>$curso->curNome</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="instrutor">Instrutor</label>
                    <select type="text" class="form-control js-select2" name="instrutor" id="instrutor" >
                        <?php 
                            foreach ($instrutores as $instrutor) {
                                echo "<option value='$instrutor->insId'>$instrutor->insNome</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="assinar">
                    <input type="checkbox" name="assinar" id='assinar' value="assinar"> 
                        Assinatura do sistema
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="inicio">Periodo Inicio</label>
                    <input id="inicio" type="text" name="inicio" class="form-control tpData"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="fim">Periodo Final</label>
                    <input id="fim" type="text" name="fim" class="form-control tpData"/>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-default">Gerar</button>
                </div>
            </div>
    </form>
  </div>
</div>
</div>
</div>