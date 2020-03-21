<?php

class HR_model extends CI_Model{
    function __construct(){
        parent:: __construct();
        $this->load->database('default');
        $config= [
            'protocol'=>'smtp',
            'smtp_host'=>'ssl://smtp.googlemail.com',
            'smtp_port'=>465,
            'smtp_user'=>'agpython15@gmail.com',
            'smtp_pass'=>'akademikuii',
            'smtp_crypto' => 'ssl',
            'mailtype'=>'html',
            'charset'=>'iso-8859-1'
        ];
    }

    function get_admin(){
        $this->db->select('id_admin AS id, nama AS nm, kategori AS ktg, status_akt as sa, kontak AS kt, waktu_reg AS wr');
        $this->db->from('admin');
        $this->db->where('kategori !=','SYS');
        $result = $this->db->get()->result();
        $result1['mng']=null;
        $result1['gov']=null;
        $n=1;
        $m=1;
        foreach ($result as $key => $v) {
            if ($v->ktg=='MNG') {

                $result1['mng'] .= '<tr data-nam="'.$v->nm.'">
                                        <td>'.$n.'</td>
                                        <td>'.$v->nm.'</td>
                                        <td>'.date('H:i:s d-m-Y',strtotime($v->wr)).'</td>
                                        <td>'.$v->kt.'</td>
                                        <td>
                                         '.anchor('detail-user/'.$v->id,'Detail').' <button type="button" class="btn btn-xs btn-danger hapus" value="'.$v->id.'">Hapus</button>
                                        </td>
                                    </tr>';
                $n++;
            }else {
                $result1['gov'] .= '<tr data-nam="'.$v->nm.'">
                                        <td>'.$m.'</td>
                                        <td>'.$v->nm.'</td>
                                        <td>'.date('H:i:s d-m-Y',strtotime($v->wr)).'</td>
                                        <td>'.$v->kt.'</td>
                                        <td>
                                         '.anchor('detail-user/'.$v->id,'Detail').' <button type="button" class="btn btn-xs btn-danger hapus" value="'.$v->id.'">Hapus</button>
                                        </td>
                                    </tr>';
                $m++;
            }
        }
        return $result1;
    }

    function get_log_user($tahun, $bulan, $type='html'){
        $this->db->select('IFNULL(del_ad,nama) AS nm, log AS lg, waktu AS tm, tanggal AS dt');
        $this->db->from('log_admin la');
        if ($tahun!='All'&&$bulan=='All') {
            $this->db->like('tanggal',$tahun,'after');
        }elseif ($tahun=='All'&&$bulan!='All') {
            $this->db->like('tanggal',$bulan);
        }elseif ($tahun!='All'&&$bulan!='All') {
            $this->db->like('tanggal',$tahun.'-'.$bulan,'after');
        }
        $this->db->order_by('id_temp','DESC');
        $this->db->join('admin am','am.id_admin=la.admin','LEFT');
        $result=$this->db->get()->result();
        $result1=null;
        foreach ($result as $key => $v) {
            $result1 .= '<tr>
                           <td>'.($key+1).'</td>
                           <td>'.$v->nm.'</td>
                           <td>'.$v->lg.'</td>
                           <td>'.$v->tm.'</td>
                           <td>'.date('d/m/Y',strtotime($v->dt)).'</td>
                        </tr>';
        }
        return $result1;
    }

    function get_user_log_id($id){
        $this->db->select('log AS lg, waktu AS tm, tanggal AS dt');
        $this->db->from('log_admin');
        $this->db->where('admin',$id);
        $this->db->order_by('id_temp','DESC');
        $result=$this->db->get()->result();
        $result1=null;
        foreach ($result as $key => $v) {
            $result1 .= '<tr>
                           <td>'.($key+1).'</td>
                           <td>'.$v->lg.'</td>
                           <td>'.$v->tm.'</td>
                           <td>'.date('d/m/Y',strtotime($v->dt)).'</td>
                        </tr>';
        }
        return $result1;
    }


    function set_admin_baru($nama, $kontak, $username, $kategori, $password){
        $id = '008'.time();
        $isi=['id_admin'=>$id,'nama'=>$nama,'username'=>$username,'password'=>md5($password),'kontak'=>$kontak,'kategori'=>$kategori,'status_akt'=>'Aktif', 'waktu_reg'=>date('Y-m-d H:i:s')];
        $this->db->insert('admin',$isi);

        $ret['id'] = $id;
        $ret['resp'] = $this->db->affected_rows();
        return $ret;
    }
    function log_admin($id, $pesan, $tanggal, $waktu){
      $isi = ['log'=>$pesan,'admin'=>$id,'tanggal'=>$tanggal,'waktu'=>$waktu];
      $this->db->insert('log_admin',$isi);
    }

    function get_tahun_log(){
        $this->db->select('YEAR(tanggal) AS thn');
        $this->db->from('log_admin');
        $this->db->group_by('YEAR(tanggal)');
        $get = $this->db->get()->result();
        return $get;
    }

    function del_user($id){
        $this->db->delete('admin',['id_admin'=>$id]);
        return $this->db->affected_rows();
    }

    function get_edit_profil($id){
        $this->db->select('nama AS nm, username AS un, kontak AS kt, foto_user AS img');
        $this->db->from('admin');
        $this->db->where('id_admin',$id);
        $result = $this->db->get()->result();
        $result = isset($result[0])?$result[0]:null;
        return $result;
    }

    function edit_profil($id, $nama, $username, $kontak, $pass, $foto, $df){
        $isi = [];
        if ($foto) {
            $isi[]=$foto;
        }elseif ($df) {
            $isi[]=null;
        }
        $this->db->where('id_admin',$id);
        $this->db->update('admin',$isi);
        return $this->db->affected_rows();
    }

    function get_detail_user($id){
        $this->db->select('nama AS nm, username AS un, kategori AS kt, waktu_reg AS wr, foto_user AS ft, kontak AS kn');
        $this->db->from('admin');
        $this->db->where('id_admin',$id);
        $this->db->or_where('username',$id);
        $result=$this->db->get()->result();
        $result = isset($result[0])?$result[0]:null;

        return $result;
    }

    function cek_username($usn){
        $this->db->select('');
        $this->db->from('admin');
        $this->db->where('username',$usn);
        $result = $this->db->get()->num_rows();
        // $this->db->
        return $result;
    }

    function login($email,$password){
        //json [status],[kategori]
    }

    function add_user($nama, $email, $kontak, $kategori){

    }

    function register_user($email, $password){

    }

    function get_user($jenis='MNG'){

    }

    function ganti_password($pass_baru,$pass_lama){

    }

    function cek_session($id){

    }
}
