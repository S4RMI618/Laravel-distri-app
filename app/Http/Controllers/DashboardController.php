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
    
        // Contar las órdenes pendientes dependiendo del rol del usuario
        if ($user->role_id == 2) {
            // Si el rol del usuario es 2, contar solo sus órdenes pendientes
            $pendingOrdersCount = Order::where('user_id', $user->id)
                                       ->where('status', 'pendiente')
                                       ->count();
        } else {
            // Si el usuario es administrador, contar las órdenes pendientes de todos los usuarios de la misma empresa
            $userIdsInCompany = User::where('company_id', $user->company_id)->pluck('id');
            $pendingOrdersCount = Order::whereIn('user_id', $userIdsInCompany)
                                       ->where('status', 'pendiente')
                                       ->count();
        }
    
        return view('dashboard', compact('user', 'customerCount', 'productCount', 'pendingOrdersCount'));
    }
}
