{{-- Modal Create --}}
<div class="modal fade" id="ekspedisiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{url('/adm/ekspedisi/simpan_data')}}" method="POST">
                    @csrf
                    <table>
                        <tr>
                            <td> ID Ekspedisi </td>
                            <td class="pl-5"> <input type="text" id="id_ekspedisi" name="id_ekspedisi" readonly placeholder="ID Ekspedisi" class="form-control "> </td>
                        </tr>
                        <tr>
                            <td> Nama Ekspedisi </td>
                            <td class="pl-5"> <input type="text" id="nama_ekspedisi" name="nama_ekspedisi" placeholder="Nama Ekspedisi" class="form-control "> </td>
                        </tr>
                        <tr>
                            <td> Alamat </td>
                            <td class="pl-5"> <input type="text" id="alamat" name="alamat" placeholder="Alamat Ekspedisi" class="form-control "> </td>
                        </tr>
                        <tr>
                            <td> No Hp </td>
                            <td class="pl-5"> <input type="text" id="no_telp" name="no_telp" placeholder="No Hp" class="form-control "> </td>
                        </tr>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Simpan Data  </button>
            </div>
            </form>
        </div>
    </div>
</div>