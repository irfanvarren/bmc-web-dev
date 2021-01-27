<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama_akun' => ['required', 'string', 'max:255'],
            'email_akun' => ['required', 'string', 'email', 'max:255', 'unique:tb_akun'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

     /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
       if(User::where('email_akun',$request->email_akun)->first()){
        return redirect()->route('akun.index')->withMessage('Akun dengan email tersebut sudah ada !');
        }
        event(new Registered($user = $this->create($request)));
        
        // $this->guard()->login($user);
    
        if ($response = $this->registered($request, $user)) {
            return $response;
        }
         return $request->wantsJson()
                     ? new JsonResponse([], 201)
                    // : redirect($this->redirectPath());
                     : redirect()->route('akun.index')->withMessage('Akun berhasil di tambahkan');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

    protected function create($data)
    {
  
        // dd($data);
        $user = User::create([
            'nama_akun' => $data['nama_akun'],
            'no_hp' => $data['no_hp'],
            'username' => $data['nama_akun'],
            'email_akun' => $data['email_akun'],
            'status' => 'OFFLINE',
            'level' => 'Admin',
            'password' => Hash::make($data['password']),
        ]);

        $id_user = $user->id_akun;
        if($data->hasFile('foto')){
            $ext = $data->file('foto')->extension();
            $url = Storage::disk('public')->putFileAs('profil',$data->file('foto'),$id_user.'.'.$ext);
            $user->foto = $url;
            $user->save();   
        }
        
        
        return $user;
    }


}
