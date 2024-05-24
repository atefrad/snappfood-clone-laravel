<x-mail::message>
# وضعیت سفارش تغییر یافت

وضعیت سفارش شما به "{{ $orderStatusName }}" تغییر یافت

<x-mail::button :url="$url">
ورود به سایت
</x-mail::button>

،با تشکر<br>
{{ config('app.name') }}
</x-mail::message>
