
<table class="table table-bordered w-100" id="demo-table">
    <thead>
        <tr>
            <th> ID Barang </th>
            <th> Nama Barang </th>
            <th> Jenis Barang </th>
            <th> Satuan </th>
            <th> Harga Barang </th> 
            <th> Diskon </th>
            <th> Jumlah </th>
            <th> Subtotal </th>
            <th> Action </th>
        </tr>
    </thead>
    <tbody>
        <!-- ini detail pembelian -->
         @php
        $subtotal = 0;
        @endphp
        @if(count($all_temp_dtl_penjualan) == 0)
            <tr>
                <th colspan="9">Belum ada barang yang ditambahkan ke keranjang</th>
            </tr>
        @else
            @foreach($all_temp_dtl_penjualan as $a_t_d_p)
            <?php
            $kurang_diskon = ($a_t_d_p->harga_barang * $a_t_d_p->jumlah_barang)*($a_t_d_p->diskon/100);
            $jumlah = ($a_t_d_p->harga_barang * $a_t_d_p->jumlah_barang) - $kurang_diskon;
            $subtotal+=$jumlah;
            $new_harga = number_format($a_t_d_p->harga_barang,0,',','.');
            ?>
            <tr>
                <td> {{$a_t_d_p->id_barang}} </td>
                <td> {{$a_t_d_p->nama_barang}} </td>
                <td> {{$a_t_d_p->jenis_barang}} </td>
                <td> {{$a_t_d_p->satuan}}</td>
                <td> {{$new_harga}} </td>
                <td> {{$a_t_d_p->diskon."%"}}</td>
                <td> {{$a_t_d_p->jumlah_barang}} </td>
                <td> {{number_format($jumlah,0,',','.')}}</td>
                <td>
                    <a href="javascript:void(0)" onclick="edit_barang('{{$a_t_d_p->id_barang}}','{{$a_t_d_p->nama_barang}}','{{$a_t_d_p->harga_barang}}','{{$a_t_d_p->diskon}}','{{$a_t_d_p->jumlah_barang}}')" class="btn btn-warning text-white" > <i class="fas fa-pencil-alt"></i> </a> 
                    <button class="btn btn-danger" type="button" onclick="hapus_barang('{{$a_t_d_p->id_barang}}')"> <i class="fas fa-trash-alt"></i> </button>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
###{{number_format($subtotal,0,',','.')}}