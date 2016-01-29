<?php

namespace App\Http\Controllers\admin;

use App\Command;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommandController extends Controller
{
    public function index()
    {
        return redirect('commandList');
    }

     public function commandList() {
        return view('admin/command/commandList', [
            'commands'  => Command::paginate(20) ,
            'title'     => ''
        ]);
    }

    public function commandDetail($id) {
        $command = Command::find($id);
        return view('admin/command/commandDetail', [
            'title'          => 'Command n°' . $command->id                         ,
            'commandDetails' => $command->commandDetails()->with('product')->get()  ,
            'price'          => $command->price
        ]);
    }
}
