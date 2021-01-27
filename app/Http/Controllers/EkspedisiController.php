<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekspedisi;

class EkspedisiController extends Controller
{
    public function index(){
        $all_ekspedisi = Ekspedisi::get();
        $data = [
            'title' => 'BMC | Ekspedisi',
            'all_ekspedisi' => $all_ekspedisi
        ];
        return view('pages.Ekspedisi.index',$data);
    }

    public function simpan_data(Request $request)
    {
        Ekspedisi::create($request->all());
        return redirect()->route('ekspedisi.index')->with(["status"=>"Ekspedisi berhasil dibuat", "judul_alert" => "Simpan"]);
    }
    public function ambil_data(){
        $id_ekspedisi = $_POST['id_ekspedisi'];
        echo json_encode(Ekspedisi::where('id_ekspedisi',$id_ekspedisi)->get());
    }
    public function ambil_id(){
        $all_ekspedisi = Ekspedisi::get();
        $row = $all_ekspedisi->count();
        if($row == 0){
            $row = 1;
        }else{
            foreach($all_ekspedisi as $ae){
                $id_ekspedisi = $ae->id_ekspedisi;
                $split = explode('/', $id_ekspedisi);
                $row = $split[2] +1;
            } 
        }
        echo json_encode('EKS/BMC/'.$row);
    }
    public function edit_data(Request $req){
        $id_ekspedisi = $req->input('id_ekspedisi');
        // $data = Ekspedisi::find($id_ekspedisi);
        // $data->nama_ekspedisi = $req->nama_ekspedisi;
        // $data->alamat = $req->alamat;
        // $data->no_telp = $req->no_telp;
        // $data->save();
        Ekspedisi::find($id_ekspedisi)->update($req->all());
        return redirect()->route('ekspedisi.index')->with(["status"=>"Ekspedisi berhasil diubah", "judul_alert" => "Edit"]);
    }
    public function hapus_data(Request $req){
        $id_ekspedisi = $req->id_ekspedisi;
        Ekspedisi::find($id_ekspedisi)->delete();
        return redirect()->route('ekspedisi.index')->with(["status" => "Ekspedisi berhasil dihapus", "judul_alert" => "Delete"]);
    }
}
