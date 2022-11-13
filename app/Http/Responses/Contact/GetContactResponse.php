<?php

namespace App\Http\Responses\Contact;

use Illuminate\Foundation\Http\FormRequest;

class GetContactResponse
{

    public $surname;
    public $name;


    public function __construct($name,$surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

}
