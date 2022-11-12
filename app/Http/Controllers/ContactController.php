<?php

namespace App\Http\Controllers;

use App\Events\ContactCreated;
use App\Http\Requests\Contact\SearchContactRequest;
use App\Http\Requests\Contact\GetContactResponse;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Services\ContactService;

class ContactController extends Controller
{
    private ContactService $contactService;

    public function __construct()
    {
        $this->contactService = new ContactService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return GetContactResponse
     */
    public function index(Request $request)
    {
       $contact = $this->contactService->getWithUserId($request->user()->id);
       return new GetContactResponse($contact->name,$contact->phone);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return GetContactResponse
     */
    public function store(SearchContactRequest $request)
    {
        $contact = $this->contactService->createOrUpdate($request->first_name,$request->surname,$request->company,$request->phones,$request->user()->id);
        ContactCreated::dispatch($contact);
        return new GetContactResponse($contact->name,$contact->phone);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return GetContactResponse
     */
    public function update(Request $request, Contact $contact)
    {
        if ($contact->user_id == $request->user()->id){

            $contact = $this->contactService->createOrUpdate($request->first_name,$request->surname,$request->company,$request->phones,$request->user()->id);

            ContactCreated::dispatch($contact);

            return new GetContactResponse($contact->name,$contact->phone);
        }else{
            return response('Unauthenticated', 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact,Request $request)
    {
        if ($contact->user_id == $request->user()->id){
            return $contact->delete();
        }else{
            return response('Unauthenticated', 401);
        }
    }

    public function search(SearchContactRequest $request)
    {
        return $this->contactService->search($request->query,'phone');
    }
}
