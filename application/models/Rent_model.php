<?php

class Rent_model extends CI_Model{
    function __construct(){
        parent:: __construct();
        $this->load->database('default');
		$this->load->library('Num_splitter');
    }

    function get_penyewaan($tahun, $bulan, $type='html'){
        $this->db->select('id_sewa AS id, nama AS ast, tanggal_mulai AS wml, tanggal_selesai AS wsl, penyewa AS pnw, FORMAT(harga, "#.00") AS nom');
        $this->db->from('penyewaan pn');
        $this->db->join('aset as','as.id_aset=pn.aset');/*
        if ($tahun!='All'&&$bulan=='All') {
            $this->db->like('tanggal_mulai',$tahun,'after');
        }elseif ($tahun=='All'&&$bulan!='All') {
            $this->db->like('tanggal_mulai',$bulan);
        }elseif ($tahun!='All'&&$bulan!='All') {
            $this->db->like('tanggal_mulai',$tahun.'-'.$bulan,'after');
        }*/
        $this->db->like('tanggal_mulai',$tahun.'-'.$bulan,'after');
        $result = $this->db->get()->result();
        $result1=null;
        if ($type=='html') {
            foreach ($result as $key => $v) {
                $but=null;
                if (waktu_data($v->id, 10)) {
                    $but = '<button type="button" class="btn btn-xs btn-danger hapus-sewa" value="'.$v->id.'">Hapus</button>'.anchor('edit-ar/'.$v->id,'Ubah','class="btn btn-xs btn-warning"');
                }
                $result1 .='<tr data-nam="'.$v->ast.'">
                            <td>'.($key+1).'</td>
                            <td>'.$v->ast.'</td>
                            <td>'.date('d/m/Y',strtotime($v->wml)).'</td>
                            <td>'.date('d/m/Y',strtotime($v->wsl)).'</td>
                            <td>'.$v->pnw.'</td>
                            <td>Rp. '.$v->nom.'</td>
                            <td class="text-center">
                                '.$but.'
                            </td>
                        </tr>';
            }
            return $result1;
        }else{
            return $result;
        }
    }

    function get_list_harga_sewa($type='html'){
        $this->db->select('id_aset_sewa AS id, nama AS nm, FORMAT(harga_sewa, "#.00") AS hs');
        $this->db->from('aset_disewakan as as');
        $this->db->join('aset','aset.id_aset=as.aset_sw');
        $result = $this->db->get()->result();
        $result1=null;
        if ($type=='html') {
            foreach ($result as $key => $v) {
                $result1 .= '<tr data-nam="'.$v->nm.'">
                                <td>'.($key+1).'</td>
                                <td>'.$v->nm.'</td>
                                <td>Rp. '.$v->hs.'</td>
                                <td class="text-center">
                                '.anchor('detail-rp/'.$v->id,'Detail').'
                                '.anchor('edit-rp/'.$v->id,'Ubah','class="btn btn-xs btn-warning"').'
                                <button type="button" class="btn btn-xs btn-danger hapus" value="'.$v->id.'">Hapus</button>
                                </td>
                            </tr>';
            }
            return $result1;
        }else{
            return $result;
        }
    }

    function get_grafik_penyewaan($tahun){
        $this->db->select();
        $this->db->from();
        $this->db->join();
        $this->db->where();
        $result = $this->db->get()->result();
        $result1 = [];
        foreach ($result as $key => $v) {
            $result []= $v->p;
        }

        return json_encode($result1);
    }

    function get_detail_histori_sewa($id){
        $this->db->select('tanggal_mulai AS tm, tanggal_selesai AS ts, DATEDIFF(tanggal_selesai, tanggal_mulai) AS jh, penyewa AS pn, FORMAT(harga, "#.00") AS hg');
        $this->db->from('aset as');
        $this->db->join('aset_disewakan ad','ad.aset_sw=as.id_aset');
        $this->db->join('penyewaan pn','pn.aset=as.id_aset');
        $this->db->where('id_aset_sewa',$id);
        $this->db->order_by('tanggal_mulai','ASC');
        $result = $this->db->get()->result();
        $result1=null;
        foreach ($result as $key => $v) {
            $result1 .= '
                        <tr>
                            <td>'.($key+1).'</td>
                            <td>'.date('d/m/Y',strtotime($v->tm)).'</td>
                            <td>'.$v->jh.' hari</td>
                            <td>'.date('d/m/Y',strtotime($v->ts)).'</td>
                            <td>'.$v->pn.'</td>
                            <td>Rp. '.$v->hg.'</td>
                        </tr>';
        }
        return $result1;
    }

