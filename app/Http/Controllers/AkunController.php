<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AkunController extends Controller
{
    public function index(){
      $akun = User::get();
		// BIAR GA BISA KE AKUN

      if(auth()->check()) {
        if(auth()->user()->level != "Super Admin"){
        return redirect('/adm/login');
        }
    }
    $data = [
        'title' => 'BMC | Penerima Barang',
        'akun' => $akun
    ];

    return view('pages.Akun.index',$data);
}
public function update(Request $request){
   $user = User::find($request->id_akun);
   $user->nama_akun = $request->nama_akun;
   $user->email_akun = $request->email_akun;
   $user->no_hp = $request->no_hp;
   $user->username = $request->username;
   $user->password = \Hash::make($request->password);
   if($request->hasFile('foto')){
    $ext = $request->file('foto')->extension();
    $url = Storage::disk('public')->putFileAs('profil',$request->file('foto'),$request->id_akun.'.'.$ext);
    $user->foto = $url;  
}
$user->save();
return redirect()->route('akun.index')->withMessage("Akun telah berhasil diupdate");
}
public function update_profile(Request $request){
   $user = auth()->user();
   $user->nama_akun = $request->nama_akun;
   $user->email_akun = $request->email_akun;
   $user->no_hp = $request->no_hp;
   $user->username = $request->username;
   $user->password = \Hash::make($request->password);
   $user->save();
   return redirect()->back()->withMessage("Akun telah berhasil diupdate");
}
public function delete($id){
   User::find($id)->delete();
   return redirect()->route('akun.index')->withMessage("Akun telah berhasil dihapus");
}
}
