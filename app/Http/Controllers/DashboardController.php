<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function home()
  {
    return view('dashboard.home');
  }

  public function matches()
  {
    return view('dashboard.matches');
  }
}
