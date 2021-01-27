<table class="table table-bordered w-100 mt-3" id="demo-table" style="text-align: center">
    <thead>
        <tr>
            <th> ID Barang </th>
            <th> Nama Barang </th>
            <th> Jumlah </th>
            <th> Satuan </th>
            <th> Jenis Barang </th>
            <th> Kondisi </th> 
            <th> Harga Barang </th>
            <th> Total Harga </th>
            <th> Action </th>
        </tr>
    </thead>
    <tbody>
       <!-- ini detail pembelian -->
       <?php $subtotal = 0;?>
       @if(count($all_temp_dtl_pembelian) == 0)
           <tr>
               <th colspan="9" style="text-align: left">Belum ada barang yang ditambahkan ke keranjang</th>
           </tr>
       @else
           @foreach($all_temp_dtl_pembelian as $a_t_d_p)
           <tr>
               <td> {{$a_t_d_p->id_barang}} </td>
               <td> {{$a_t_d_p->nama_barang}} </td>
               <td> <center> {{$a_t_d_p->jumlah_barang}} </center></td>
               <td> {{$a_t_d_p->satuan}}</td>
               <td> {{$a_t_d_p->jenis_barang}} </td>   
               <td> {{$a_t_d_p->kondisi}} </td>
               <td> {{number_format($a_t_d_p->harga_barang,0,',','.')}} </td>
               <td> {{number_format($a_t_d_p->harga_barang*$a_t_d_p->jumlah_barang,0,',','.')}} </td>
               <td>
                   <a href="javascript:void(0)" onclick="edit_barang('{{$a_t_d_p->id_barang}}','{{$a_t_d_p->nama_barang}}','{{$a_t_d_p->jumlah_barang}}','{{$a_t_d_p->satuan}}','{{$a_t_d_p->jenis_barang}}','{{$a_t_d_p->kondisi}}','{{$a_t_d_p->harga_minimal}}','{{$a_t_d_p->harga_maximal}}')" class="btn btn-warning text-white" > <i class="fas fa-pencil-alt"></i> </a> 
                   <button class="btn btn-danger" type="button" onclick="hapus_barang('{{$a_t_d_p->id_barang}}')"> <i class="fas fa-trash-alt"></i> </button>
               </td>
           </tr>
           <?php 
           $harga_barang = $a_t_d_p->jumlah_barang*$a_t_d_p->harga_barang;
           $subtotal+= $harga_barang ;
           ?>
           @endforeach
       @endif
    </tbody>
</table>
###{{number_format($subtotal,0,',','.')}}