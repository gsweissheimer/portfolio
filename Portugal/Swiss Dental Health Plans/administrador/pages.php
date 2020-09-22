<?php include_once 'includes/session.php'; ?>
<?php include_once 'includes/notifications.php'; ?>
<?php include_once '../includes/globalVars.php'; ?>
<?php $_SESSION['mainPage'] = 'banner.php'; ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> SDC | Editar Banner</title>
  <?php include_once 'includes/head.php'; ?>
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="assets/plugins/select2/select2.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <?php include_once 'includes/header.php'; ?>
  <?php include_once 'includes/menubar.php'; ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Página - Consulta tags

      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="pages.php">Páginas</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Homepage</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" style="display: none;">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Módulo</th>
                    <th>Tipo</th>
                    <th>Tag</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td><span class="label label-success">Header</span></td>
                    <td>Slides</td>
                    <td>slide-home</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><span class="label label-success">Header</span></td>
                    <td>Slides</td>
                    <td>slide-nav</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><span class="label label-warning">Formação Prática</span></td>
                    <td>Features</td>
                    <td>formacao-pratica</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><span class="label label-warning">Formação Prática</span></td>
                    <td>Features</td>
                    <td>formacao-pratica-itens</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><span class="label label-warning">Formação Prática</span></td>
                    <td>Features</td>
                    <td>formacao-pratica-btn</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><span class="label bg-aqua">Educação</span></td>
                    <td>Advanced Banner</td>
                    <td>educacao-home</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td><span class="label bg-red">Tabs Programas</span></td>
                    <td>Features</td>
                    <td>tab-academy-home</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td><span class="label bg-red">Tabs Programas</span></td>
                    <td>Features</td>
                    <td>tab-academy-home-itens</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td><span class="label bg-red">Tabs Programas</span></td>
                    <td>Features</td>
                    <td>tab-university-home</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td><span class="label bg-red">Tabs Programas</span></td>
                    <td>Features</td>
                    <td>tab-university-home-itens</td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td><span class="label bg-red">Tabs Programas</span></td>
                    <td>Features</td>
                    <td>tab-training-home</td>
                  </tr>
                  <tr>
                    <td>12</td>
                    <td><span class="label bg-red">Tabs Programas</span></td>
                    <td>Features</td>
                    <td>tab-training-home-itens</td>
                  </tr>
                  <tr>
                    <td>13</td>
                    <td><span class="label bg-red">Tabs Programas</span></td>
                    <td>Features</td>
                    <td>tab-home-btn</td>
                  </tr>
                  <tr>
                    <td>14</td>
                    <td><span class="label label-success">Clinicas</span></td>
                    <td>Advanced Banner</td>
                    <td>clinicas-home</td>
                  </tr>
                  <tr>
                    <td>15</td>
                    <td><span class="label label-success">Clinicas</span></td>
                    <td>Slides</td>
                    <td>clinicas-slide-home</td>
                  </tr>
                  <tr>
                    <td>16</td>
                    <td><span class="label label-warning">Blog</span></td>
                    <td>Features</td>
                    <td>blog-home</td>
                  </tr>
                  <tr>
                    <td>17</td>
                    <td><span class="label bg-aqua">Testemunhos</span></td>
                    <td>Slide</td>
                    <td>testemunhos-home</td>
                  </tr>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>




      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Sobre SDC</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" style="display: none;">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Módulo</th>
                    <th>Tipo</th>
                    <th>Tag</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td><span class="label label-success">Header</span></td>
                    <td>Features</td>
                    <td>sobre-header</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><span class="label label-warning">Sobre SDC</span></td>
                    <td>Advanced Banner</td>
                    <td>sobre-SDC</td>
                  </tr> 
                  <tr>
                    <td>3</td>
                    <td><span class="label bg-aqua">Como Trabalhamos</span></td>
                    <td>Features</td>
                    <td>como-trabalhamos</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><span class="label bg-red">O nosso Objetivo</span></td>
                    <td>Features</td>
                    <td>nosso-objetivo</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><span class="label label-success">Área Atuação</span></td>
                    <td>Features</td>
                    <td>area-atuacao</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><span class="label label-success">Área Atuação</span></td>
                    <td>Features</td>
                    <td>area-atuacao-itens</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td><span class="label label-warning">Eventos</span></td>
                    <td>Features</td>
                    <td>eventos-sobre</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td><span class="label label-warning">Eventos CTA'S</span></td>
                    <td>Traduções</td>
                    <td>CALENDARIO_EVE | SABER_MAIS</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td><span class="label bg-aqua">Programa Social</span></td>
                    <td>Features</td>
                    <td>programa-social</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td><span class="label bg-aqua">Programa Social</span></td>
                    <td>Slide</td>
                    <td>programa-social</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>



      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Clinica</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" style="display: none;">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Módulo</th>
                    <th>Tipo</th>
                    <th>Tag</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td><span class="label label-success">Header</span></td>
                    <td>Features</td>
                    <td>clinica-header</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><span class="label label-warning">Clinica</span></td>
                    <td>Advanced Banner</td>
                    <td>clinica-pratica</td>
                  </tr> 
                  <tr>
                    <td>3</td>
                    <td><span class="label bg-aqua">Tratamentos</span></td>
                    <td>Slide</td>
                    <td>tratamentos-itens-clinica</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><span class="label bg-aqua">Tratamentos</span></td>
                    <td>Features</td>
                    <td>tratamentos-clinica</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><span class="label bg-red">Equipa médica</span></td>
                    <td>Advanced Banner</td>
                    <td>equipa-medica</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><span class="label label-success">SDC comemoração</span></td>
                    <td>Features</td>
                    <td>SDC-comemoracao</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td><span class="label label-warning">Planta</span></td>
                    <td>Features</td>
                    <td>planta-desenho</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>




      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Implantologia</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" style="display: none;">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Módulo</th>
                    <th>Tipo</th>
                    <th>Tag</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td><span class="label label-success">Header</span></td>
                    <td>Features</td>
                    <td>implantologia-header</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><span class="label label-warning">Sobre</span></td>
                    <td>Advanced Banner</td>
                    <td>sobre-implantologia</td>
                  </tr> 
                  <tr>
                    <td>3</td>
                    <td><span class="label bg-aqua">Fases do Tratamento</span></td>
                    <td>Features</td>
                    <td>fases-tratamento</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><span class="label bg-aqua">Fases do Tratamento</span></td>
                    <td>Features</td>
                    <td>fases-tratamento-itens</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><span class="label bg-red">Tipos de Implante</span></td>
                    <td>Features</td>
                    <td>tipos-implante</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><span class="label bg-red">Tipos de Implante</span></td>
                    <td>Features</td>
                    <td>tipos-implante-itens</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td><span class="label label-warning">Marcar Consulta</span></td>
                    <td>Advanced Banner</td>
                    <td>marcar-consulta</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td><span class="label bg-aqua">Resultados Estéticos</span></td>
                    <td>Traduções</td>
                    <td>TITULO = RESULTADOS_ESTETICOS | SUBTITULO = IMPLANTES_DENTARIOS</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td><span class="label bg-aqua">Resultados Estéticos</span></td>
                    <td>Features</td>
                    <td>implantes-dentarios</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td><span class="label bg-red">Manutenção e Garantia</span></td>
                    <td>Traduções</td>
                    <td>TITULO = MANUTENCAO_GARANTIA</td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td><span class="label bg-red">Manutenção e Garantia</span></td>
                    <td>Advanced Banner</td>
                    <td>manutencao_garantia</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>


      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Endodontia</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" style="display: none;">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Módulo</th>
                    <th>Tipo</th>
                    <th>Tag</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td><span class="label label-success">Header</span></td>
                    <td>Features</td>
                    <td>endodontia-header</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><span class="label label-warning">Sobre</span></td>
                    <td>Advanced Banner</td>
                    <td>sobre-endodontia</td>
                  </tr> 
                  <tr>
                    <td>3</td>
                    <td><span class="label bg-aqua">Fases do Tratamento</span></td>
                    <td>Features</td>
                    <td>fases-tratamento-endodontia</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><span class="label bg-aqua">Fases do Tratamento</span></td>
                    <td>Features</td>
                    <td>fases-tratamento-endodontia-itens</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><span class="label bg-red">Causas Tratamento</span></td>
                    <td>Features</td>
                    <td>causas-tratamento</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><span class="label bg-red">Causas Tratamento</span></td>
                    <td>Features</td>
                    <td>causas-tratamento-itens</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td><span class="label label-warning">Marcar Consulta</span></td>
                    <td>Advanced Banner</td>
                    <td>marcar-consulta</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td><span class="label bg-aqua">Sintomas Infeção</span></td>
                    <td>Traduções</td>
                    <td>TITULO = SINTOMAS_INFLAMACAO | SUBTITULO = SINTOMAS_INFECAO</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td><span class="label bg-aqua">Sintomas Infeção</span></td>
                    <td>Features</td>
                    <td>infecao_dentaria</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td><span class="label bg-red">Consequências</span></td>
                    <td>Traduções</td>
                    <td>TITULO = CONSEQUENCIAS_TRATAMENTO</td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td><span class="label bg-red">Consequências</span></td>
                    <td>Advanced Banner</td>
                    <td>consequencias_tratamento</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Prostodontia</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" style="display: none;">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Módulo</th>
                    <th>Tipo</th>
                    <th>Tag</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td><span class="label label-success">Header</span></td>
                    <td>Features</td>
                    <td>prostodontia-header</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><span class="label label-warning">Sobre</span></td>
                    <td>Advanced Banner</td>
                    <td>sobre-prostodontia</td>
                  </tr> 
                  <tr>
                    <td>3</td>
                    <td><span class="label bg-aqua">Fases do Tratamento</span></td>
                    <td>Features</td>
                    <td>fases-tratamento-prostodontia</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><span class="label bg-aqua">Fases do Tratamento</span></td>
                    <td>Features</td>
                    <td>fases-tratamento-prostodontia-itens</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><span class="label bg-red">Tipos Prótese</span></td>
                    <td>Features</td>
                    <td>tipos-protese</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><span class="label bg-red">Tipos Prótese</span></td>
                    <td>Features</td>
                    <td>tipos-protese-itens</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td><span class="label label-warning">Marcar Consulta</span></td>
                    <td>Advanced Banner</td>
                    <td>marcar-consulta</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td><span class="label bg-aqua">Proteses Dentárias</span></td>
                    <td>Traduções</td>
                    <td>TITULO = PROTESES_DENTARIAS | SUBTITULO = PROTESES_FIXAS</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td><span class="label bg-aqua">Proteses Dentárias</span></td>
                    <td>Features</td>
                    <td>proteses_fixas</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td><span class="label bg-red">Manutenção</span></td>
                    <td>Traduções</td>
                    <td>TITULO = MANUTENCAO_PROTESE</td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td><span class="label bg-red">Manutenção</span></td>
                    <td>Advanced Banner</td>
                    <td>manutencao_protese</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>


      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Periodontologia</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" style="display: none;">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Módulo</th>
                    <th>Tipo</th>
                    <th>Tag</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td><span class="label label-success">Header</span></td>
                    <td>Features</td>
                    <td>periodontologia-header</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><span class="label label-warning">Sobre</span></td>
                    <td>Advanced Banner</td>
                    <td>sobre-periodontologia</td>
                  </tr> 
                  <tr>
                    <td>3</td>
                    <td><span class="label bg-aqua">Fases do Tratamento</span></td>
                    <td>Features</td>
                    <td>fases-tratamento-perio</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><span class="label bg-aqua">Fases do Tratamento</span></td>
                    <td>Features</td>
                    <td>fases-tratamento-perio-itens</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><span class="label bg-red">Causas Perio</span></td>
                    <td>Features</td>
                    <td>causas-perio</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><span class="label bg-red">Causas Perio</span></td>
                    <td>Features</td>
                    <td>causas-perio-itens</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td><span class="label label-warning">Marcar Consulta</span></td>
                    <td>Advanced Banner</td>
                    <td>marcar-consulta</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td><span class="label bg-aqua">Perio Sintomas</span></td>
                    <td>Traduções</td>
                    <td>TITULO = PERIO_DENTAL | SUBTITULO = PERIO_SINTOMAS</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td><span class="label bg-aqua">Perio Sintomas</span></td>
                    <td>Features</td>
                    <td>perio_dental</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td><span class="label bg-red">Prevenção</span></td>
                    <td>Traduções</td>
                    <td>TITULO = PREVENCAO_DENTAL</td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td><span class="label bg-red">Prevenção</span></td>
                    <td>Advanced Banner</td>
                    <td>prevencao_dental</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>


      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">ROTA</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" style="display: none;">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Módulo</th>
                    <th>Tipo</th>
                    <th>Tag</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td><span class="label label-success">Header</span></td>
                    <td>Features</td>
                    <td>rota-header</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><span class="label label-warning">Sobre</span></td>
                    <td>Advanced Banner</td>
                    <td>sobre-rota</td>
                  </tr> 
                  <tr>
                    <td>3</td>
                    <td><span class="label bg-aqua">Fases do Tratamento</span></td>
                    <td>Features</td>
                    <td>fases-tratamento-rota</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><span class="label bg-aqua">Fases do Tratamento</span></td>
                    <td>Features</td>
                    <td>fases-tratamento-rota-itens</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><span class="label bg-red">Vantagens</span></td>
                    <td>Features</td>
                    <td>vantagens-rota</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><span class="label bg-red">Vantagens</span></td>
                    <td>Features</td>
                    <td>vantagens-rota-itens</td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td><span class="label label-warning">Marcar Consulta</span></td>
                    <td>Advanced Banner</td>
                    <td>marcar-consulta</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td><span class="label bg-aqua">Perda Dentária</span></td>
                    <td>Traduções</td>
                    <td>TITULO = PERDA_ROTA | SUBTITULO = PERDA_DENTE</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td><span class="label bg-aqua">Perda Dentária</span></td>
                    <td>Features</td>
                    <td>perda_dentaria</td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td><span class="label bg-red">Confiança e Segurança</span></td>
                    <td>Traduções</td>
                    <td>TITULO = CONFIANCA_SEGURANCA</td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td><span class="label bg-red">Confiança e Segurança</span></td>
                    <td>Advanced Banner</td>
                    <td>confianca_seguranca</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once("includes/footer.php");?>
  </div>
  <!-- ./wrapper -->
  <?php include_once("includes/mainjs.php");?>
  <script src="assets/plugins/select2/select2.full.min.js"></script>
  <script>


    $(document).on("submit", "form", function (event) {
      event.preventDefault();
      var str = $("form").serialize();
      var url = "includes/general.php";
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
          // alert(data);
          var result = data.split("||");
          if (result[0] == "true") {
            $.notify(result[1], "success");
            setTimeout(function () { location.reload(); }, 2000);
          } else {
            $.notify(result[1], "error");
          }
        },
        error: function (chr, desc, err) {
          $.notify("Oppsss... Aconteceu um erro ao tentar adicionar tradução!", "error");
        },
        cache: false,
        contentType: false,
        processData: false
      });

      return false;
    });

  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- <script src="assets/plugins/ckeditor/ckeditor.js"></script> -->
</body>

</html>