@php
    $default = \App\EmailTemplate::select('email_body')->where('user_id',Auth::id())->where('status',1)->first();
@endphp

<p>{!! $default->email_body !!}</p>