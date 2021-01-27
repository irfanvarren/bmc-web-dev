<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\DetailReturPenjualan;
use App\Models\DetailReturPembelian;
use App\Models\Stock;
class dashboardController extends Controller
{
    public function index(){
        $date = date('D/d/M/Y');
        $split = explode('/', $date);
        $hari = $split[0];
        $tanggal = $split[1];
        $bulan = $split[2];
        $tahun = $split[3];
        switch($hari){
            case "Mon" :
                $hari = "Senin";
                break;
            case "Tue" :
                $hari = "Selasa";
                break;
            case "Wed" :
                $hari = "Rabu";
                break;
            case "Thur" :
                $hari = "Kamis";
                break;
            case "Fri" :
                $hari = "Jumat";
                break;
            case "Sat" :
                $hari = "Sabtu";
                break;
            case "Sun" :
                $hari = "Minggu";
                break;
        }
        switch($bulan){
            case "Jan" :
                $bulan = "Januari";
                break;
            case "Feb" :
                $bulan = "Februari";
                break;
            case "Mar" :
                $bulan = "Maret";
                break;
            case "Apr" :
                $bulan = "April";
                break;
            case "May" :
                $bulan = "Mei";
                break;
            case "Jun" :
                $bulan = "Juni";
                break;
            case "Jul" :
                $bulan = "Juli";
                break;
            case "Aug" :
                $bulan = "Agustus";
                break;
            case "Sep" :
                $bulan = "September";
                break;
            case "Okt" :
                $bulan = "Oktober";
                break;
            case "Nov" :
                $bulan = "November";
                break;
            case "Des" :
                $bulan = "Desember";
                break;
        }
        $penjualan = Penjualan::count();
        $pembelian = Pembelian::count();
        $retur_penjualan = DetailReturPenjualan::count();
        $retur_pembelian = DetailReturPembelian::count();
        $stock = Stock::count();
        $data = [
            'title' => 'BMC | Dashboard',
            'waktu_tanggal' => $hari.", ".$tanggal." ".$bulan." ".$tahun,
            'penjualan' => $penjualan,
            'pembelian' => $pembelian,
            'retur_penjualan' => $retur_penjualan,
            'retur_pembelian' => $retur_pembelian,
            'stock' => $stock
        ];
        return view('pages.Dashboard.index', $data);
    }

    public function statistik(){
        $current_year = date("Y");
        $penjualan = array();
        $pembelian = array();
        for($month = 1; $month <= 12; $month++){
        $total_penjualan = DetailPenjualan::selectRaw('sum(harga_barang * jumlah_barang) as total')->whereRaw('substring_index(substring_index(id_penjualan,"/",-2),"/",1) = '.$current_year)->whereRaw('substring(id_penjualan,5,2) = '.$month)->value('total') ?: 0;
        $total_pembelian = DetailPembelian::selectRaw('sum(harga_barang * jumlah_barang) as total')->whereRaw('substring_index(substring_index(id_pembelian,"/",-2),"/",1) = '.$current_year)->whereRaw('substring(id_pembelian,5,2) = '.$month)->value('total') ?: 0;
        array_push($penjualan,$total_penjualan);
        array_push($pembelian,$total_pembelian);
        }
        return view('pages.Dashboard.statistik',compact('penjualan','pembelian'));
    }
}
