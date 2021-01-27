{{-- Modal Create --}}
<div class="modal fade" id="tokoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="container">
                        <form action="{{url('/adm/toko/simpan_data')}}" method="POST">
                            @csrf
                            <div class="row form-group">
                                <div class="col-xl-6">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <label for="id_barang"> ID Toko </label>
                                        </div>
                                        <div class="col-xl-8">
                                            <input type="text" readonly class="form-control" id="id_toko_pelanggan"  name="id_toko_pelanggan" placeholder="ID Toko">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="row ">
                                        <div class="col-xl-4">
                                            <label for="id_barang"> Nama Toko </label>
                                        </div>
                                        <div class="col-xl-8">
                                            <input type="text" class="form-control" id="nama_toko_pelanggan" name="nama_toko_pelanggan" placeholder="Nama Toko">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xl-6">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <label for="id_barang"> Penanggung Jawab </label>
                                        </div>
                                        <div class="col-xl-8">
                                            <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" placeholder="Penanggung Jawab">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="row ">
                                        <div class="col-xl-4">
                                            <label for="id_barang"> Alamat Toko </label>
                                        </div>
                                        <div class="col-xl-8">
                                            <input type="text" class="form-control" id="alamat_toko_pelanggan" name="alamat_toko_pelanggan" placeholder="Alamat Toko">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xl-6">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <label for="id_barang"> No Telp </label>
                                        </div>
                                        <div class="col-xl-8">
                                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No Telepon">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="row ">
                                        <div class="col-xl-4">
                                            <label for="id_barang"> Pembelian Ke  </label>
                                        </div>
                                        <div class="col-xl-8">
                                            <input type="number" value="0" readonly class="form-control" id="pembelian_ke" name="pembelian_ke" placeholder="0">
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