<?php

namespace App\Http\Controllers;
// use Maatwebsite\Excel\Facades\Excel;

use App\Exports\UsersExport;
use App\Models\Order;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class ExportsController extends Controller
{
    public function export()
    {
        $users = User::all();
        // $orders = Order::all();
        // return Excel::store(new UsersExport($users), 'users.xlsx');
        (new UsersExport($users))->store('users.xlsx')->chain([
            // jobs to execute
        ]);
        return 'The Export has Started';
        // return (new UsersExport($users));
    }
}
