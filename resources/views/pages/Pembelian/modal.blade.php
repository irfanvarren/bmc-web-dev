{{-- Save Barang --}}
<div class="modal" tabindex="-1" role="dialog" id="stockModal">
    <div class="modal-dialog  modal-xl" role="document" >
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fas fa-plus-circle"></i> Tambah Stock</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">     
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang">Id Barang</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="id_barang" name="id_barang" placeholder="Id Barang">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang">Nama Barang</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang">Stock Barang</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="number" class="form-control" id="stock_barang" name="stock_barang" placeholder="Stock Barang">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang">Jenis Barang</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" placeholder="Jenis Barang">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang">Harga Minimal</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="number" class="form-control" id="harga_minimal" name="harga_minimal" placeholder="Harga Minimal">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang">Harga Maximal</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="number" class="form-control" id="harga_maximal" name="harga_maximal" placeholder="Harga Maximal">
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_barang"> Satuan </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="add_items"> <i class="fas fa-save"></i> Simpan Data</button>
            </div>
        </div>
    </div>
</div>