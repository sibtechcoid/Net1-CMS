<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\UserController;

class FrontEndController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    /*
     * $user_activation set to false makes the user activation via user registered email
     * and set to true makes user activated while creation
     */
    // private $user_activation = false;



    public function getModals()
    {
        return view('admin.modals')->with('userInfo', UserController::getSlightInfo());
    }

    public function getSweetalert() {
        return view('admin.sweetalert')->with('userInfo', UserController::getSlightInfo());
    }

    public function getTagsinput() {
        return view('admin.tagsinput')->with('userInfo', UserController::getSlightInfo());
    }

    public function getToastr() {
        return view('admin.toastr')->with('userInfo', UserController::getSlightInfo());
    }

    public function getNotifications() {
        return view('admin.notifications')->with('userInfo', UserController::getSlightInfo());
    }

    public function getButtons() {
        return view('admin.buttons')->with('userInfo', UserController::getSlightInfo());
    }

}
