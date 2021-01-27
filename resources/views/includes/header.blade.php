<div class="row" >
    <div class="col-lg-2 float-left" id="logo">
        <div style="padding:11px 0;">
            <img src="<?= asset('/img/BMC.png') ?>" class="h-50 w-55 float-left" alt="BMC" >
            <font class="h3"> B.M.C </font> 
        </div>
    </div>
    <div class="col-lg-10 float-left bg-blue-gray" id="header">
        <div class="col-lg-6 float-left">
            <div class="col-lg-1 hide-menu float-left cr-pointer" id="menu">
                <i class="fas fa-bars pt-3 h2 text-white"></i> 
            </div>
            <div class="col-lg-8 col-12 float-left">
              <input type="text" class="form-control mt-3" placeholder="Search">
          </div>
      </div>
      <div class="col-lg-6 pt-2 hide float-left text-white">
        <div class="float-right position-relative pt-2 pr-3 username">
            
            
        <img src="<?= auth()->check() ? file_exists(public_path('storage/'.auth()->user()->foto)) && auth()->user()->foto != "" ? asset('storage/'.auth()->user()->foto) : asset('/img/User Transparent.png') : asset('/img/User Transparent.png') ?>" class="h-40 w-40" alt="User" >
          <font> Halo , {{auth()->check() ? auth()->user()->username : "Guest"}} </font>
          <div class="logout-wrapper"><a href="{{route('logout')}}">Logout</a></div>
      </div>
      <div class="float-right pt-3 pr-3">
          <font>
            <!-- {{\Carbon\Carbon::now()->format("l, d F y")}} ini jgn dihapus -->
            {{\Carbon\Carbon::now()->isoFormat('dddd, DD MMMM Y')}}  
        </font>
    </div>
</div>
</div>
</div>