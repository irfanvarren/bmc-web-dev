<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\DetailPenjualan;
use App\Models\tempDtlPenjualan;
use App\Models\DetailReturPenjualan;
use App\Models\returPenjualan;
use App\Models\Stock;
use PDF;

class PenjualanController extends Controller
{
	public function index(){
		$all_stock = Stock::get();
		$all_temp_dtl_penjualan = tempDtlPenjualan::get();
		$all_pelanggan = Pelanggan::get();
		$all_penjualan = Penjualan::orderByRaw("SUBSTRING_INDEX(id_penjualan, '/', 3) ASC")->get();
        $row = $all_penjualan->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_penjualan = $all_penjualan[$row-1]->id_penjualan;
            $pisah = explode('/',$id_penjualan);
            $row = $pisah[3] + 1;
        }
		$date = date('m/Y');
		$split = explode('/', $date);
		$bulan = $split[0];
		$tahun = $split[1];
		$data = [
			'title' => 'BMC | Penjualan',
			'id_penjualan' => $id_penjualan = "PEN/".$bulan."/".$tahun."/".$row,
			'all_pelanggan' => $all_pelanggan,
			'all_stock' => $all_stock,
			'all_temp_dtl_penjualan' => $all_temp_dtl_penjualan,
			
		];
		return view('pages.Penjualan.index',$data);
	}
	public function nota(){
		$all_penjualan = Penjualan::selectRaw('tb_penjualan.*,tb_pelanggan.nama_toko_pelanggan')->join('tb_pelanggan','tb_pelanggan.id_toko_pelanggan','tb_penjualan.id_toko_pelanggan')->orderByRaw("SUBSTRING_INDEX(id_penjualan, '/', -1) ASC")->get();
		$data = [
			'title' => 'BMC | Nota',
			'all_penjualan' => $all_penjualan,
			
		];
		return view('pages.Penjualan.nota',$data);
	}
	public function edit_nota($id_penjualan){
		$all_penjualan = Penjualan::where('id_penjualan',urldecode($id_penjualan))->get();
		$all_detail_penjualan = DetailPenjualan::where('id_penjualan',urldecode($id_penjualan))->get();
		$nama_toko = Pelanggan::where('id_toko_pelanggan',$all_penjualan[0]['id_toko_pelanggan'])->get();
		$data = [
			'title' => 'BMC | Detail Nota',
			'id_penjualan' => urldecode($id_penjualan),
			'all_penjualan' => $all_penjualan,
			'nama_toko' => $nama_toko,
			'all_detail_penjualan' => $all_detail_penjualan,
		];
		return view('pages.Penjualan.nota-edited-info',$data);
	}
	public function hapus_nota($id_penjualan){
		Penjualan::where('id_penjualan', urldecode($id_penjualan))->delete();
		DetailPenjualan::where('id_penjualan',urldecode($id_penjualan))->delete();
		return redirect('/adm/nota-penjualan')->with(["status"=>"Data sudah dihapus", "judul_alert" => "Berhasil" , "icon" => "success"]);
	}
	public function nota_info($id_penjualan){
		$all_penjualan = Penjualan::where('id_penjualan',urldecode($id_penjualan))->get();
		$all_detail_penjualan = DetailPenjualan::where('id_penjualan',urldecode($id_penjualan))->get();
		$nama_toko = Pelanggan::where('id_toko_pelanggan',$all_penjualan[0]['id_toko_pelanggan'])->get();
		$data = [
			'title' => 'BMC | Detail Nota',
			'id_penjualan' => urldecode($id_penjualan),
			'all_penjualan' => $all_penjualan,
			'nama_toko' => $nama_toko,
			'all_detail_penjualan' => $all_detail_penjualan,
		];
		return view('pages.Penjualan.nota-info',$data);
	}
	public function simpan_nota(Request $req){
		$id_penjualan = $req->input('id_penjualan');
		$id_toko_pelanggan = Pelanggan::where('id_toko_pelanggan',$req->input('nama_toko'))->get();
		$pembelian_ke = count(Penjualan::where('id_toko_pelanggan',$id_toko_pelanggan[0]['id_toko_pelanggan'])->get())+1;
		$nama_toko = $id_toko_pelanggan[0]['nama_toko_pelanggan'];
		$tanggal_order = $req->input('tanggal_order');
		$alamat_toko = $req->input('alamat_toko');
		$tanggal_kirim = $req->input('tanggal_kirim');
		$metode_pembayaran = $req->input('metode_pembayaran');
		$diskon = $req->input('diskon');
		$jatuh_tempo = $req->input('jatuh_tempo');
		$penanggung_jawab = $req->input('penanggung_jawab');
		$no_hp = $req->input('no_hp');
		$keterangan = $req->input('keterangan');
		$total_harga = filter_var($req->input('total'),FILTER_SANITIZE_NUMBER_INT); 
		if($total_harga == 0){
			return redirect('/adm/penjualan')->with(["status"=>"Tidak ada nilai transaksi", "judul_alert" => "Error" , "icon" => "error"]);
		}
		if($diskon == NULL){
			$diskon = 0;
		}	
		Penjualan::insert([
			'id_penjualan' => $id_penjualan,
			'tanggal_order' => $tanggal_order,
			'tanggal_kirim' => $tanggal_kirim,
			'id_toko_pelanggan' => $req->input('nama_toko'),
			'alamat_toko_pelanggan' => $alamat_toko,
			'metode_pembayaran' => $metode_pembayaran,
			'diskon' => $diskon,
			'jatuh_tempo' => $jatuh_tempo,
			'penanggung_jawab' => $penanggung_jawab,
			'no_hp' => $no_hp,
			'keterangan' => $keterangan,
			'total_harga' => $total_harga,
			'status' => "Diterima"
		]);
		
		Pelanggan::where('id_toko_pelanggan',$id_toko_pelanggan[0]['id_toko_pelanggan'])->update(['pembelian_ke' => $pembelian_ke]);
		
		DB::insert("insert into tbdtl_penjualan select *from temp_dtl_penjualan");
		$temp_detail_penjualan = tempDtlPenjualan::select('id_barang','jumlah_barang')->get();
		foreach($temp_detail_penjualan as $data){
			Stock::where('id_barang',$data->id_barang)->decrement('stock_barang',$data->jumlah_barang);
		}
		tempDtlPenjualan::truncate();
		return redirect('/adm/penjualan')->with(["status"=>"Nota berhasil disimpan", "judul_alert" => "Simpan" , "icon" => "success"]);
	}
	
	public function pindah_nota(Request $request,$id_penjualan){
		$id_penjualan = urldecode($id_penjualan);	
		$btn = $request->input('move_retur');
		$id_barang = $request->id_barang;
		if($id_barang == ""){
			return redirect()->back()->withError('Anda belum memilih produk apapun harap untuk memilih produk terlebih dahulu !');
		}
		if($btn == "add_item"){
			$detail_penjualan = DetailPenjualan::where('id_penjualan',$id_penjualan )->whereIn('id_barang',$id_barang)->get();
			
			$all_penjualan = Penjualan::orderByRaw("SUBSTRING_INDEX(id_penjualan, '/', 3) ASC")->get();
			$row = $all_penjualan->count();
			if($row == 0){
				$row = 1;
			}else{ 
				$id_penjualan = $all_penjualan[$row-1]->id_penjualan;
				$pisah = explode('/',$id_penjualan);
				$row = $pisah[3] + 1;
			}
			$date = date('m/Y');
			$split = explode('/', $date);
			$bulan = $split[0];
			$tahun = $split[1];
			$id_penjualan_baru = "PEN/".$bulan."/".$tahun."/".$row;
			$barang_sudah_ada = array();
			$id_barang_ada = array();
			$confirm_tambah_barang = $request->confirm_tambah_barang ?: 0;
			
			foreach($detail_penjualan as $item){
				$ambil_barang_sebelumnya  = tempDtlPenjualan::where('id_barang',$item->id_barang)->first();	
				if($ambil_barang_sebelumnya){	
					if(!$confirm_tambah_barang){
						array_push($id_barang_ada,$item->id_barang);
						array_push($barang_sudah_ada,$item->nama_barang);
					}else{
						$total_barang_sebelumnya = $ambil_barang_sebelumnya->jumlah_barang; 
						$jumlah_barang = $total_barang_sebelumnya + $item->jumlah_barang;
						$ambil_barang_sebelumnya->where('id_barang',$item->id_barang)->update(['jumlah_barang' => $jumlah_barang]);
					}
				}else{
					tempDtlPenjualan::insert([
						'id_penjualan' => $id_penjualan_baru,
						'id_barang' => $item->id_barang,
						'nama_barang' => $item->nama_barang,
						'harga_barang' => $item->harga_barang,
						'diskon' => $item->diskon,
						'jumlah_barang' => $item->jumlah_barang,
						'jenis_barang' => $item->jenis_barang,
						'satuan' => $item->satuan
					]);
				}
			}
			if(!$confirm_tambah_barang && count($barang_sudah_ada)){
			 	return redirect()->back()->withPermission('Barang sudah ada di keranjang jual ! Apakah anda masih ingin menambahkan barang tersebut ? \n Barang :'.implode(', ',$barang_sudah_ada))->withItems($id_barang_ada)->withPreviousCmd($btn);
			}			
			return redirect()->back()->withStatus('Data berhasil dipindahkan');
		}else if($btn == "retur_item"){
			$id_penjualan = urldecode($id_penjualan);	
			$cek_retur = returPenjualan::where('id_penjualan',$id_penjualan)->get();
			if(count($cek_retur) != 0){
				return redirect('adm/nota-penjualan/')->with(["status"=>"Data sudah pernah diretur", "judul_alert" => "Perhatian !" , "icon" => "error"]);
			}
			$id_barang = $request->id_barang;
			$all_retur_penjualan = DetailReturPenjualan::get();
			$all_penjualan = Penjualan::get();
			$detail_penjualan = DetailPenjualan::where('id_penjualan',$id_penjualan )->whereIn('id_barang',$id_barang)->get();
			$barang_sudah_ada = array();
			$id_barang_ada = array();
	
			foreach($detail_penjualan as $d_p){
				array_push($id_barang_ada,$d_p->id_barang);
				array_push($barang_sudah_ada,$d_p->nama_barang);
			
				DetailReturPenjualan::insert([
					'id_retur' => $id_penjualan,
					'id_barang' => $d_p->id_barang,
					'nama_barang' => $d_p->nama_barang,
					'jumlah_barang' => $d_p->jumlah_barang,
					'nominal_retur' => $d_p->harga_barang,
					'jenis_retur' => "-"
				]);        
			}
			return redirect('adm/nota-penjualan/retur/'.urlencode(urlencode($id_penjualan)));
		}
	}
	public function view_retur($id_penjualan){
        $id_penjualan = urldecode($id_penjualan);	
        $all_retur_penjualan = DetailReturPenjualan::where('id_retur',$id_penjualan)->get();
		$all_penjualan = Penjualan::where('id_penjualan',$id_penjualan)->join('tb_pelanggan','tb_pelanggan.id_toko_pelanggan','tb_penjualan.id_toko_pelanggan')->get();
        $data = [
            'title' => 'BMC | Retur Penjualan',
            'id_transaksi' => $id_penjualan,
            'all_retur_penjualan' => $all_retur_penjualan,
            'all_penjualan' => $all_penjualan
		];
		return view('pages.Retur.detailPenjualan',$data);
	}
	public function view(){
        $id_penjualan = $_POST['id_penjualan'];
        $all_retur_penjualan = DetailReturPenjualan::where('id_retur',$id_penjualan)->join('tb_penjualan','tb_penjualan.id_penjualan','dtlretur_penjualan.id_retur')->get();
        $data_penjualan = Penjualan::where('retur_penjualan.id_penjualan',$id_penjualan)->join('retur_penjualan','retur_penjualan.id_penjualan','tb_penjualan.id_penjualan')->join('tb_pelanggan','tb_pelanggan.id_toko_pelanggan','tb_penjualan.id_toko_pelanggan')->first();
		echo $data_penjualan;
        $jumlah_item = 0; $total_harga = 0;$row=1;
        foreach($all_retur_penjualan as $key => $arp){
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
        echo "###".json_encode($data_penjualan);
    }
	public function simpan_retur(){ 
        $status = $_POST['status'];
        $id_penjualan = $_POST['id_penjualan'];
		$jenis_retur = $_POST['jenis_retur'];
		$id_toko_pelanggan = $_POST['id_toko_pelanggan'];
        $jumlah_produk_retur = $_POST['jumlah_produk_retur'];
		$tanggal_retur = $_POST['tanggal_retur'];
        if($status == "Setuju"){
            $all_retur = returPenjualan::orderByRaw("SUBSTRING_INDEX(id_retur, '/', 3) ASC")->get();
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
				DetailReturPenjualan::where('id_barang',$data['id_barang'])->update(['jenis_retur'=>$data['jenis_retur']]);   
				echo $data['jenis_retur']; 
			}
            /*update jenis retur di detail retur*/

            $all_retur_penjualan = DetailReturPenjualan::where('id_retur',$id_penjualan)->get();
            foreach($all_retur_penjualan as $arp){
				$id_barang = $arp->id_barang;
				if($arp->jenis_retur  == "Retur Barang"){
					$stock_barang_db = Stock::select('stock_barang')->where('id_barang',$id_barang)->get();
					$stock_temp = DetailReturPenjualan::select('jumlah_barang')->where('id_retur', $id_penjualan)->where('id_barang',$id_barang)->get();
					$new_stock = $stock_barang_db[0]['stock_barang'] + $stock_temp[0]['jumlah_barang'];
					
					Stock::where('id_barang',$id_barang)->update(['stock_barang' => $new_stock]);
				}
            }
            Penjualan::where('id_penjualan',$id_penjualan)->update(['status' => 'Retur']);
            $split_tanggal = explode('/',$tanggal_retur);
            $new_tanggal_retur = $split_tanggal[2].'-'.$split_tanggal[1].'-'.$split_tanggal[0];
            returPenjualan::insert([
                'id_retur' => $id_retur,
                'id_penjualan' => $id_penjualan,
				'id_toko_pelanggan' => $id_toko_pelanggan,
				'jumlah_produk_retur' => $jumlah_produk_retur,
				'tanggal_retur' => $new_tanggal_retur
            ]);
            
        }else if($status == "Batal"){
            DetailReturPenjualan::where('id_retur', $id_penjualan)->delete();
        }
        //echo $_POST['status'];
    }
 public function hapus_retur($id_retur){
        $id_retur = urldecode($id_retur);
        returPenjualan::where('id_retur',$id_retur)->delete();
        DetailReturPenjualan::where('id_retur',$id_retur)->delete();

        return redirect('adm/retur-penjualan')->with(["status"=>"Retur berhasil dihapus", "judul_alert" => "Hapus" , "icon" => "success"]);;
    }
	public function simpan_pdf(Request $request){
		$id_penjualan = $request->id_penjualan;
		$all_penjualan = Penjualan::where('id_penjualan',urldecode($id_penjualan))->get();
		
		$all_detail_penjualan = DetailPenjualan::where('id_penjualan',urldecode($id_penjualan))->get()->chunk(12);
		$nama_toko = Pelanggan::where('id_toko_pelanggan',$all_penjualan[0]['id_toko_pelanggan'])->get();
	
		$data = [
			'title' => 'BMC | Detail Nota',
			'id_penjualan' => urldecode($id_penjualan),
			'all_penjualan' => $all_penjualan,
			'nama_toko' => $nama_toko,
			'all_detail_penjualan' => $all_detail_penjualan,
		];
		$pdf = PDF::loadView('pages.Penjualan.nota-info-pdf', $data);
		return $pdf->download('Invoice/'.$id_penjualan.'.pdf');		
	}

	public function preview_nota($id_penjualan){
		$id_penjualan = urldecode($id_penjualan);
		
	}
	public function cetak_nota(Request $request){
		$id_penjualan = $request->id_penjualan;
		$all_penjualan = Penjualan::where('id_penjualan',$id_penjualan)->get();
		
		$all_detail_penjualan = DetailPenjualan::where('id_penjualan',$id_penjualan)->get()->chunk(12);
		$nama_toko = Pelanggan::where('id_toko_pelanggan',$all_penjualan[0]['id_toko_pelanggan'])->get();
		
		$data = [
			'title' => 'BMC | Detail Nota',
			'id_penjualan' => $id_penjualan,
			'all_penjualan' => $all_penjualan,
			'nama_toko' => $nama_toko,
			'all_detail_penjualan' => $all_detail_penjualan,
		];
		$pdf = PDF::loadView('pages.Penjualan.nota-info-pdf', $data);
		
		$pdf = $pdf->output();
		$pdf = "data:application/pdf;base64,".base64_encode($pdf);
		return view('pages.Penjualan.nota-info-print',compact('pdf'));
	}
	public function detail(Request $request){			
		
	}
	public function detail_barang(){
		$id_barang = $_POST['id_barang'];
		echo json_encode(Stock::where('id_barang',$id_barang)->get());
	}
	public function cek_id(){
		$id_toko = $_POST['id_toko'];
		echo json_encode(Pelanggan::where('id_toko_pelanggan',$id_toko)->get());
	}
	public function filter(Request $request){
		$nama_toko =  $_POST['nama_toko'];
		$tanggal_order = $_POST['tanggal_order'];
		$tanggal_kirim = $request->tanggal_kirim;
		$status = $request->status;
		$data = Penjualan::join('tb_pelanggan','tb_pelanggan.id_toko_pelanggan','tb_penjualan.id_toko_pelanggan');
		if($nama_toko != ""){
			$data = $data->where('tb_pelanggan.nama_toko_pelanggan','like','%'.$nama_toko.'%');
		}
		if($status == "Retur"){
            $data = $data->where('tb_penjualan.status','Retur');
        }else if($status == "Diterima"){
            $data = $data->where('tb_penjualan.status','Diterima');
        }
		if($tanggal_order != ""){
			$data =$data->where('tb_penjualan.tanggal_order','like','%'.$tanggal_order.'%');
		}
		if($tanggal_kirim != ""){
			$data =$data->where('tb_penjualan.tanggal_kirim','like','%'.$tanggal_kirim.'%');
		}
		//$penjualan = Penjualan::join('tb_pelanggan','tb_pelanggan.id_toko_pelanggan','tb_penjualan.id_toko_pelanggan')->where('tb_pelanggan.nama_toko_pelanggan','like','%'.$nama_toko.'%')->get();
		$data = $data->get();
		$hasil = "";
		if(count($data)){
			foreach($data as $key => $ap){
				$hasil .= '
				<tr> 
					<td> '.$ap->id_penjualan.' </td>
					<td> '.$ap->tanggal_order.' </td>
					<td> '.$ap->tanggal_kirim.' </td>
					<td> '.$ap->nama_toko_pelanggan.' </td>
					<td> '.$ap->metode_pembayaran.' </td>
					<td> '.$ap->diskon.'% </td>	
					<td> '.number_format($ap->total_harga,0,',','.').' </td>
					<td>
						<a href="'.asset('/adm/nota-penjualan/edited').'/'.urlencode(urlencode($ap->id_penjualan)).'"  class="float-left btn btn-warning ml-1 text-white"> <i class="fas fa-pencil-alt"></i> </a>
						<button onclick="hapus('."'".urlencode(urlencode($ap->id_penjualan))."'".')" class="float-left btn btn-danger ml-1"> <i class="fas fa-trash-alt"></i> </button>
						<a href="'.asset('/adm/nota-penjualan').'/'.urlencode(urlencode($ap->id_penjualan)).'" class="float-left btn btn-primary ml-1"> <i class="fas fa-info-circle"></i> </a>
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
	public function items(){
		$id_penjualan = $_POST['id_penjualan'];
		$id_barang = isset($_POST['id_barang']) ? $_POST['id_barang'] : "";
		$cmd = isset($_POST['cmd']) ? $_POST['cmd'] : "";
		if($cmd != ""){
			if($cmd == "delete"){
				tempDtlPenjualan::where('id_barang',$id_barang)->where('id_penjualan',$id_penjualan)->delete();
			}else{
				$nama_barang = $_POST['nama_barang'];
				$harga_barang = $_POST['harga_barang'];
				$diskon = $_POST['diskon'];
				$jumlah_barang = $_POST['jumlah'];
				
				$jenis_barang =  Stock::select('jenis_barang')->where('id_barang',$id_barang)->get();
				$stock_saat_ini = Stock::where('id_barang',$id_barang)->value('stock_barang');
				$satuan = Stock::select('satuan')->where('id_barang',$id_barang)->get();
				if($cmd== "add"){
					$ambil_barang_sebelumnya  = tempDtlPenjualan::where('id_barang',$id_barang)->where('id_penjualan',$id_penjualan)->first();
					if($ambil_barang_sebelumnya){
						$total_barang_sebelumnya = $ambil_barang_sebelumnya->jumlah_barang; 
						$jumlah_barang = $total_barang_sebelumnya + $jumlah_barang; 
						
						if($stock_saat_ini < $jumlah_barang){
							return "Error###Stock barangi tidak mencukupi. Total stock untuk barang ini : ".$stock_saat_ini;
						}
						$ambil_barang_sebelumnya->where('id_barang',$id_barang)->where('id_penjualan',$id_penjualan)->update(['jumlah_barang' => $jumlah_barang]); 
					}else{
						if($stock_saat_ini < $jumlah_barang){
							return "Error###Stock barang tidak mencukupi. Total stock untuk barang ini : ".$stock_saat_ini;
						}
						tempDtlPenjualan::insert([
							'id_penjualan' => $id_penjualan,
							'id_barang' => $id_barang,
							'nama_barang' => $nama_barang,
							'harga_barang' => $harga_barang,
							'diskon' => $diskon,
							'jumlah_barang' => $jumlah_barang,
							'jenis_barang' => $jenis_barang[0]['jenis_barang'],
							'satuan' => $satuan[0]['satuan']
						]);
					}
				}else if($cmd == "edit"){
					tempDtlPenjualan::where('id_barang',$id_barang)->where('id_penjualan',$id_penjualan)->update([
						'id_penjualan' => $id_penjualan,
						'nama_barang' => $nama_barang,
						'harga_barang' => $harga_barang,
						'diskon' => $diskon,
						'jumlah_barang' => $jumlah_barang,
						'jenis_barang' => $jenis_barang[0]['jenis_barang'],
						'satuan' => $satuan[0]['satuan']
					]);
				}
			}
		}
		$all_temp = tempDtlPenjualan::where('id_penjualan',$id_penjualan)->get();
		return view('pages.Penjualan.detail',['all_temp_dtl_penjualan' => $all_temp]);
	}
	public function retur_penjualan(){
		$all_retur_penjualan = returPenjualan::get();
        $data = [
            'title' => 'BMC | Retur Penjualan',
            'all_retur_penjualan' => $all_retur_penjualan
        ];
        return view('pages.Retur.returPenjualan',$data);
	}

}
