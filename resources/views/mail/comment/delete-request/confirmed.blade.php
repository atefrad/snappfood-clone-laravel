<x-mail::message>
# درخواست تایید شد

    {{ $sellerName }} عزیز،
درخواست حذف نظر شما که به علت
"{{ $deleteRequestReason }}"
ثبت شده بود، توسط ادمین مورد بررسی قرار گرفت و تایید شد
<x-mail::button :url="$url">
ورود به صفحه نظرات
</x-mail::button>

،با تشکر<br>
{{ config('app.name') }}
</x-mail::message>
