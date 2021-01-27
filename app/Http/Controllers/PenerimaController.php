<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerima;

class PenerimaController extends Controller
{
    public function index(){
        //$id_penerima = Penerima::first()->value('id_penerima');
        $all = Penerima::get();     
        $data = [
            'semua' => Penerima::paginate(10),
            'title' => 'BMC | Penerima Barang'
        ];
        return view('pages.Penerima.index',$data);
    }
    public function simpan_data(Request $req){
        // $id_penerima = $req->input('id_penerima');
        // $nama_penerima = $req->input('nama_penerima');
        // $no_hp = $req->input('no_hp');
        // $alamat = $req->input('alamat');
        // $provinsi = $req->input('provinsi');
        // $kota = $req->input('kota');
        // $kode_pos = $req->input('kode_pos');
        Penerima::create($req->all());
        return redirect('/adm/penerima');
    }
    public function ambil_data(){
        $id_penerima = $_POST['id_penerima'];
        echo json_encode(Penerima::where('id_penerima',$id_penerima)->get());
    }
    public function ambil_id(){
        $all_penerima = Penerima::get();
        $row = $all_penerima->count();
        if($row == 0){
            $row = 1;
        }else{
            foreach($all_penerima as $ap){
                $id_penerima = $ap->id_penerima;
                $split = explode('/', $id_penerima);
                $row = $split[2] +1;
            } 
        }
        echo json_encode('PEN/BMC/'.$row);
    }
    public function edit_data(Request $req){
        $id_penerima = $req->input('id_penerima');
        // $data = Ekspedisi::find($id_ekspedisi);
        // $data->nama_ekspedisi = $req->nama_ekspedisi;
        // $data->alamat = $req->alamat;
        // $data->no_telp = $req->no_telp;
        // $data->save();
        Penerima::find($id_penerima)->update($req->all());
        return redirect('/adm/penerima')->withStatus("Penerima berhasil diedit");
    }
    public function hapus_data(Request $req){
        $id_penerima = $req->input('id_penerima');
        Penerima::find($id_penerima)->delete();
        return redirect()->route('ekspedisi.index')->with(["status" => "Penerima berhasil dihapus", "judul_alert" => "Delete"]);
    }
}
