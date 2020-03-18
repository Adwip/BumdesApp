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
                    <h1>Ubah data aset</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?= site_url('edit-comp-asset') ?>" id="edit-comp-asset" method="POST" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Nama aset</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                          <input type="text" <?= isset($v->id)?waktu_data($v->id)?'required':'disabled':null ?> class="form-control" name="nama_aset" value="<?= isset($v->nm)?$v->nm:'-' ?>">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          <input type="text" readonly class="form-control" name="id" value="<?= isset($v->id)?$v->id:'-' ?>">
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="penyewa">Nomor aset</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <input type="text" <?= isset($v->id)?waktu_data($v->id)?'required':'disabled':null ?> required class="form-control" name="nomor_aset" value="<?= isset($v->na)?$v->na:'-' ?>">
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Sumber</label>
                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                          <input class="jenis" <?= isset($v->id)? !waktu_data($v->id)?'disabled':null:null ?> <?= isset($v->bl)? $v->bl=='Beli'?'checked':null :'Checked' ?> type="radio" name="sumber" value="Beli">
                          <label for="">Pembelian</label>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input class="jenis" <?= isset($v->id)? !waktu_data($v->id)?'disabled':null:null ?> <?= isset($v->bl)? $v->bl!='Beli'?'checked':null :null ?> type="radio" name="sumber" value="Non-beli">
                          <label for="">Non-pembelian</label>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Harga</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input id="harga" name="harga" <?= isset($v->id)?waktu_data($v->id)?'required':'disabled':null ?> <?= isset($v->id)? !waktu_data($v->id)?'disabled':null:null ?> type="text" class="form-control"  value="<?= isset($v->ha)?$v->ha:null ?>">
                          <!--========================================================-->
                          <span><input <?= isset($v->idf)?waktu_data($v->id)?'checked':'disabled':null ?> type="checkbox" id="cut-saldo" name="potong_saldo" value="Ya"> <label for="">Catat ke keuangan</label></span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input readonly class="form-control" value="Rp. <?= isset($b[0])? $b[0]->ac:0 ?>" id="saldo">
                          <span><label for="">Saldo saat ini</label></span>
                        </div>
                      </div> 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Lokasi</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <input type="text" <?= isset($v->id)?waktu_data($v->id)?'required':'disabled':null ?> class="form-control" name="lokasi" value="<?= isset($v->lk)?$v->lk:'-' ?>">
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Gambar</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input class="form-control" type="file" name="foto" id="img-form">
                          <span><input <?= !isset($v->img)?'disabled':null ?> name="del_fot" value="Ya" id="gan-fot" type="checkbox"><label>Hapus foto | </label></span>
                          <span>Ukuran maksimal 5 Mb</span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <img id="image-asset" style="padding: 1px; border: 1px solid black;" src="<?= isset($v->img)?base_url('asset/gambar/'.$v->img):base_url('asset/gambar/unnamed.png') ?>" alt="" width="230" height="140">
                          <input type="hidden" id="hid-img" name="img_val" value="<?= isset($v->img)?$v->img:null ?>">
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Kondisi</label>
                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                          <input <?= isset($v->kd)? $v->kd=='Baru'?'checked':null :'Checked Disabled' ?> type="radio" name="kondisi" value="Baru">
                          <label for="">Baru</label>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input <?= isset($v->kd)? $v->kd!='Baru'?'checked':null :'Disabled' ?> type="radio" name="kondisi" value="Bekas">
                          <label for="">Bekas</label>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="tang_mul">Tanggal masuk</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class='input-group date  tanggal_form' id='tanggal_edit'>
                          <input readonly type="text" <?= isset($v->id)?waktu_data($v->id)?'required':'disabled':null ?> class="form-control" name="tanggal_masuk" id="tang_mul" value="<?= isset($v->tg)?date('d-m-Y',strtotime($v->tg)):'-' ?>">
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Keadaan</label>
                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                          <input <?= isset($v->kn)? $v->kn=='Baik'?'checked':null :'Checked Disabled' ?> type="radio" name="keadaan" value="Baik">
                          <label for="">Baik</label>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input <?= isset($v->kn)? $v->kn!='Baik'?'checked':null :'Disabled' ?> type="radio" name="keadaan" value="Rusak">
                          <label for="">Rusak</label>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="tang_mul">Catatan</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <textarea name="catatan" class="form-control" name="catatan" id="" cols="30" rows="10" style="resize:none;"><?= isset($v->kt)?$v->kt:null ?></textarea>
                        </div>
                      </div> <br>
                      
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
    <script src="<?= base_url('asset/JS/Error_handler.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Form.js') ?>"></script>
  </body>
</html>