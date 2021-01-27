<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Pelanggan;

class TokoController extends Controller
{
    public function index(){
        $all_pelanggan = Pelanggan::get();
        $data = [
            'title' => 'BMC | Ekspedisi',
            'all_pelanggan' => $all_pelanggan
        ];
        return view('pages.Toko.index',$data);
    }
    public function simpan_data(Request $request){
        Pelanggan::create($request->all());
        return redirect()->route('toko.index')->with(["status"=>"Toko berhasil dibuat", "judul_alert" => "Simpan"]);

    }
    public function ambil_data(){
        $id_pelanggan = $_POST['id_toko'];
        echo json_encode(Pelanggan::where('id_toko_pelanggan',$id_pelanggan)->get());
    }
    public function ambil_id(){
        $all_pelanggan = Pelanggan::get();
        $row = $all_pelanggan->count();
        if($row == 0){
            $row = 1;
        }else{
            foreach($all_pelanggan as $ap){
                $id_pelanggan = $ap->id_toko_pelanggan;
                $split = explode('/', $id_pelanggan);
                $row = $split[2] +1;
            } 
        }
        echo json_encode('TKO/BMC/'.$row);
    }
    public function edit_data(Request $req){
        $id_pelanggan = $req->input('id_toko_pelanggan');
        pelanggan::find($id_pelanggan)->update($req->all());
        return redirect('/adm/toko')->with(["status" => "Toko berhasil diedit", "judul_alert" => "Edit"]);
    }
    public function hapus_data(Request $req){
        $id_pelanggan =  $req->input('id_toko_pelanggan');
        Pelanggan::find($id_pelanggan)->delete();
        return redirect('/adm/toko')->with(["status" => "Toko berhasil dihapus", "judul_alert" => "Delete"]);
    }
}
