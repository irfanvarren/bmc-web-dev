<!-- Create Modal -->
<div class="modal" tabindex="-1" role="dialog" id="stockModal">
  <div class="modal-dialog  modal-xl" role="document" >
    <div class="modal-content">
        <form action="{{route('stock.store')}}" name="form-add" id="form-add" method="POST">
        @csrf
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
                                <select name="jenis_barang" id="jenis_barang" class="form-control">
                                    <option value="-"> --- PILIH --- </option>
                                    @foreach($all_jenis as $aj)
                                        <option value="{{$aj->jenis_barang}}"> {{$aj->jenis_barang}}</option>
                                    @endforeach
                                </select>
                                
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
                <button class="btn btn-primary"> <i class="fas fa-save"></i> Simpan Data</button>
            </div>
        </form>
    </div>
  </div>
</div>
{{-- Edited Modal --}}
<div class="modal" tabindex="-1" role="dialog" id="editStockModal">
  <div class="modal-dialog modal-xl" role="document" >
    <div class="modal-content">
        <form action="{{route('stock.update')}}" name="form-edit" id="form-edit" method="POST">
        @method('PUT')
        @csrf
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-pencil-alt"> </i> Edit Stock</h5>
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
                                <input type="text" class="form-control" readonly id="id_barang" name="id_barang" placeholder="Id Barang">
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
                <button class="btn btn-primary"> <i class="fas fa-pencil-alt"> </i>Edit Data</button>
            </div>
      </form>
    </div>
  </div>
</div>
<!-- Category Modal -->
<div class="modal" tabindex="-1" role="dialog" id="jenisModal">
  <div class="modal-dialog l" role="document" >
    <div class="modal-content">
        <form action="{{asset('/adm/jenis-barang')}}"  method="POST">
        @csrf
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus-circle"></i> Tambah Jenis Barang </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">     
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="id_jenis_barang">Id Jenis Barang</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" value="{{$data}}" readonly id="id_jenis_barang" name="id_jenis_barang" placeholder="Id Barang">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 pt-2">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="jenis_barang">Jenis Barang</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" placeholder="Jenis Barang">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit"> <i class="fas fa-save"></i> Simpan Data</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- View Data -->
<div class="modal" tabindex="-1" role="dialog" id="viewjenisModal">
    <div class="modal-dialog l" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> <i class="fas fa-box-open h3"></i> Jenis Barang </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">     
                <div class="row form-group">
                   <div class="container table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th> ID Jenis Barang </th>
                                <th> Jenis Barang </th>
                            </tr>
                            @foreach($all_jenis as $aj)
                                <tr>
                                    <td> {{$aj->id_jenis}} </td>
                                    <td> {{$aj->jenis_barang}} </td>
                                </tr>
                            @endforeach
                        </table>
                   </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times-circle"></i> Close</button>
            </div>
        </div>
    </div>
</div>