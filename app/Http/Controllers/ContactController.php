<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Notifications\ContactNotification;
use App\Helpers\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function createContact(ContactRequest $request)
    {
        $data = $request->validated();

        $checkDuplicateEntry = $this->checkDuplicateContact($data);

        if ($checkDuplicateEntry) {
            
            return $this->customError('duplicate_contact', Response::HTTP_NOT_ACCEPTABLE, 'Duplicate contact entry not allowed');
        }

        try{

            DB::beginTransaction();

            if ($request->has('attachment')) {
                
                $data['attachment'] = FileUpload::saveAttachment($request->file('attachment'));
            }

            $contact = Contact::create($data);

            Notification::route('mail', config('app.admin_email'))->notify(new ContactNotification($contact));

            DB::commit();
            
            return $this->success('Contact created successfully');

        }catch(\Throwable $exception){

             DB::rollBack();

             Log::info($exception->getMessage());

             return $this->serverError('Error creating contact, please try again');
        }
    }


    protected function checkDuplicateContact(array $data): Contact | null
    {
        return Contact::where(['name' => $data['name'], 'email' => $data['email'], 'message' => $data['message']])->first();
    }
}
