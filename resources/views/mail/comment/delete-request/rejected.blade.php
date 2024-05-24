<x-mail::message>
# درخواست رد شد.

{{ $sellerName }}" عزیز، درخواست حذف نظر شما که به علت {{ $deleteRequestReason }}" ثبت شده بود، توسط ادمین مورد بررسی قرار گرفت و درخواست شما رد شد

<x-mail::button :url="$url">
ورود به صفحه ی نظرات
</x-mail::button>

،با تشکر<br>
{{ config('app.name') }}
</x-mail::message>
