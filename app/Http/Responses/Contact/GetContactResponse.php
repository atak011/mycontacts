<?php

namespace App\Http\Responses\Contact;

use Illuminate\Foundation\Http\FormRequest;

class GetContactResponse
{

    public $phone;
    public $name;


    public function __construct($name,$phone)
    {
        $this->name = $name;
        $this->phone = $phone;
    }

}
