<div class="modal" tabindex="-1" role="dialog" id="pembelianModal">
    <div class="modal-dialog  modal-xl" role="document" >
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fas fa-info-circle"></i> Info Retur </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">     
                <div class="container">
                    <div class="row info-retur">
                    <div class="col-lg-4 float-left pb-4">
                        <table>
                            <tr>
                                <th> No Transaksi </th>
                                <th class="no_transaksi"> : <span id="id-transaksi"></span>  </th>
                            </tr>
                            <!-- no transaksi, tannga order, nama toko, alamat toko,ekspedisi, username -->
                            <tr style="font-size: 14px">
                                <td> Tanggal </td>
                                <td> : <span id="tanggal-order"></span> </td>
                            </tr>
                            <tr style="font-size: 14px">
                                <td> Cash / Kredit </td>
                                <td> : <span id="metode-pembayaran"></span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4">
                         <table>
                            <tr style="font-size: 14px;">
                                <td> Nama Toko </td>
                                <td> : <span id="nama-toko"></span>  </td>
                            </tr>
                            <tr style="font-size: 14px">
                                <td> Alamat Toko </td>
                                <td> : <span id="alamat-toko"></span> </td>
                            </tr>
                            <tr style="font-size: 14px">
                                <td> Ekspedisi </td>
                                <td> : <span id="ekspedisi"></span></td>
                            </tr>
                        </table>
                    </div>
                     <div class="col-lg-4">
                         <table>
                            
                            <tr style="font-size: 14px;">
                                <td> Penerima </td>
                                <td> : <span id="penerima"></span>  </td>
                            </tr>
                            <tr style="font-size: 14px;">
                                <td> No. HP Penerima </td>
                                <td> : <span id="no-hp-penerima"></span>  </td>
                            </tr>
                            <tr style="font-size: 14px;">
                                <td> Username </td>
                                <td> : <span id="username"></span>  </td>
                            </tr>
                        </table>
                    </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" style="text-align:center">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> ID Barang </th>
                                    <th> Nama Barang </th>
                                    <th> Jumlah Barang </th>
                                    <th> Nominal Retur </th>
                                    <th> Jenis Retur </th>
                                </tr>
                            </thead>
                            <tbody class="isi_retur">
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>