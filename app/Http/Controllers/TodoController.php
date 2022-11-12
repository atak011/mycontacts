<?php

namespace App\Http\Controllers;


use App\Http\Responses\Todo\GetTodoResponse;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TodoController extends Controller
{


    public function index(Request $request)
    {
        $data = (new TodoService())->getTodos();

        return response($data);
    }


}
