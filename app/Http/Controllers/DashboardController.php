<?php

namespace App\Http\Controllers;

use App\Models\CustomerDetail;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $customerCount = CustomerDetail::where('company_id', $user->company_id)->count();
        $productCount = Product::where('company_id', $user->company_id)->count();
    
        // Obtener todos los usuarios de la misma empresa
        $userIdsInCompany = User::where('company_id', $user->company_id)->pluck('id');
    
        // Contar las órdenes pendientes para esos usuarios
        $pendingOrdersCount = Order::whereIn('user_id', $userIdsInCompany)
                                   ->where('status', 'pendiente')
                                   ->count();
    
        return view('dashboard', compact('user', 'customerCount', 'productCount', 'pendingOrdersCount'));
    }
}
