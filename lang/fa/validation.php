<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted"         => ":attribute باید پذیرفته شده باشد.",
    "active_url"       => "آدرس :attribute معتبر نیست",
    "after"            => ":attribute باید تاریخی بعد از :date باشد.",
    "alpha"            => ":attribute باید شامل حروف الفبا باشد.",
    "alpha_dash"       => ":attribute باید شامل حروف الفبا و عدد و خط تیره(-) باشد.",
    "alpha_num"        => ":attribute باید شامل حروف الفبا و عدد باشد.",
    "array"            => ":attribute باید شامل آرایه باشد.",
    "before"           => ":attribute باید تاریخی قبل از :date باشد.",
    "between"          => [
        "numeric" => ":attribute باید بین :min و :max باشد.",
        "file"    => ":attribute باید بین :min و :max کیلوبایت باشد.",
        "string"  => ":attribute باید بین :min و :max کاراکتر باشد.",
        "array"   => ":attribute باید بین :min و :max آیتم باشد.",
    ],
    "boolean"          => "فیلد :attribute فقط میتواند صحیح و یا غلط باشد",
    "confirmed"        => ":attribute با تاییدیه مطابقت ندارد.",
    "date"             => ":attribute یک تاریخ معتبر نیست.",
    "date_format"      => ":attribute با الگوی :format مطاقبت ندارد.",
    "different"        => ":attribute و :other باید متفاوت باشند.",
    "digits"           => ":attribute باید :digits رقم باشد.",
    "digits_between"   => ":attribute باید بین :min و :max رقم باشد.",
    'dimensions'       => 'ابعاد :attribute نامعتبر است.',
    "email"            => "فرمت :attribute معتبر نیست.",
    "exists"           => ":attribute انتخاب شده، معتبر نیست.",
    "filled"           => "فیلد :attribute الزامی است",
    "image"            => ":attribute باید تصویر باشد.",
    "in"               => ":attribute انتخاب شده، معتبر نیست.",
    "integer"          => ":attribute باید نوع داده ای عددی (integer) باشد.",
    "ip"               => ":attribute باید IP آدرس معتبر باشد.",
    "max"              => [
        "numeric" => ":attribute نباید بزرگتر از :max باشد.",
        "file"    => "حجم :attribute نباید بیشتر از :max کیلوبایت باشد.",
        "string"  => ":attribute نباید بیشتر از :max کاراکتر باشد.",
        "array"   => ":attribute نباید بیشتر از :max آیتم باشد.",
    ],
    "mimes"            => ":attribute باید یکی از فرمت های :values باشد.",
    "min"              => [
        "numeric" => ":attribute نباید کوچکتر از :min باشد.",
        "file"    => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
        "string"  => ":attribute نباید کمتر از :min کاراکتر باشد.",
        "array"   => ":attribute نباید کمتر از :min آیتم باشد.",
    ],
    "not_in"           => ":attribute انتخاب شده، معتبر نیست.",
    "numeric"          => ":attribute باید شامل عدد باشد.",
    "regex"            => ":attribute یک فرمت معتبر نیست.",
    "required"         => "فیلد :attribute الزامی است.",
    "required_if"      => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
    "required_with"    => ":attribute الزامی است زمانی که :values موجود است.",
    "required_with_all" => ":attribute الزامی است زمانی که :values موجود است.",
    "required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "same"             => ":attribute و :other باید مانند هم باشند.",
    "size"             => [
        "numeric" => ":attribute باید برابر با :size باشد.",
        "file"    => ":attribute باید برابر با :size کیلوبایت باشد.",
        "string"  => ":attribute باید برابر با :size کاراکتر باشد.",
        "array"   => ":attribute باسد شامل :size آیتم باشد.",
    ],
    "string"           => ":attribute باید رشته ای  باشد.",
    "timezone"         => "فیلد :attribute باید یک منطقه صحیح باشد.",
    "unique"           => ":attribute قبلا انتخاب شده است.",
    'uploaded'             => 'آپلود :attribute با شکست مواجه شد.',
    "url"              => "فرمت آدرس :attribute اشتباه است.",
    'gt' => [
        'array' => ':attribute باید بیش از :value باشد.',
        'file' => ':attribute باید بیش از :value کیلوبایتس باشد.',
        'numeric' => ':attribute باید بیش از :value باشد.',
        'string' => ':attribute باید بیش از :value کاراکتر باشد.',
    ],
    "check_address_belongs_to" => ".آدرس وارد شده معتبر نیست",
    "check_address_is_current" => ".آدرس وارد شده، آدرس فعلی شما می باشد",
    "check_restaurant_is_open" => ".متاسفانه رستوران در حال حاضر باز نمی باشد",

    "check_cart_belongs_to" => ".سبد خرید وارد شده معتبر نیست",
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => array(
        'adult_id' => array(
            'required' => 'Please choose some parents!',
        ),
        'group_id' => array(
            'required' => 'Please choose a group or choose temp!',
        ),
    ),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
        "name"                      => "نام",
        'firstName'                 => 'نام',
        "username"                  => "نام کاربری",
        "email"                     => "پست الکترونیکی",
        "first_name"                => "نام",
        "last_name"                 => "نام خانوادگی",
        "lastName"                  => "نام خانوادگی",
        "family"                    => "نام خانوادگی",
        "password"                  => "رمز عبور",
        "password_confirmation"     => "تاییدیه ی رمز عبور",
        "discription"               => "توضیحات",
        "city"                      => "شهر",
        "country"                   => "کشور",
        "address"                   => "نشانی",
        "phone"                     => "تلفن",
        "mobile"                    => "تلفن همراه",
        "cellphone"                 => "تلفن همراه",
        "age"                       => "سن",
        "sex"                       => "جنسیت",
        "gender"                    => "جنسیت",
        "day"                       => "روز",
        "month"                     => "ماه",
        "year"                      => "سال",
        "hour"                      => "ساعت",
        "minute"                    => "دقیقه",
        "second"                    => "ثانیه",
        "title"                     => "عنوان",
        "text"                      => "متن",
        "content"                   => "محتوا",
        "description"               => "توضیحات",
        "excerpt"                   => "گلچین کردن",
        "date"                      => "تاریخ",
        "time"                      => "زمان",
        "available"                 => "موجود",
        "size"                      => "اندازه",
		"file"                      => "فایل",
        "fullname"                  => "نام کامل",
        "postal_code"               => "کد پستی",
        "comment"                   => "نظر",
        "body"                      => "متن اصلی",
        "image"                     => "تصویر",
        "photos"                    => "تصاویر",
        "photo"                     => "تصویر",
        "cat_id"                    => "دسته بندی",
        "published_at"              => "تاریخ انتشار",
        "reference_id"              => "ارجاع",
        "priority_id"               => "اولویت",
        "category_id"               => "دسته بندی",
        "restaurant_category_id"    => "دسته بندی رستوران",
        "state"                     => "استان",
        "bank_account_number"       => "شماره حساب",
        "food_category_id"          => "دسته بندی غذا",
        "ingredient"                => "مواد اولیه",
        "price"                     => "قیمت",
        "percentage"                => "درصد",
        "started_at"                => "تاریخ شروع",
        "expired_at"                => "تاریخ انقضا",
        "start_date"                => "تاریخ شروع",
        "end_date"                  => "تاریخ پایان",
        "delivery_price"            => "هزینه ی ارسال",
        "working_days"              => "روزهای کاری",
        "opening_time"              => "ساعت آغاز کار",
        "closing_time"              => "ساعت پایان کار",
        "count"                     => "تعداد",
        "food_id"                   => "غذا",
        "restaurant_id"             => "رستوران",
        "cart_id"                   => "سبد خرید",
        "score"                     => "امتیاز",
        "message"                   => "پیام نظر",
        "answer"                    => "پاسخ",
        "comment_id"                => "نظر",
    ],

    'messages' => [
        'end_date_gt' => 'تاریخ پایان باید بعد از تاریخ شروع باشد.',
    ],
];