    function get_perubahan_harga_sewa($id){
        $this->db->select('FORMAT(harga_lama, "#.00") AS hl, tanggal AS tg');
        $this->db->from('histori_harga_sewa');
        $this->db->where('aset_disewakan',$id);
        $result = $this->db->get()->result();
        $result1=null;
        foreach ($result as $key => $v) {
            $result1 .= '<tr>
                            <td>'.($key+1).'</td>
                            <td>'.date('d/m/Y',strtotime($v->tg)).'</td>
                            <td>Rp. '.$v->hl.'</td>
                        </tr>';
        }
        return $result1;
    }

    function set_penyewaan($aset, $penyewa, $kontak, $tanggal_mulai, $tanggal_sel, $harga){

        $id='002'.time();
        $isi = ['id_sewa'=>$id,'aset'=>$aset,'penyewa'=>$penyewa,'kontak'=>$kontak,'tanggal_mulai'=>$tanggal_mulai,'tanggal_selesai'=>$tanggal_sel,'harga'=>$harga];
        $this->db->insert('penyewaan',$isi);
        $resp['id']=$id;
        $resp['stat']=$this->db->affected_rows();
        return $resp;
    }

    function set_aset_sewa($aset, $harga){
        $id='003'.time();
        $isi = ['id_aset_sewa'=>$id,'aset_sw'=>$aset,'harga_sewa'=>$harga];
        $this->db->insert('aset_disewakan',$isi);
        $ret ['id'] = $id;
        $ret['res'] =  $this->db->affected_rows();
        return $ret;
    }

    function get_edit_penyewaan($id){
        $this->db->select('id_sewa AS id, nama AS nm, penyewa AS pn, tanggal_mulai AS tm, DATEDIFF(tanggal_selesai, tanggal_mulai) AS jh, harga AS hg, kontak AS kt, id_fin AS idf, FORMAT(harga_sewa, "#.00") AS hs');
        $this->db->from('penyewaan pn');
        $this->db->join('aset as','as.id_aset=pn.aset');
        $this->db->join('rekap_keuangan','foreg_id=id_sewa','LEFT');
        $this->db->join('aset_disewakan','aset_sw=aset');
        $this->db->where('id_sewa',$id);
        $result = $this->db->get()->result();
        isset($result[0])?$result[0]=$result[0]:$result[0]=null;
        return $result[0];
    }

    function get_edit_aset_sewa($id){
        $this->db->select('id_aset_sewa AS id, nama AS nm, nomor_aset AS na, harga_sewa AS hs');
        $this->db->from('aset_disewakan ad');
        $this->db->join('aset as','as.id_aset=ad.aset_sw');
        $this->db->where('id_aset_sewa',$id);
        $result = $this->db->get()->result();
        isset($result[0])?$result[0]=$result[0]:$result[0]=null;
        return $result[0];
    }

    function edit_penyewaan($id, $penyewa, $kontak, $tanggal_mul, $tanggal_sel, $harga){
        $isi = ['penyewa'=>$penyewa,'kontak'=>$kontak,'tanggal_mulai'=>$tanggal_mul,'tanggal_selesai'=>$tanggal_sel,'harga'=>$harga];

        $this->db->where('id_sewa',$id);
        $this->db->update('penyewaan',$isi);
        
        return $this->db->affected_rows();
    }

    function edit_aset_disewakan($id, $harga){
        $isi = ['harga_sewa'=>$harga];
        $this->db->where('id_aset_sewa',$id);
        $this->db->update('aset_disewakan',$isi);
        return $this->db->affected_rows();
    }

    function get_detail_aset_sewa($id){
        $this->db->select('nama AS nm, keadaan AS kd, FORMAT(harga_sewa, "#.00") AS hs');
        $this->db->from('aset_disewakan ad');
        $this->db->join('aset as','as.id_aset=ad.aset_sw');
        $this->db->where('id_aset_sewa',$id);
        $result = $this->db->get()->result();
      return $result;
    }

    function get_total_penyewaan($tahun){
        $this->db->select('FORMAT(SUM(harga), "#.00") AS hg');
        $this->db->from('penyewaan');
        $this->db->group_by('YEAR(tanggal_mulai)');
        $this->db->like('tanggal_mulai',$tahun,'after');
        $result = $this->db->get()->result();
        isset($result[0])?$result[0]=$result[0]:$result[0]=null;
        return $result[0];
    }

    function get_tahun(){
        $this->db->select('YEAR(tanggal_mulai) AS thn');
        $this->db->from('penyewaan');
        $this->db->group_by('YEAR(tanggal_mulai)');
        $result = $this->db->get()->result();
        return $result;
    }

    function del_penyewaan($id){
        $this->db->delete('penyewaan',['id_sewa'=>$id]);
        return $this->db->affected_rows();
    }

    function del_aset_sewa($id){
        $this->db->delete('aset_disewakan',['id_aset_sewa'=>$id]);
        return $this->db->affected_rows();
    }
}
