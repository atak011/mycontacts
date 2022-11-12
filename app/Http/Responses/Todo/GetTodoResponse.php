<?php

namespace App\Http\Responses\Todo;

use Illuminate\Foundation\Http\FormRequest;

class GetTodoResponse
{

    public $title;
    public $completed;


    public function __construct($title,$completed)
    {
        $this->title = $title;
        $this->completed = $completed;
    }

}
