<x-mail::message>
# سفارش شما با موفقیت ثبت شد

سفارش شما با موفقیت ثبت شد و در انتظار بررسی توسط رستوران قرار گرفت

<x-mail::button :url="$url">
ورود به سایت
</x-mail::button>

،با تشکر<br>
{{ config('app.name') }}
</x-mail::message>
