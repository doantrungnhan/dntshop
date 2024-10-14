<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Banner;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Carbon\Carbon;

class dashboardController extends Controller
{

    public function index()
    {
        return view('admin.dashboard');
    }

}
