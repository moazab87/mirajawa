<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines (Japanese)
    |--------------------------------------------------------------------------
    */

    'accepted' => ':attribute は承認されなければなりません。',
    'active_url' => ':attribute は有効なURLではありません。',
    'after' => ':attribute は :date 以降の日付でなければなりません。',
    'after_or_equal' => ':attribute は :date と同日またはそれ以降の日付でなければなりません。',
    'alpha' => ':attribute は文字のみ使用できます。',
    'alpha_dash' => ':attribute は文字、数字、ダッシュ、アンダースコアのみ使用できます。',
    'alpha_num' => ':attribute は文字と数字のみ使用できます。',
    'array' => ':attribute は配列でなければなりません。',
    'before' => ':attribute は :date 以前の日付でなければなりません。',
    'before_or_equal' => ':attribute は :date と同日またはそれ以前の日付でなければなりません。',

    'between' => [
        'numeric' => ':attribute は :min から :max の間でなければなりません。',
        'file' => ':attribute は :min 〜 :max キロバイトの間でなければなりません。',
        'string' => ':attribute は :min 〜 :max 文字の間でなければなりません。',
        'array' => ':attribute は :min 〜 :max 個の項目が必要です。',
    ],

    'boolean' => ':attribute フィールドは true または false でなければなりません。',
    'confirmed' => ':attribute の確認が一致しません。',
    'date' => ':attribute は有効な日付ではありません。',
    'date_equals' => ':attribute は :date と同じ日付でなければなりません。',
    'date_format' => ':attribute は形式 :format と一致しません。',
    'different' => ':attribute と :other は異なる必要があります。',
    'digits' => ':attribute は :digits 桁でなければなりません。',
    'digits_between' => ':attribute は :min 〜 :max 桁の間でなければなりません。',
    'dimensions' => ':attribute の画像寸法が無効です。',
    'distinct' => ':attribute フィールドに重複する値があります。',
    'email' => ':attribute は有効なメールアドレスでなければなりません。',
    'ends_with' => ':attribute は次のいずれかで終わらなければなりません: :values。',
    'exists' => '選択された :attribute は無効です。',
    'file' => ':attribute はファイルでなければなりません。',
    'filled' => ':attribute フィールドには値が必要です。',

    'gt' => [
        'numeric' => ':attribute は :value より大きくなければなりません。',
        'file' => ':attribute は :value キロバイトより大きくなければなりません。',
        'string' => ':attribute は :value 文字より多くなければなりません。',
        'array' => ':attribute には :value 個より多くの項目が必要です。',
    ],

    'gte' => [
        'numeric' => ':attribute は :value 以上でなければなりません。',
        'file' => ':attribute は :value キロバイト以上でなければなりません。',
        'string' => ':attribute は :value 文字以上でなければなりません。',
        'array' => ':attribute には :value 個以上の項目が必要です。',
    ],

    'image' => ':attribute は画像ファイルでなければなりません。',
    'in' => '選択された :attribute は無効です。',
    'in_array' => ':attribute フィールドが :other に存在しません。',
    'integer' => ':attribute は整数でなければなりません。',
    'ip' => ':attribute は有効なIPアドレスでなければなりません。',
    'ipv4' => ':attribute は有効なIPv4アドレスでなければなりません。',
    'ipv6' => ':attribute は有効なIPv6アドレスでなければなりません。',
    'json' => ':attribute は有効なJSON文字列でなければなりません。',

    'lt' => [
        'numeric' => ':attribute は :value 未満でなければなりません。',
        'file' => ':attribute は :value キロバイト未満でなければなりません。',
        'string' => ':attribute は :value 文字未満でなければなりません。',
        'array' => ':attribute は :value 個未満の項目でなければなりません。',
    ],

    'lte' => [
        'numeric' => ':attribute は :value 以下でなければなりません。',
        'file' => ':attribute は :value キロバイト以下でなければなりません。',
        'string' => ':attribute は :value 文字以下でなければなりません。',
        'array' => ':attribute は :value 個より多くの項目を持ってはいけません。',
    ],

    'max' => [
        'numeric' => ':attribute は :max を超えてはいけません。',
        'file' => ':attribute は :max キロバイトを超えてはいけません。',
        'string' => ':attribute は :max 文字を超えてはいけません。',
        'array' => ':attribute は :max 個以上の項目を持ってはいけません。',
    ],

    'mimes' => ':attribute は次のタイプのファイルでなければなりません: :values。',
    'mimetypes' => ':attribute は次のタイプのファイルでなければなりません: :values。',

    'min' => [
        'numeric' => ':attribute は最低 :min でなければなりません。',
        'file' => ':attribute は最低 :min キロバイトでなければなりません。',
        'string' => ':attribute は最低 :min 文字でなければなりません。',
        'array' => ':attribute は最低 :min 個の項目が必要です。',
    ],

    'not_in' => '選択された :attribute は無効です。',
    'not_regex' => ':attribute の形式が無効です。',
    'numeric' => ':attribute は数値でなければなりません。',
    'password' => 'パスワードが正しくありません。',
    'present' => ':attribute フィールドは存在しなければなりません。',
    'regex' => ':attribute の形式が無効です。',
    'required' => ':attribute フィールドは必須です。',
    'required_if' => ':other が :value の場合、:attribute フィールドは必須です。',
    'required_unless' => ':other が :values に含まれない限り、:attribute フィールドは必須です。',
    'required_with' => ':values が存在する場合、:attribute フィールドは必須です。',
    'required_with_all' => ':values がすべて存在する場合、:attribute フィールドは必須です。',
    'required_without' => ':values が存在しない場合、:attribute フィールドは必須です。',
    'required_without_all' => ':values のいずれも存在しない場合、:attribute フィールドは必須です。',
    'same' => ':attribute と :other は一致する必要があります。',

    'size' => [
        'numeric' => ':attribute は :size でなければなりません。',
        'file' => ':attribute は :size キロバイトでなければなりません。',
        'string' => ':attribute は :size 文字でなければなりません。',
        'array' => ':attribute は :size 個の項目を含む必要があります。',
    ],

    'starts_with' => ':attribute は次のいずれかで始まらなければなりません: :values。',
    'string' => ':attribute は文字列でなければなりません。',
    'timezone' => ':attribute は有効なタイムゾーンでなければなりません。',
    'unique' => ':attribute はすでに使用されています。',
    'uploaded' => ':attribute のアップロードに失敗しました。',
    'url' => ':attribute の形式が無効です。',
    'uuid' => ':attribute は有効なUUIDでなければなりません。',

    "card_number" => ":attribute は有効なカード番号ではありません。",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes (Japanese)
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'title_ar' => 'アラビア語のタイトル',
        'title_en' => '英語のタイトル',
        'description_ar' => 'アラビア語の説明',
        'description_en' => '英語の説明',
        'image' => '画像',
        'price' => '価格',
        'category_id' => 'カテゴリー',
        'name_ar' => 'アラビア語の名前',
        'name_en' => '英語の名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード確認',
        'phone' => '電話番号',
        'address' => '住所',
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
        'youtube' => 'YouTube',
        'whatsapp' => 'WhatsApp',
        'snapchat' => 'Snapchat',
        'unit_length_ar' => '単位（アラビア語）',
        'unit_length_en' => '単位（英語）',
        'primary ' => '主要',
        'value' => '値',
        'first_name' => '名',
        'last_name' => '姓',
        'code' => 'コード',
        'folder_id' => 'フォルダー',
        "text.ar" => "アラビア語のテキスト",
        "text.en" => "英語のテキスト",
        "name" => "名前",
        "name.ar" => "名前（アラビア語）",
        "name.en" => "名前（英語）",
        "product_id" => "商品",
        "exhibition_type" => "展示タイプ",
    ],

];
