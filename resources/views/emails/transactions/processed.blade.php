@component('mail::message')
# Hi, {{ $transaction->receiver->name }}

{{ $transaction->sender->name }} sent you amount of {{ number_format($transaction->total, 2) }} {{ $transaction->receiver_currency }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
