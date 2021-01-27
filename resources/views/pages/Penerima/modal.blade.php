{{-- Modal Create --}}
<div class="modal fade" id="penerimaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">   </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="container">
                        <form action="{{url('/adm/penerima/simpan_data')}}" method="POST">
                            @csrf
                            <div class="row form-group">
                                <div class="col-xl-6">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <label for="id_barang"> ID Penerima </label>
                                        </div>
                                        <div class="col-xl-8">
                                            <input type="text" readonly class="form-control" id="id_penerima"  name="id_penerima" placeholder="ID Penerima">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="row ">
                                        <div class="col-xl-4">
                                            <label for="id_barang"> Penerima  </label>
                                        </div>
                                        <div class="col-xl-8">
                                            <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" placeholder="Nama Penerima">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xl-6">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <label for="id_barang"> No HP </label>
                                        </div>
                                        <div class="col-xl-8">
                                            <input type="text"  class="form-control" id="no_hp" name="no_hp" placeholder="No HP">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="row ">
                                        <div class="col-xl-4">
                                            <label for="id_barang"> Alamat  </label>
                                        </div>
                                        <div class="col-xl-8">
                                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xl-6">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <label for="id_barang"> Provinsi </label>
                                        </div>
                                        <div class="col-xl-8">
                                            <select name="provinsi" id="provinsi" class="form-control">
                                                <option value="-"> Pilih Provinsi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="row ">
                                        <div class="col-xl-4">
                                            <label for="id_barang"> Kota </label>
                                        </div>
                                        <div class="col-xl-8">
                                            <select name="kota" id="kota" class="form-control">
                                                <option value="-"> Pilih Kota </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xl-6">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <label for="id_barang"> Kode Pos </label>
                                        </div>
                                        <div class="col-xl-8">
                                            <input type="number" class="form-control" id="kode_pos" name="kode_pos" placeholder="Kode Pos">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>   
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Simpan Data  </button>
            </div>
        </form>
        </div>
    </div>
</div>

{{-- Modal Edit --}}