<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\UsersExport;
use App\Imports\OrdersImport;
use App\Imports\UserImport;
use App\Models\Order;
use App\Models\User;

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

    public function import () {
        // Excel::import(new UserImport, 'Users_Import_1.xlsx');
        // (new UserImport())->import('Users_Import_1.xlsx');
        (new OrdersImport())->import('Users_Import_2.xlsx');
        return '1';
    }
}
