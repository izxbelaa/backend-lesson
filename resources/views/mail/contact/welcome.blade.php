<x-mail::message>
# Introduction

Hello {{ $contact->first_name }},

Thank you for joining our community! We are thrilled to have you on board.

<x-mail::button :url="''">
Learn more
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
