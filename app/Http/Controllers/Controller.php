<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function __invoke(Request $request)
    {
        if (!Auth::check()) {
            $type = $request->input('type');
            switch ($type) {
                case 'failed':
                    $notes = Task::where(['status' => 'Провалено'])->orderBy('created_at')->paginate(10);
                    break;
                case 'successful':
                    $notes = Task::where(['status' => 'Выполнено'])->orderBy('created_at')->paginate(10);
                    break;
                default:
                    $notes = Task::where(['status' => 'Текущее'])->orderBy('created_at')->paginate(10);
            }
            if (isset($request['date'])) 
                $notes = Task::whereDate('datetime', $request['date'])->get();
            return view('index', ['notes' => $notes]);
        } else {
            return view('login');
        }
    }
}
