<?php

namespace App\Helpers;
use Illuminate\Http\Request;

class FileUpload{

	
    public static function saveAttachment($file): string
    {
        $attachmentNameWithExtension = $file->getClientOriginalName();
        $attachmentName = pathinfo($attachmentNameWithExtension, PATHINFO_FILENAME);
        $attachmentExtension = $file->getClientOriginalExtension();
        $saveAttachment = $attachmentName.'_'.time().'.'.$attachmentExtension;
        $file->storeAs('public/attachments', $saveAttachment);
        return $saveAttachment;
    }
       
}