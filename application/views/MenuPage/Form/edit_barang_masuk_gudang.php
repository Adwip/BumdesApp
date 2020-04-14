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
            <?php $this->load->view('SuptPage/MenuPage') ?>
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
                    <h1>Ubah barang masuk gudang</h1>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?= site_url('edit-barang-masuk') ?>" id="edit-barang-masuk" method="POST" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Komoditas</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                          <input name="n_kom" type="text" readonly class="form-control" value="<?= isset($v->kom)?$v->kom:'-' ?>">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                          <input type="text" readonly class="form-control" name="id" value="<?= isset($v->id)?$v->id:'-' ?>">
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="kontak">Sumber</label>
                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                          <input class="jenis" <?= isset($v->bl)? $v->bl=='Beli'?'checked':null :'Checked' ?> type="radio" name="sumber" value="Beli">
                          <label for="">Pembelian</label>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input class="jenis" <?= isset($v->bl)? $v->bl!='Beli'?'checked':null :null ?> type="radio" name="sumber" value="Non-beli">
                          <label for="">Non-pembelian</label>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Tanggal</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <div class='input-group date tanggal_form tanggal_edit'>
                              <input id='tanggal_edit' readonly <?= !isset($v->id)?'disabled':'data-tl="'.konv_waktu($v->id).'"' ?> type="text" class="form-control" name="tanggal"  value="<?= isset($v->dt)?date('d-m-Y',strtotime($v->dt)):'-' ?>">
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Jumlah</label>
                        <div class="col-md-5 col-sm-5 col-xs-5">
                          <input type="text" required class="form-control" name="jumlah" value="<?= isset($v->jl)?$v->jl:0 ?>" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-1">
                          <input type="text" name="satuan" readonly class="form-control"  value="<?= isset($v->st)?$v->st:'-' ?>">
                        </div>
                      </div> <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Harga</label>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input  <?= isset($v->bl)? $v->bl!='Beli'?'disabled':null :null ?> id="harga" name="harga" required <?= isset($v->id)? !waktu_data($v->id)?'disabled':null:null ?> type="text" class="form-control"  value="<?= isset($v->hg)?$v->hg:null ?>" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                          <!--========================================================-->
                          <span><input <?= isset($v->bl)? $v->bl!='Beli'?'disabled':$v->idf?'checked':null :null ?> type="checkbox" id="cut-saldo" name="potong_saldo" value="Ya"> <label for="">Catat ke keuangan</label></span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <input readonly class="form-control" value="Rp. <?= isset($b[0])? $b[0]->ac:0 ?>" id="saldo">
                          <span><label for="">Saldo saat ini</label></span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                          <small class="label label-danger" id="warning" style="display: none;">Nilai melebihi saldo saat ini</small>
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3" >Catatan</label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <textarea <?= isset($v->id)? !waktu_data($v->id)?'disabled':null:null ?> name="catatan" class="form-control" name="cat" id="" cols="30" rows="10" style="resize:none;"><?= isset($v->ct)?$v->ct:null ?></textarea>
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
    <script src="<?= base_url('asset/JS/Dtmpicker.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Error_handler.js') ?>"></script>
    <script src="<?= base_url('asset/JS/Form_edit.js') ?>"></script>
  </body>
</html>