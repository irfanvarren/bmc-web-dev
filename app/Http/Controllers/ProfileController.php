<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $all_profile = auth()->user();
        $data = [
            'title' => 'BMC | Profile',
            'all_profile' => $all_profile
        ];
        return view('pages.Profile.index',$data);
    }
}
