<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bumdes kalipuru | <?= $title ?></title>

    <?php $this->load->view('SuptPage/CssP') ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?= base_url() ?>" class="site_title"><i class="fa fa-paw"></i> <span>Bumdes kalipuru</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="https://1.bp.blogspot.com/-kuf6W_Yxf5E/WFqXlaCcAeI/AAAAAAAAIL0/V9UhNuz6MhMJciRalykCPaaPp6QCaPjYwCLcB/s1600/Arnold-Schwarzenegger-n-aime-pas-son-corps.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php $this->load->view('SuptPage/'.$page) ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <?php $this->load->view('SuptPage/FooterButton') ?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <?php $this->load->view('SuptPage/Notifikasi') ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" style="color:black;">
          <div class="x_panel">
            <div class="x_title">
            <h1>Informasi belanja barang BUMDes</h1>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-md-7">
                  <!-- <button class="btn btn-md btn-warning">Unduh laporan keuangan</button> -->
                  <!-- <a href="unduh-keuangan-bulanan?tahun=<?=$tahun?>&bulan=<?=$bulan?>"class="btn btn-md btn-warning" target="_blank">Unduh laporan keuangan</a>
                  <a href="add-finr" class="btn btn-md btn-info">Input data keuangan</a> -->
                </div>
                <div class="col-md-5">
                  <div class="row">
                    <form id="laporan-keuangan" action="<?= site_url('keuangan-bulanan') ?>" method="GET">
                      <div class="col-md-6 col-sm-6">  
                        <div class="form-group">
                          <label for="">Tahun</label>
                          <select name="tahun" class="form-control" onchange="$('#laporan-keuangan').submit()">
                            <?php 
                              foreach ($thn as $key => $val) {
                                $key==$tahun?$sel='selected':$sel=null;
                                echo '<option '.$sel.' value="'.$val->thn.'">'.$val->thn.'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                          <label for="">Bulan</label>
                          <select name="bulan" class="form-control" onchange="$('#laporan-keuangan').submit()">
                            <?php 
                            foreach ($bln as $key => $val) {
                              $key==$bulan?$sel='selected':$sel=null;
                              echo '<option '.$sel.' value="'.$key.'">'.$val.'</option>';
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                    </form>
                </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row tile_count">
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Transaksi barang masuk</span>
              <div class="count"><?= isset($v->jl)?''.$v->jl:'0' ?></div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total Nilai belanja</span>
              <div class="count"><?= isset($v->nl)?'Rp. '.$v->nl:'Rp. 0' ?></div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-12">
                    <h3>Pertumbuhan jumlah belanja <small>Bulan Januari 2020</small></h3>
                  </div>
                  <!-- <div class="col-md-6">
                    <form id="TipForm" action="">
                      <div class="form-group">
                        <select onchange="submitHp()" name="tipe" class="form-control">
                          <option value="minggu">Minggu</option>
                          <option value="bulan">Bulan</option>
                          <option value="Tahun">Tahun</option>
                        </select>
                      </div>
                    </form>
                  </div> -->
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
                  <div id="grafik_perdagangan"></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-12">
                    <h3>Pertumbuhan nilai belanja <small>Bulan Januari 2020</small></h3>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
                  <div id="grafik_penyewaan"></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <br>
          <br>
          <br>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer style="border-top: 1px solid #d9dee4;">
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <?php $this->load->view('SuptPage/JsP') ?>
    <script src="<?= base_url('asset') ?>/JS/Highchart.js"></script>
    <script src="<?= base_url('asset') ?>/JS/Form.js"></script>
    
    <script type="text/javascript">
      pertumbuhan_perdagangan(JSON.parse('<?= $v_graf ?>'),'#grafik_perdagangan')
      pertumbuhan_penyewaan(JSON.parse('<?= $v_graf ?>'),'#grafik_penyewaan')
    </script>
  </body>
</html>