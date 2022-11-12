<?php

namespace App\Services;

use App\Http\Responses\Todo\GetTodoResponse;
use App\Models\Contact;
use App\Models\ContactPhone;
use Illuminate\Support\Facades\Http;

class TodoService
{

    public function getTodos()
    {
        $todos = Http::get('https://jsonplaceholder.typicode.com/todos/')->json();
        $data = [];
        foreach ($todos as $todo){
            $data[] = new GetTodoResponse($todo['title'],$todo['completed']);
        }

        return $data;
    }


}
