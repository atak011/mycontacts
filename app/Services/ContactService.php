<?php

namespace App\Services;

use App\Http\Responses\Contact\GetContactResponse;
use App\Http\Responses\Todo\GetTodoResponse;
use App\Models\Contact;
use App\Models\ContactPhone;

class ContactService
{

    public function createOrUpdate(string $name, string $surname, string $company, array $phones = [],int $userId = null,Contact $model = null)
    {

        $phonesArr = [];

        foreach ($phones as $phone){

            $tmpPhone = new ContactPhone();
            $tmpPhone->country_code = $phone['code'];
            $tmpPhone->phone = $phone['phone'];
            $phonesArr[] = $tmpPhone;
        }

        if ($model instanceof Contact) {

             $model->update([
                'first_name' => $name,
                'surname' => $surname,
                'company' => $company,
            ]);

            $contact = $model->fresh();
            $model->phones()->delete();
        } else {
            $contact = Contact::create([
                'first_name' => $name,
                'surname' => $surname,
                'company' => $company,
                'user_id' =>$userId
            ]);


            $contact->phones()->saveMany($phonesArr);
        }


        return $contact;
    }

    public function search(string $query, string $field)
    {
        $word = strtolower($query);

        return Contact::where($field,'SOUNDS LIKE',$word)->get();
    }

    public function getWithUserId(int $id)
    {
        $contacts = Contact::all();
        $data = [];
        foreach ($contacts as $contact){
            $data[] = new GetContactResponse($contact['first_name'],$contact['surname']);
        }
        return $data;
    }


}
