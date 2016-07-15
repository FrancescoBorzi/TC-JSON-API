<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AccountsController extends Controller
{
    public function index() {
        return \Auth::user();
    }
}
