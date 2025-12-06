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

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'يجب أن يكون :attribute تاريخ بعد :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'حقل :attribute يجب أن يكون بين :min و :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'        => 'The :attribute field must be true or false.',
    'confirmed'      => 'تأكيد :attribute غير متطابق.',
    'date'           => 'The :attribute is not a valid date.',
    'date_equals'    => 'The :attribute must be a date equal to :date.',
    'date_format'    => 'The :attribute does not match the format :format.',
    'different'      => 'The :attribute and :other must be different.',
    'digits'         => 'حقل :attribute يجب أن يحتوي على :digits أرقام.',
    'digits_between' => 'حقل :attribute يجب أن يحتوي على أرقام بين :min و :max.',
    'dimensions'     => 'The :attribute has invalid image dimensions.',
    'distinct'       => 'The :attribute field has a duplicate value.',
    'email'          => 'بيانات :attribute يجب أن تحتوي على بريد إلكتروني صحيح.',
    'ends_with'      => 'The :attribute must end with one of the following: :values.',
    'exists'         => 'القيمة المدخلة في :attribute غير صحيحة.',
    'file'           => 'The :attribute must be a file.',
    'filled'         => 'The :attribute field must have a value.',
    'gt'             => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file'    => 'The :attribute must be greater than :value kilobytes.',
        'string'  => 'The :attribute must be greater than :value characters.',
        'array'   => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file'    => 'The :attribute must be greater than or equal :value kilobytes.',
        'string'  => 'The :attribute must be greater than or equal :value characters.',
        'array'   => 'The :attribute must have :value items or more.',
    ],
    'image'    => 'حقل :attribute يجب أن يحتوي على صورة فقط.',
    'in'       => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer'  => 'The :attribute must be an integer.',
    'ip'       => 'The :attribute must be a valid IP address.',
    'ipv4'     => 'The :attribute must be a valid IPv4 address.',
    'ipv6'     => 'The :attribute must be a valid IPv6 address.',
    'json'     => 'The :attribute must be a valid JSON string.',
    'lt'       => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'حقل :attribute يجب أن لا يكون أكبر من :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'حقل :attribute يجب أن لا يكون أكبر من :max حروف.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'حقل :attribute يجب أن يكون على الأقل :min.',
        'file' => 'حقل :attribute يجب أن يكون على الأقل :min كيلوبايت.',
        'string' => 'حقل :attribute يجب أن يكون على الأقل :min حروف.',
        'array' => 'يجب أن يحتوي :attribute على الأقل :min عنصر.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'حقل :attribute يجب أن يكون رقماً.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'صيغة :attribute غير صحيحة.',
    'required' => 'بيانات :attribute لا يمكن تركها فارغة.',
    'required_if' => ':attribute لا يمكن تركها فارغاً عند تحديد :other :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'لا يمكنك ترك الحقل :attribute فارغاً عند تحديد :values .',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string'      => 'The :attribute must be a string.',
    'timezone'    => 'The :attribute must be a valid zone.',
    'unique'      => ':attribute الذي قمت بإدخاله مستخدم من قبل.',
    'uploaded'    => 'The :attribute failed to upload.',
    'url'         => 'بيانات :attribute غير صحيحة يرجى إدخال الرابط بشكل صحيح يبدأ من http:// أو  https://.',
    'uuid'        => 'The :attribute must be a valid UUID.',
    'card_number' => ':attribute غير صحيح.',

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

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name'                 => 'الإسم',
        'email'                => 'البريد الإلكتروني',
        'password'             => 'كلمة المرور',
        'phone'                => 'الهاتف',
        'country'              => 'الدولة',
        'content'              => 'المحتوى',
        'governorate'          => 'المحافظة',
        'city'                 => 'المدينة',
        'address'              => 'العنوان',
        'photo'                => 'الصورة',
        'name_ar'              => 'الإسم باللغة العربية',
        'name_en'              => 'الإسم باللغة الإنجليزية',
        'sympl_ar'             => 'الرمز باللغة العربية',
        'sympl_en'             => 'الرمز باللغة الإنجليزية',
        'transfer_rate'        => 'قيمة التحويل',
        'responsible'          => 'المسؤل',
        'mobile'               => 'الجوال',
        'licenseId'            => 'رقم الترخيص',
        'licensePhoto'         => 'صورة الترخيص',
        'backPage'             => 'صورة الغلاف الخلفي',
        'name_ar'              => 'الإسم باللغة العربية',
        'writer_id'            => 'المؤلف',
        'pages'                => 'عدد الصفحات',
        'hard_price'           => 'سعر النسخة المطبوعة',
        'pdf_price'            => 'سعر النسخة الإلكترونية',
        'Dimensions'           => 'الحجم',
        'weight'               => 'الوزن',
        'booksNo'              => 'عدد الأجزاء',
        'hardCopy'             => 'النسخة المطبوعة',
        'pdfCopy'              => 'النسخة الإلكترونية',
        'title_ar '            => 'العنوان باللغة العربية',
        'title_en'             => 'العنوان باللغة الإنجليزية',
        'description_ar'       => 'الوصف باللغة العربية',
        'description_en'       => 'الوصف باللغة الإنجليزية',
        'unit_length_ar'       => 'وحدة الطول بالعربية',
        'unit_length_en'       => 'وحدة الطول بالإنجليزية',
        'value'                => 'القيمة',
        'image'                => 'الصورة',
        'first_name'           => 'الإسم الأول',
        'last_name'            => 'الإسم الأخير',
        'old_password'         => 'كلمة المرور القديمة',
        'code'                 => 'الكود',
        'folder_id'            => 'المجلد',
        'reminder_day'         => 'أيام التذكير',
        "text.ar"              => "النص بالعربي",
        "text.en"              => "النص بالإنجليزي",
        'name'                 => 'الإسم',
        'name.ar'              => 'الإسم بالعربية',
        'name.en'              => 'الإسم بالإنجليزية',
        'description'          => 'الوصف',
        'description.ar'       => 'الوصف بالعربية',
        'description.en'       => 'الوصف بالإنجليزية',
        'price'                => 'السعر',
        'discount'             => 'الخصم',
        'quantity'             => 'الكمية',
        'category_id'          => 'القسم',
        'store_id'             => 'المتجر',
        'sizes'                => 'الأحجام',
        'sizes.*'              => 'الأحجام',
        "sizePrice.*"          => "سعر الحجم",
        "type"                 => "النوع",
        "expire_date"          => "تاريخ الإنتهاء",
        "city_id"              => "المدينة",
        "product_id"           => "المنتج",
        "delivery_date"        => "تاريخ التوصيل",
        "card_number"          => "رقم البطاقة",
        "comment"              => "التعليق",
        "rating"               => "التقييم",
        "coupon_num"           => "الكوبون",
        "payment_card_id"      => "البطاقة",
        "payment_method"       => "طريقة الدفع",
        "card"                 => "البطاقة",
        "images"               => "الصور",
        "rate"                 => "التقييم",
        "region_id"            => "المنطقة",
        "vendor_id"            => "الورشة",
        "car_model_id"         => "موديل السيارة",
        "car_type_id"          => "نوع السيارة",
        "year_of_generation"   => "السنة",
        "license_date"         => "تاريخ الترخيص",
        "spare_part_id"        => "قطعة الغيار",
        "car_id"               => "السيارة",
        "message"              => "الرسالة",
        "whatsapp"             => "واتساب",
        "lat"                  => "العنوان",
        "long"                 => "العنوان",
        "map_desc"             => "وصف العنوان",
        "subscription_type"    => "نوع الإشتراك",
        "car_type_ids"         => "أنواع السيارات",
        "exhibition_type"      => "نوع المعرض",
        "condition"            => "الحالة",
        "gear_type"            => "نوع الجير",
        "design"               => "التصميم",
        "color"                => "اللون",
        "number_of_kilometers" => "عدد الكيلومترات",
        "number_of_passengers" => "عدد الركاب",
        "release_year"         => "سنة الصنع",
        "engine"               => "المحرك",
        "gas_type_id"          => "نوع الوقود",
        "design_id"            => "التصميم",
        "gear_type_id"         => "نوع الجير",
        "cover"                => "الغلاف",
        "stock"                => "المخزون",
        "project_id"           => "المشروع",
      ],

];
