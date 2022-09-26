<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\AdmissionInfo;
use App\Models\ExistingStudent;
use App\Service\MenuService;
use DB;
use App\SSP;

class HomeController extends Controller
{
    
    
    public function dashboard(Request $request)
    {   
        return view('admin.dashboard');

    }

}
