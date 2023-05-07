<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\UsersExport;
use App\Models\Order;
use App\Models\User;

class ExportsController extends Controller
{
    public function export()
    {
        // $users = User::all();
        $orders = Order::all();
        return Excel::download(new UsersExport($orders), 'orders.xlsx');
    }
}
