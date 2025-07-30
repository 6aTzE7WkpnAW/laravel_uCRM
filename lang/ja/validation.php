<?php

return [

    /*
    |--------------------------------------------------------------------------
    | バリデーション言語行
    |--------------------------------------------------------------------------
    |
    | 以下の言語行はバリデータークラスで使用するデフォルトのエラーメッセージを
    | 含んでいます。これらのルールの中にはサイズルールのように複数のバージョンを
    | 持つものもあります。ここでこれらのメッセージを自由に調整してください。
    |
    */

    'accepted' => ':attributeを承認してください。',
    'accepted_if' => ':otherが:valueの場合、:attributeを承認してください。',
    'active_url' => ':attributeには有効なURLを指定してください。',
    'after' => ':attributeには:dateより後の日付を指定してください。',
    'after_or_equal' => ':attributeには:date以降の日付を指定してください。',
    'alpha' => ':attributeには英字のみ使用できます。',
    'alpha_dash' => ':attributeには英数字とダッシュ(-)及びアンダースコア(_)が使用できます。',
    'alpha_num' => ':attributeには英数字のみ使用できます。',
    'any_of' => ':attributeの値が無効です。',
    'array' => ':attributeには配列を指定してください。',
    'ascii' => ':attributeには半角英数字と記号のみ使用できます。',
    'before' => ':attributeには:dateより前の日付を指定してください。',
    'before_or_equal' => ':attributeには:date以前の日付を指定してください。',
    'between' => [
        'array' => ':attributeの項目数は:min個から:max個にしてください。',
        'file' => ':attributeには:minから:maxキロバイトまでのファイルを指定してください。',
        'numeric' => ':attributeには:minから:maxまでの数字を指定してください。',
        'string' => ':attributeは:min文字から:max文字にしてください。',
    ],
    'boolean' => ':attributeには真偽値を指定してください。',
    'can' => ':attributeに権限のない値が含まれています。',
    'confirmed' => ':attributeと確認用項目が一致しません。',
    'contains' => ':attributeに必要な値が不足しています。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attributeには有効な日付を指定してください。',
    'date_equals' => ':attributeには:dateと同じ日付を指定してください。',
    'date_format' => ':attributeには:format形式で入力してください。',
    'decimal' => ':attributeには:decimal桁の小数を指定してください。',
    'declined' => ':attributeを拒否してください。',
    'declined_if' => ':otherが:valueの場合、:attributeを拒否してください。',
    'different' => ':attributeと:otherには異なる値を指定してください。',
    'digits' => ':attributeは:digits桁で入力してください。',
    'digits_between' => ':attributeは:min桁から:max桁で入力してください。',
    'dimensions' => ':attributeの画像サイズが無効です。',
    'distinct' => ':attributeに重複した値があります。',
    'doesnt_end_with' => ':attributeは次のいずれかで終わってはいけません: :values',
    'doesnt_start_with' => ':attributeは次のいずれかで始まってはいけません: :values',
    'email' => ':attributeには有効なメールアドレスを指定してください。',
    'ends_with' => ':attributeは次のいずれかで終わる必要があります: :values',
    'enum' => '選択された:attributeは無効です。',
    'exists' => '選択された:attributeは無効です。',
    'extensions' => ':attributeには次の拡張子のファイルを指定してください: :values',
    'file' => ':attributeにはファイルを指定してください。',
    'filled' => ':attributeには値を指定してください。',
    'gt' => [
        'array' => ':attributeの項目数は:value個より多くしてください。',
        'file' => ':attributeには:valueキロバイトより大きなファイルを指定してください。',
        'numeric' => ':attributeには:valueより大きな数字を指定してください。',
        'string' => ':attributeは:value文字より多くしてください。',
    ],
    'gte' => [
        'array' => ':attributeの項目数は:value個以上にしてください。',
        'file' => ':attributeには:valueキロバイト以上のファイルを指定してください。',
        'numeric' => ':attributeには:value以上の数字を指定してください。',
        'string' => ':attributeは:value文字以上にしてください。',
    ],
    'hex_color' => ':attributeには有効な16進カラーコードを指定してください。',
    'image' => ':attributeには画像を指定してください。',
    'in' => '選択された:attributeは無効です。',
    'in_array' => ':attributeが:otherに存在しません。',
    'in_array_keys' => ':attributeには次のキーのいずれかを含める必要があります: :values',
    'integer' => ':attributeには整数を指定してください。',
    'ip' => ':attributeには有効なIPアドレスを指定してください。',
    'ipv4' => ':attributeには有効なIPv4アドレスを指定してください。',
    'ipv6' => ':attributeには有効なIPv6アドレスを指定してください。',
    'json' => ':attributeには有効なJSON文字列を指定してください。',
    'list' => ':attributeにはリストを指定してください。',
    'lowercase' => ':attributeは小文字で入力してください。',
    'lt' => [
        'array' => ':attributeの項目数は:value個より少なくしてください。',
        'file' => ':attributeには:valueキロバイトより小さなファイルを指定してください。',
        'numeric' => ':attributeには:valueより小さな数字を指定してください。',
        'string' => ':attributeは:value文字より少なくしてください。',
    ],
    'lte' => [
        'array' => ':attributeの項目数は:value個以下にしてください。',
        'file' => ':attributeには:valueキロバイト以下のファイルを指定してください。',
        'numeric' => ':attributeには:value以下の数字を指定してください。',
        'string' => ':attributeは:value文字以下にしてください。',
    ],
    'mac_address' => ':attributeには有効なMACアドレスを指定してください。',
    'max' => [
        'array' => ':attributeの項目数は:max個以下にしてください。',
        'file' => ':attributeには:maxキロバイト以下のファイルを指定してください。',
        'numeric' => ':attributeには:max以下の数字を指定してください。',
        'string' => ':attributeは:max文字以下にしてください。',
    ],
    'max_digits' => ':attributeは:max桁以下で入力してください。',
    'mimes' => ':attributeには:valuesタイプのファイルを指定してください。',
    'mimetypes' => ':attributeには:valuesタイプのファイルを指定してください。',
    'min' => [
        'array' => ':attributeの項目数は:min個以上にしてください。',
        'file' => ':attributeには:minキロバイト以上のファイルを指定してください。',
        'numeric' => ':attributeには:min以上の数字を指定してください。',
        'string' => ':attributeは:min文字以上にしてください。',
    ],
    'min_digits' => ':attributeは:min桁以上で入力してください。',
    'missing' => ':attributeは存在してはいけません。',
    'missing_if' => ':otherが:valueの場合、:attributeは存在してはいけません。',
    'missing_unless' => ':otherが:value以外の場合、:attributeは存在してはいけません。',
    'missing_with' => ':valuesが存在する場合、:attributeは存在してはいけません。',
    'missing_with_all' => ':valuesが存在する場合、:attributeは存在してはいけません。',
    'multiple_of' => ':attributeは:valueの倍数である必要があります。',
    'not_in' => '選択された:attributeは無効です。',
    'not_regex' => ':attributeの形式が無効です。',
    'numeric' => ':attributeには数字を指定してください。',
    'password' => [
        'letters' => ':attributeには少なくとも1つの文字を含めてください。',
        'mixed' => ':attributeには少なくとも1つの大文字と小文字を含めてください。',
        'numbers' => ':attributeには少なくとも1つの数字を含めてください。',
        'symbols' => ':attributeには少なくとも1つの記号を含めてください。',
        'uncompromised' => '指定された:attributeはデータ漏洩に含まれています。別の:attributeを選択してください。',
    ],
    'present' => ':attributeが存在する必要があります。',
    'present_if' => ':otherが:valueの場合、:attributeが存在する必要があります。',
    'present_unless' => ':otherが:value以外の場合、:attributeが存在する必要があります。',
    'present_with' => ':valuesが存在する場合、:attributeが存在する必要があります。',
    'present_with_all' => ':valuesが存在する場合、:attributeが存在する必要があります。',
    'prohibited' => ':attributeは禁止されています。',
    'prohibited_if' => ':otherが:valueの場合、:attributeは禁止されています。',
    'prohibited_if_accepted' => ':otherが承認された場合、:attributeは禁止されています。',
    'prohibited_if_declined' => ':otherが拒否された場合、:attributeは禁止されています。',
    'prohibited_unless' => ':otherが:valuesに含まれない場合、:attributeは禁止されています。',
    'prohibits' => ':attributeは:otherの存在を禁止しています。',
    'regex' => ':attributeの形式が無効です。',
    'required' => ':attributeは必須です。',
    'required_array_keys' => ':attributeには:valuesのエントリが含まれている必要があります。',
    'required_if' => ':otherが:valueの場合、:attributeは必須です。',
    'required_if_accepted' => ':otherが承認された場合、:attributeは必須です。',
    'required_if_declined' => ':otherが拒否された場合、:attributeは必須です。',
    'required_unless' => ':otherが:valuesに含まれない場合、:attributeは必須です。',
    'required_with' => ':valuesが存在する場合、:attributeは必須です。',
    'required_with_all' => ':valuesが存在する場合、:attributeは必須です。',
    'required_without' => ':valuesが存在しない場合、:attributeは必須です。',
    'required_without_all' => ':valuesがすべて存在しない場合、:attributeは必須です。',
    'same' => ':attributeと:otherが一致する必要があります。',
    'size' => [
        'array' => ':attributeの項目数は:size個にしてください。',
        'file' => ':attributeには:sizeキロバイトのファイルを指定してください。',
        'numeric' => ':attributeには:sizeを指定してください。',
        'string' => ':attributeは:size文字にしてください。',
    ],
    'starts_with' => ':attributeは次のいずれかで始まる必要があります: :values',
    'string' => ':attributeには文字列を指定してください。',
    'timezone' => ':attributeには有効なタイムゾーンを指定してください。',
    'unique' => ':attributeはすでに使用されています。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'uppercase' => ':attributeは大文字で入力してください。',
    'url' => ':attributeには有効なURLを指定してください。',
    'ulid' => ':attributeには有効なULIDを指定してください。',
    'uuid' => ':attributeには有効なUUIDを指定してください。',

    /*
    |--------------------------------------------------------------------------
    | カスタムバリデーション言語行
    |--------------------------------------------------------------------------
    |
    | ここでは"attribute.rule"の命名規則を使用してattributeに対する
    | カスタムバリデーションメッセージを指定できます。これにより特定の
    | attributeルールに対する特定のカスタム言語行を素早く指定できます。
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | カスタムバリデーション属性名
    |--------------------------------------------------------------------------
    |
    | 以下の言語行は"email"の代わりに"メールアドレス"のように読み手にとって
    | より分かりやすくするためにattributeプレースホルダーを置き換えるために
    | 使用されます。これは単にメッセージをより表現豊かにするために役立ちます。
    |
    */

    'attributes' => [
        'name' => '名前',
        'username' => 'ユーザー名',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード（確認）',
        'current_password' => '現在のパスワード',
        'phone' => '電話番号',
        'mobile' => '携帯電話番号',
        'age' => '年齢',
        'sex' => '性別',
        'gender' => '性別',
        'year' => '年',
        'month' => '月',
        'day' => '日',
        'hour' => '時',
        'minute' => '分',
        'second' => '秒',
        'title' => 'タイトル',
        'content' => '内容',
        'description' => '説明',
        'body' => '本文',
        'subject' => '件名',
        'message' => 'メッセージ',
        'text' => 'テキスト',
        'address' => '住所',
        'city' => '市区町村',
        'state' => '都道府県',
        'country' => '国',
        'postal_code' => '郵便番号',
        'zip_code' => '郵便番号',
        'contact' => 'お問い合わせ内容',
        'caution' => '同意'
    ],

];