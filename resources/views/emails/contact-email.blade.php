<x-mail::message>
Hi Admin,

A new contact information was created. <br>

Please find the details below.

<x-mail::panel>
	Name : <b>{{$contact->name}}</b><br>
	Email : <b>{{$contact->email}}</b><br>
	Message : <b>{{$contact->message}}</b><br>
	Attachement : <a href="{{url(asset('/storage/attachments/'. $contact->attachment))}}">"{{url(asset('/storage/attachments/'. $contact->attachment))}}</a><br>
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>