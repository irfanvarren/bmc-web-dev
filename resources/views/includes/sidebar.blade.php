
    <div class="float-left bg-blue-gray cr-pointer text-white " id="side_bar">
        <a class="row d-block bg-blue-gray cr-pointer shadow" href="{{route('dashboard')}}">
            <div class="p-3">
                <i class="fas fa-tachometer-alt h5"></i>
                <font class="h5 pl-2"> Dashboard </font>
            </div>
        </a>
        <a class="row d-block bg-blue-gray cr-pointer shadow" href="#" id="pembelian">
            <div class="p-3">
                <i class="fas fa-shopping-cart h5"></i>
                <font class="h5 pl-2"> Pembelian </font>
            </div>
        </a>
        <a class="row bg-danger shadow" id="nota_pembelian" style="display: none" href="{{url('/adm/nota-pembelian')}}">
            <div class="p-3 ml-2">
                <i class="fas fa-clipboard h5"></i>
                <font class="h5 pl-2"> Nota Pembelian </font>
            </div>
        </a>
        <a class="row bg-primary cr-pointer shadow" style="display: none" id="buat_nota_pembelian" href="{{route('pembelian')}}">
            <div class="p-3 ml-2">
                <i class="fas fa-folder-plus h5"></i>
                <font class="h5 pl-2"> Buat Nota  </font>
            </div>
        </a>
        <a href="#" class="row d-block bg-blue-gray cr-pointer shadow" id="penjualan">
            <div class="p-3">
                <i class="fas fa-coins h5"></i>
                <font class="h5 pl-2"> Penjualan </font>
            </div>
        </a>
        <a class="row bg-danger shadow" id="nota_penjualan" style="display: none" href="<?= url('/adm/nota-penjualan') ?>">
            <div class="p-3 ml-2">
                <i class="fas fa-clipboard h5"></i>
                <font class="h5 pl-2"> Nota Penjualan </font>
            </div>
        </a>
        <a class="row bg-primary cr-pointer shadow" style="display: none" id="buat_nota_penjualan" href="{{url('/adm/penjualan')}}">
            <div class="p-3 ml-2">
                <i class="fas fa-folder-plus h5"></i>
                <font class="h5 pl-2"> Buat Nota  </font>
            </div>
        </a>
        <div class="row bg-blue-gray cr-pointer shadow" id="retur">
            <div class="p-3">
                <i class="fas fa-exchange-alt h5"></i>
                <font class="h5 pl-2"> Retur </font>
            </div>
        </div>
        <a class="row bg-danger shadow" id="retur_penjualan" style="display: none" href="{{url('/adm/retur-penjualan')}}">
            <div class="p-3 ml-2">
                <i class="fas fa-exchange-alt h5"></i>
                <font class="h5 pl-2"> Retur Penjualan </font>
            </div>
        </a>
        <a class="row bg-warning shadow" id="retur_pembelian" style="display: none" href="{{url('/adm/retur-pembelian')}}">
            <div class="p-3 ml-2">
                <i class="fas fa-exchange-alt h5"></i>
                <font class="h5 pl-2"> Retur Pembelian </font>
            </div>
        </a>
        <a class="row d-block bg-blue-gray cr-pointer shadow" href="{{route('stock.index')}}">
            <div class="p-3">
                <i class="fas fa-box-open h5"></i>
                <font class="h5 pl-2"> Stock </font>
            </div>
        </a>
        <a class="row d-block bg-blue-gray cr-pointer shadow" href="{{url('/adm/ekspedisi')}}">
            <div class="p-3">
                <i class="fas fa-dolly-flatbed h5"></i>
                <font class="h5 pl-2"> Ekspedisi </font>
            </div>
        </a>
        <a class="row bg-blue-gray cr-pointer shadow" href="{{url('/adm/toko')}}">
            <div class="p-3">
                <i class="fas fa-store-alt h5"></i>
                <font class="h5 pl-2"> Toko Pelanggan </font>
            </div>
        </a>
        <a class="row bg-blue-gray cr-pointer shadow" href="{{url('/adm/penerima')}}">
            <div class="p-3">
                <i class="fas fa-handshake h5"></i>
                <font class="h5 pl-2"> Penerima </font>
            </div>
        </a>
        <a class="row bg-blue-gray cr-pointer shadow" href="{{url('/adm/profile')}}">
            <div class="p-3">
                <i class="fas fa-user-alt h5"></i>
                <font class="h5 pl-2"> Profile </font>
            </div>
        </a>
        @auth
        @if(auth()->user()->level == "Super Admin")
        <a class="row bg-blue-gray cr-pointer shadow" href="{{url('/adm/akun')}}">
            <div class="p-3">
                <i class="fas fa-user-plus h5"></i>
                <font class="h5 pl-2"> Akun </font>
            </div>
        </a>
        @endif
        @endauth
        <div class="row bg-blue-gray cr-pointer shadow">
            <div class="p-3">
                <i class="fas fa-sign-out-alt h5"></i>
                <font class="h5 pl-2"> Sign Out </font>
            </div>
        </div>
    </div>
    
   