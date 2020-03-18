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
        <div class="right_col" role="main" style="color: black;">
          <div class="col-md-12">
              <button class="btn btn-md btn-warning" onclick="window.location.href=document.referrer">Batal | Kembali</button>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1>Ubah data penyewaan</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?= site_url('edit-penyewaan') ?>" id="edit-penyewaan" method="POST" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Nama aset</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                          <input name="aset" type="text" readonly class="form-control" value="<?= isset($v->nm)?$v->nm:'-' ?>">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          <input type="text" readonly class="form-control" name="id" value="<?= isset($v->id)?$v->id:'-' ?>">
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Nama penyewa</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <input type="text" required class="form-control" name="penyewa" value="<?= isset($v->pn)?$v->pn:'-' ?>">
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Kontak penyewa</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <input type="text" required class="form-control" name="kontak" value="<?= isset($v->kt)?$v->kt:'-' ?>">
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Tanggal mulai / jumlah hari</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                          <div class='input-group date  tanggal_form' id='tanggal_edit'>
                            <input type="text" readonly class="form-control" name="tanggal" value="<?= isset($v->tm)?date('d-m-Y',strtotime($v->tm)):'-' ?>">
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-1">
                          <input type="text" class="form-control" name="jumlah_hari"  value="<?= isset($v->jh)?$v->jh:'0' ?>">
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-1">
                          <input readonly type="text" class="form-control" value="Hari">
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Harga</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input type="text" class="form-control" name="harga" value="<?= isset($v->hg)?$v->hg:'0' ?>">
                          <!--========================================================-->
                          <span><input <?= isset($v->idf)?waktu_data($v->id)?'checked':'disabled':null ?> type="checkbox" name="potong_saldo" value="Ya"> <label for="">Catat ke keuangan</label></span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input readonly type="text" class="form-control" value="Rp. <?= isset($v->hs)?$v->hs:'0' ?>">
                        </div>
                      </div>
                      
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <button <?= isset($v->id)?null:'disabled' ?> type="submit" class="btn btn-md btn-primary">Kirim</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    

    <?php $this->load->view('SuptPage/JsP') ?>
    <script src="<?= base_url('asset/JS/Fitur.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Form.js') ?>"></script>
  </body>
</html>