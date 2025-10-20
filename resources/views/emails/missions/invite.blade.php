<x-mail::message>
# Introduction

We’ve matched a new mission with your profile—this could be a great opportunity for you.

<x-mail::button :url="url('/quote-offer').'?id='.$mission->id">
Visit Mission
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
