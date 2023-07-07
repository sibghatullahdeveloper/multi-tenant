<?php


namespace App\Modules\V1\Commons\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\V1\Users\Models\User;
use App\Modules\V1\Commons\Services\AuthService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $authServices;

    public function __construct(AuthService $authService) {
         $this->authServices = $authService;
    }
    public function getDashboardView()
    {
        return view('Commons::dashboard.index',[
            'sidebar' => $this->authServices->getSideBar(),
        ]);
    }
}
