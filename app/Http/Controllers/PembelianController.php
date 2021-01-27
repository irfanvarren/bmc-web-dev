<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pembelian;
use App\Models\Penerima;
use App\Models\Ekspedisi;
use App\Models\Stock;
use App\Models\tempDtlPembelian;
use App\Models\DetailPembelian;
use App\Models\DetailReturPembelian;
use App\Models\returPembelian;
use App\Models\jenisBarang;


class PembelianController extends Controller
{
    public function index(){
        $all_stock = Stock::get();
        $all_penerima = Penerima::get();
        $all_ekspedisi = Ekspedisi::get();
        $all_pembelian = Pembelian::orderByRaw("SUBSTRING_INDEX(id_pembelian, '/', 3) ASC")->get();
        $row = $all_pembelian->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_pembelian = $all_pembelian[$row-1]->id_pembelian;
            $pisah = explode('/',$id_pembelian);
            $row = $pisah[3] + 1;
        }
        $date = date('m/Y');
        $split = explode('/', $date);
        $bulan = $split[0];
        $tahun = $split[1];
        $all_jenis = jenisBarang::get();
        $data = [
            'id_pembelian' => $id_pembelian = "PEM/".$bulan."/".$tahun."/".$row,
            'all_penerima' => $all_penerima,
            'all_ekspedisi' => $all_ekspedisi,
            'all_stock' => $all_stock,
            'all_jenis' => $all_jenis
        ];
                //$detail_pembelian = DetailPembelian::where('id_pembelian',$id_pembelian);
        return view('pages.Pembelian.index',$data);
    }

    public function nota(){
        $all_pembelian = Pembelian::orderByRaw("SUBSTRING_INDEX(id_pembelian, '/', -1) ASC")->get();
        return view('pages.Pembelian.nota',['all_pembelian' => $all_pembelian]);
    }
    public function simpan_nota(Request $req){

        $id_pembelian = $req->input('id_pembelian');
        $tanggal_order = $req->input('tanggal_order');
        $nama_toko = $req->input('nama_toko');
        $alamat_toko =  $req->input('alamat_toko');
        $id_penerima = $req->input('nama_penerima');
        $nama_penerima = Penerima::where('id_penerima', $id_penerima)->get();
        $no_hp = Penerima::where('id_penerima', $id_penerima)->get();
        $id_ekspedisi = $req->input('id_ekspedisi');
        $ongkir = $req->input('ongkir');
        $total_harga = filter_var($req->input('subtotal'),FILTER_SANITIZE_NUMBER_INT); 
        $potongan_harga = $req->input('potongan_harga');
        $rasio_ongkir = $ongkir/$total_harga;
        $metode_pembayaran = $req->input('metode_pembayaran');
        $tanggal_terima = $req->input('tanggal_order');
        $username = auth()->user()->username;
        $keterangan = $req->input('keterangan');
        if($ongkir == ""){
            $ongkir = 0;
        }else if($potongan_harga == ""){
            $potongan_harga = 0;
        }
        Pembelian::insert([
            'id_pembelian' => $id_pembelian,
            'tanggal_order' => $tanggal_order,
            'nama_toko' => $nama_toko,
            'alamat_toko' => $alamat_toko,
            'id_penerima' => $id_penerima,
            'nama_penerima' => $nama_penerima[0]['nama_penerima'],
            'no_hp' => $no_hp[0]['no_hp'],
            'id_ekspedisi' => $id_ekspedisi,
            'ongkir' => $ongkir,
            'total_harga' => $total_harga,
            'potongan_harga' => $potongan_harga,
            'rasio_ongkir' => $rasio_ongkir,
            'metode_pembayaran' => $metode_pembayaran,
            'tanggal_terima' => NULL,
            'username' => $username,
            'keterangan' => $keterangan,
            'status' => "Diterima",
        ]);
        DB::insert('insert into tbdtl_pembelian select *from temp_dtl_pembelian');
        tempDtlPembelian::truncate();
        return redirect('/adm/pembelian')->with(["status"=>"Nota berhasil disimpan", "judul_alert" => "Simpan" , "icon" => "success"]);
    }
    public function dtlid_barang(){
        $id_barang = $_POST['id_barang'];
        echo json_encode(Stock::where('id_barang',$id_barang)->get());
    }
    public function cek_id(){
        $id_toko = $_POST['id_toko'];
        echo json_encode(Pelanggan::where('id_toko_pelanggan',$id_toko)->get());
    }
    public function add_items(){
        Stock::insert([
            'id_barang' => $_POST['id_barang'],
            'nama_barang' => $_POST['nama_barang'],
            'stock_barang' => $_POST['stock_barang'],
            'jenis_barang' => $_POST['jenis_barang'],
            'harga_minimal' => $_POST['harga_minimal'],
            'harga_maximal' => $_POST['harga_maximal'],
            'satuan' => $_POST['satuan']
        ]);
        return redirect('/adm/pembelian')->withStatus("Barang berhasil ditambahkan");
    }
    public function tambah_barang(){
        $id_pembelian = $_POST['id_pembelian'];
        $id_barang = isset($_POST['id_barang']) ? $_POST['id_barang'] : "";
        $cmd = isset($_POST['cmd']) ? $_POST['cmd'] : "";
        if($cmd != ""){
            if($cmd == "add"){
                $jumlah_barang = $_POST['jumlah_barang'];
                $ambil_barang_sebelumnya  = tempDtlPembelian::where('id_barang',$id_barang)->where('id_pembelian',$id_pembelian)->first();
                if($ambil_barang_sebelumnya){
                    $total_barang_sebelumnya = $ambil_barang_sebelumnya->jumlah_barang; 
                    $jumlah_barang = $total_barang_sebelumnya + $jumlah_barang; 
                    $ambil_barang_sebelumnya->where('id_barang',$id_barang)->where('id_pembelian',$id_pembelian)->update(['jumlah_barang' => $jumlah_barang]); 
                }else{
                    tempDtlPembelian::insert([
                        'id_pembelian' => $_POST['id_pembelian'],
                        'id_barang' => $id_barang,
                        'nama_barang' => $_POST['nama_barang'],
                        'jumlah_barang' => $_POST['jumlah_barang'],
                        'harga_barang' => $_POST['harga_barang'],
                        'jenis_barang' => $_POST['jenis_barang'],
                        'kondisi' => $_POST['kondisi'],
                        'satuan' => $_POST['satuan']
                    ]);
                }
            }else if($cmd == "edit"){
                tempDtlPembelian::where('id_barang',$id_barang)->update([
                    'id_pembelian' => $_POST['id_pembelian'],
                    'nama_barang' => $_POST['nama_barang'],
                    'jumlah_barang' => $_POST['jumlah_barang'],
                    'harga_barang' => $_POST['harga_barang'],
                    'jenis_barang' => $_POST['jenis_barang'],
                    'kondisi' => $_POST['kondisi'],
                    'satuan' => $_POST['satuan']
                ]);
            }else if($cmd == "delete"){
                tempDtlPembelian::where('id_barang',$id_barang)->where('id_pembelian',$id_pembelian)->delete();
            }
        }
        $subtotal = DB::select('select sum(harga_barang) as total_harga from temp_dtl_pembelian where id_pembelian="'.$id_pembelian.'"');
        $all_temp = tempDtlPembelian::where('id_pembelian',$_POST['id_pembelian'])->get();
        $data = [
            'all_temp_dtl_pembelian' => $all_temp,
            'subtotal' => $subtotal[0]->total_harga
        ];
        return view('pages.Pembelian.detail',$data);
    }
    public function edit_nota($id_pembelian){
        $all_pembelian = Pembelian::where('id_pembelian',urldecode($id_pembelian))->get();
        $all_detail_pembelian = DetailPembelian::where('id_pembelian',urldecode($id_pembelian))->get();
        if($all_pembelian[0]['status'] == "Retur"){
            $data = [
                'title' => 'BMC | Detail Nota',
                'id_pembelian' => urldecode($id_pembelian),
                'all_pembelian' => $all_pembelian,
                'nama_toko' => "VIO",
                'all_detail_pembelian' => $all_detail_pembelian,
                'icon' => 'error',
                'judul' => 'Perhatian !',
                'isi' => 'Nota sudah pernah mengalami retur'
            ];
            return view('pages.pembelian.nota-edited-info',$data);
        }
        if($all_pembelian[0]['tanggal_terima'] == NULL){
            $data = [
                'title' => 'BMC | Detail Nota',
                'id_pembelian' => urldecode($id_pembelian),
                'all_pembelian' => $all_pembelian,
                'nama_toko' => "VIO",
                'all_detail_pembelian' => $all_detail_pembelian,
                'icon' => 'warning',
                'judul' => 'Tanggal terima belum ada!',
                'isi' => 'Segera update tanggal'
            ];
            return view('pages.pembelian.nota-edited-info',$data);
        }
        $data = [
            'title' => 'BMC | Detail Nota',
            'id_pembelian' => urldecode($id_pembelian),
            'all_pembelian' => $all_pembelian,
            'nama_toko' => "VIO",
            'all_detail_pembelian' => $all_detail_pembelian,
            'icon' => '',
        ];
        return view('pages.pembelian.nota-edited-info',$data);

    }
    public function nota_info($id_pembelian){
        $all_pembelian = Pembelian::where('id_pembelian',urldecode($id_pembelian))->get();
        $all_detail_pembelian = Detailpembelian::where('id_pembelian',urldecode($id_pembelian))->get();
        $data = [
            'title' => 'BMC | Detail Nota',
            'id_pembelian' => urldecode($id_pembelian),
            'all_pembelian' => $all_pembelian,
            'all_detail_pembelian' => $all_detail_pembelian,
        ];
        return view('pages.pembelian.nota-info',$data);  
    }
    public function hapus_nota($id_pembelian){
        $id_pembelian = urldecode($id_pembelian);
        Pembelian::where('id_pembelian',$id_pembelian)->delete();
        DetailPembelian::where('id_pembelian',$id_pembelian)->delete();
        return redirect('adm/nota-pembelian')->with(["status"=>"Nota berhasil dihapus", "judul_alert" => "Hapus" , "icon" => "success"]);
    }
    public function ubah_tanggal(){
        Pembelian::where('id_pembelian', $_POST['id_pembelian'])->update([
            'tanggal_terima' => $_POST['tanggal_terima'],
            'status' => 'Diterima'
        ]);
        $tanggal_terima = Pembelian::where('id_pembelian', $_POST['id_pembelian'])->get();
        $all_dtl_pembelian = DetailPembelian::where('id_pembelian',$_POST['id_pembelian'])->get();
        foreach($all_dtl_pembelian as $a_d_p){
            $stock = Stock::select('stock_barang')->where('id_barang',$a_d_p->id_barang)->get();
            $total = $stock[0]['stock_barang'] + $a_d_p->jumlah_barang;
            Stock::where('id_barang',$a_d_p->id_barang)->update(['stock_barang' => $total]);
        }
        echo json_encode($tanggal_terima[0]['tanggal_terima']);
    }
    public function retur_nota(Request $request,$id_pembelian){
        $id_pembelian = urldecode($id_pembelian);	
        $id_barang = $request->id_barang;
        $all_retur_pembelian = DetailReturPembelian::get();
        $all_pembelian = Pembelian::get();
        $detail_pembelian = DetailPembelian::where('id_pembelian',$id_pembelian )->whereIn('id_barang',$id_barang)->get();
        $barang_sudah_ada = array();
        $id_barang_ada = array();

        foreach($detail_pembelian as $d_p){
            array_push($id_barang_ada,$d_p->id_barang);
            array_push($barang_sudah_ada,$d_p->nama_barang);

            DetailReturPembelian::insert([
                'id_retur' => $id_pembelian,
                'id_barang' => $d_p->id_barang,
                'nama_barang' => $d_p->nama_barang,
                'jumlah_barang' => $d_p->jumlah_barang,
                'nominal_retur' => $d_p->harga_barang,
                'jenis_retur' => "-"
            ]);        
        }
        return redirect('adm/nota-pembelian/retur/'.urlencode(urlencode($id_pembelian)));
    }
    public function edit_retur(){

    }
    public function view_retur($id_pembelian){
        $id_pembelian = urldecode($id_pembelian);	
        $all_retur_pembelian = DetailReturPembelian::where('id_retur',$id_pembelian)->get();
        $all_pembelian = Pembelian::where('id_pembelian',$id_pembelian)->get();
        $data = [
            'title' => 'BMC | Retur Pembelian',
            'id_transaksi' => $id_pembelian,
            'all_retur_pembelian' => $all_retur_pembelian,
            'all_pembelian' => $all_pembelian
        ];
        return view('pages.Retur.detailPembelian',$data);
    }
    public function view(){
        $id_pembelian = $_POST['id_pembelian'];
        $all_retur_pembelian = DetailReturPembelian::where('id_retur',$id_pembelian)->join('tb_pembelian','tb_pembelian.id_pembelian','dtlretur_pembelian.id_retur')->get();
        $data_pembelian =Pembelian::where('retur_pembelian.id_pembelian',$id_pembelian)->join('retur_pembelian','retur_pembelian.id_pembelian','tb_pembelian.id_pembelian')->join('tb_ekspedisi','tb_ekspedisi.id_ekspedisi','tb_pembelian.id_ekspedisi')->first();

        $jumlah_item = 0; $total_harga = 0;$row=1;
        foreach($all_retur_pembelian as $key => $arp){
            $jumlah_item += $arp->jumlah_barang;
            $total_harga += $arp->nominal_retur;
            echo "
                <tr>
                    <td> ".$row++." </td>
                    <td> ".$arp->id_barang." </td>
                    <td> ".$arp->nama_barang." </td>
                    <td> ".$arp->jumlah_barang." </td>
                    <td> ".number_format($arp->nominal_retur,0,',','.')." </td>
                    <td> ".$arp->jenis_retur." </td>
                </tr>
            ";
        }
            echo "
                <tr>
                    <th colspan='5'> ".$jumlah_item." Items  </th>
                    <th> ".number_format($total_harga,0,',','.')." </th> 
                </tr>
            ";
        echo "###".json_encode($data_pembelian);
    }
    public function simpan_retur(){ 
        $status = $_POST['status'];
        $id_pembelian = $_POST['id_pembelian'];
        $jenis_retur = $_POST['jenis_retur'];
        $jumlah_produk_retur = $_POST['jumlah_produk_retur'];
        $tanggal_retur = $_POST['tanggal_retur'];
        if($status == "Setuju"){
            $all_retur = returPembelian::orderByRaw("SUBSTRING_INDEX(id_retur, '/', 3) ASC")->get();
            $row = $all_retur->count();
            if($row == 0){
                $row = 1;
            }else{ 
                $id = $all_retur[$row-1]->id_retur;
                $pisah = explode('/',$id);
                $row = $pisah[3] + 1;
            }
            $date = date('m/Y');
            $split = explode('/', $date);
            $bulan = $split[0];
            $tahun = $split[1];
            $id_retur =  "R/".$bulan."/".$tahun."/".$row;
            /*update jenis retur di detail retur*/
            foreach($jenis_retur as $data){
                DetailReturPembelian::where('id_barang',$data['id_barang'])->update(['jenis_retur'=>$data['jenis_retur']]);               
            }
            $all_retur_pembelian = DetailReturPembelian::where('id_retur',$id_pembelian)->get();
            foreach($all_retur_pembelian as $arp){
                $id_barang = $arp->id_barang;
                if($arp->jenis_retur == "Retur Barang"){
                    $stock_barang_db = Stock::select('stock_barang')->where('id_barang',$id_barang)->get();
                    $stock_temp = DetailReturPembelian::select('jumlah_barang')->where('id_retur', $id_pembelian)->where('id_barang',$id_barang)->get();
                    $new_stock = $stock_barang_db[0]['stock_barang'] - $stock_temp[0]['jumlah_barang'];

                    Stock::where('id_barang',$id_barang)->update(['stock_barang' => $new_stock]);
                }
            }

            /*update jenis retur di detail retur*/

            Pembelian::where('id_pembelian',$id_pembelian)->update(['status' => 'Retur']);
            $split_tanggal = explode('/',$tanggal_retur);
            $new_tanggal_retur = $split_tanggal[2].'-'.$split_tanggal[1].'-'.$split_tanggal[0];
            returPembelian::insert([
                'id_retur' => $id_retur,
                'id_pembelian' => $id_pembelian,
                'id_akun' => 'VIO',
                'jumlah_produk_retur' => $jumlah_produk_retur,
                'tanggal_retur' => $new_tanggal_retur,
                'tanggal_perpanjang' => NULL
            ]);

        }else if($status == "Batal"){
            DetailReturPembelian::where('id_retur', $id_pembelian)->delete();
        }
        //echo $_POST['status'];
    }
    public function filter(Request $request){
        $nama_toko =  $request->nama_toko;
        $tanggal_order = $request->tanggal_order;
        $tanggal_terima = $request->tanggal_terima;
        $status = $request->status;
        $pembelian = new Pembelian();
        if($nama_toko != ""){
            $pembelian = $pembelian->where('nama_toko','like','%'.$nama_toko.'%');
        }
        if($status == "Retur"){
            $pembelian = $pembelian->where('status','Retur');
        }else if($status == "Diterima"){
            $pembelian = $pembelian->where('status','Diterima');
        }
        if($tanggal_order != ""){
            $pembelian = $pembelian->where('tanggal_order','like','%'.$tanggal_order.'%');
        }
        if($tanggal_terima != ""){
            $pembelian = $pembelian->where('tanggal_terima','like','%'.$tanggal_terima.'%');
        }
        $pembelian = $pembelian->get();
        $hasil = "";
        if(count($pembelian)){
            foreach($pembelian as $key => $ap){
                if($ap->tanggal_terima == NULL){
                    $tanggal = "-";
                }else{
                    $tanggal = $ap->tanggal_terima;
                }
                $hasil .= '
                    <tr> 
                        <td> '.$ap->id_pembelian.' </td>
                        <td> '.$ap->tanggal_order.' </td>
                        <td> '.$tanggal.' </td>
                        <td> '.$ap->nama_toko.' </td>
                        <td> '.$ap->metode_pembayaran.' </td>
                        <td> '.number_format($ap->total_harga,0,',','.').'</td>	
                        <td> '.number_format(($ap->total_harga+$ap->ongkir)-$ap->potongan_harga,0,',','.').' </td>
                        <td>
                            <a href="'.asset('/adm/nota-pembelian/edited').'/'.urlencode(urlencode($ap->id_pembelian)).'" class="float-left btn btn-warning ml-1 text-white"> <i class="fas fa-pencil-alt"></i> </a>
                            <button onclick="hapus('."'".urlencode(urlencode($ap->id_pembelian))."'".')" class="float-left btn btn-danger ml-1"> <i class="fas fa-trash-alt"></i> </button>
                            <a href="'.asset('/adm/nota-pembelian').'/'.urlencode(urlencode($ap->id_pembelian)).'" class="float-left btn btn-primary ml-1"> <i class="fas fa-info-circle"></i> </a>
                        </td>
                    </tr>
                ';
            }
        }else{
            $hasil .="
                <tr>
                    <th colspan='8'> Tidak Ada Data  </th>
                </tr>
            ";
        }
        echo $hasil;
    }

    public function retur_pembelian(){
        $all_retur_pembelian = returPembelian::join('tb_pembelian','tb_pembelian.id_pembelian','retur_pembelian.id_pembelian')->get();
        $data = [
            'title' => 'BMC | Retur Pembelian',
            'all_retur_pembelian' => $all_retur_pembelian
        ];
        return view('pages.Retur.returPembelian',$data);
    }

    public function hapus_retur($id_retur){
        $id_retur = urldecode($id_retur);
        returPembelian::where('id_retur',$id_retur)->delete();
        DetailReturPembelian::where('id_retur',$id_retur)->delete();

        return redirect('adm/retur-pembelian')->with(["status"=>"Retur berhasil dihapus", "judul_alert" => "Hapus" , "icon" => "success"]);
    }

    public function perpanjang_retur($id_retur,Request $request){
        $id_retur = urldecode($id_retur);
        $retur_pembelian = returPembelian::find($id_retur);
        if($retur_pembelian->tanggal_perpanjang != ""){
            $tanggal_perpanjang =  date_create($retur_pembelian->tanggal_perpanjang);
        }else{
            $tanggal_perpanjang =  date_create($retur_pembelian->tanggal_retur);
        }
        $tanggal_max = date_create($retur_pembelian->tanggal_retur);
        date_add($tanggal_max,date_interval_create_from_date_string('9 days'));
        date_add($tanggal_perpanjang , date_interval_create_from_date_string('3 days'));
        $tanggal_perpanjang = date_format($tanggal_perpanjang, "Y-m-d");
        $tanggal_max = date_format($tanggal_max, "Y-m-d");
 
        if($tanggal_perpanjang <= $tanggal_max){
            $retur_pembelian->tanggal_perpanjang = $tanggal_perpanjang;
            $retur_pembelian->save();   
            return redirect('adm/retur-pembelian')->with(["status"=>"Retur berhasil diperpanjang", "judul_alert" => "Perpanjangan Retur" , "icon" => "success"]);
        }else{
            return redirect('adm/retur-pembelian')->with(["status"=>"Maximal retur hanya 3 kali", "judul_alert" => "Gagal Perpanjangan Retur" , "icon" => "error"]);
        }
    }
}