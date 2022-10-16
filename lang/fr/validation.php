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

    'accepted' => 'L\'attribut :attribute doit être accepté.',
    'accepted_if' => 'L\'attribut :attribute doit être accepté quand :other est :value.',
    'active_url' => 'L\'attribut :attribute n\'est pas un URL valide.',
    'after' => 'L\'attribut :attribute doit être une date après :date.',
    'after_or_equal' => 'L\'attribut :attribute doit être une date égale ou après :date.',
    'alpha' => 'L\'attribut :attribute ne doit contenir que des lettres.',
    'alpha_dash' => 'L\'attribut :attribute doit uniquement contenir des lettres, nombres, tirets et tirets du bas.',
    'alpha_num' => 'L\'attribut :attribute doit uniquement contenir des lettres ou des nombres.',
    'array' => 'L\'attribut :attribute doit être un tableau.',
    'before' => 'L\'attribut :attribute doit être une date avant :date.',
    'before_or_equal' => 'L\'attribut :attribute doit être une date avant ou égale :date.',
    'between' => [
        'array' => 'L\'attribut :attribute doit avoir entre :min et :max éléments.',
        'file' => 'L\'attribut :attribute doit être entre :min et :max kilooctets.',
        'numeric' => 'L\'attribut :attribute doit être entre :min et :max.',
        'string' => 'L\'attribut :attribute doit être entre :min et  :max caractères.',
    ],
    'boolean' => 'L\'attribut :attribute doit être vrai ou faux.',
    'confirmed' => 'L\'attribut de confirmation :attribute ne correspond pas.',
    'current_password' => 'Le mot de passe est incorrect.',
    'date' => 'L\'attribut :attribute n\'est pas une date valide.',
    'date_equals' => 'L\'attribut :attribute doit être une date égale à :date.',
    'date_format' => 'L\'attribut :attribute ne correspond pas au format :format.',
    'declined' => 'L\'attribut :attribute doit être diminué.',
    'declined_if' => 'L\'attribut :attribute doit être diminué quand :other est :value.',
    'different' => 'L\'attribut :attribute et :other doivent être différents.',
    'digits' => 'L\'attribut :attribute doit avoir :digits chiffres.',
    'digits_between' => 'L\'attribut :attribute doit être entre :min et :max chiffres.',
    'dimensions' => 'L\'attribut :attribute a des dimensions d\'image invalides.',
    'distinct' => 'L\'attribut :attribute a une valeur dupliquée.',
    'doesnt_end_with' => 'L\'attribut :attribute ne devrait pas finir par l\'une de ces valeurs : :values.',
    'doesnt_start_with' => 'L\'attribut :attribute ne devrait pas commencer par l\'une de ces valeurs : :values.',
    'email' => 'L\'attribut :attribute doit être une adresse email valide.',
    'ends_with' => 'L\'attribut :attribute doit finir par l\'une de ces valeurs : :values.',
    'enum' => 'L\'attribut sélectionné :attribute est invalide.',
    'exists' => 'L\'attribut sélectionné :attribute est invalide.',
    'file' => 'L\'attribut :attribute doit être un fichier.',
    'filled' => 'L\'attribut :attribute doit avoir une valeur.',
    'gt' => [
        'array' => 'L\'attribut :attribute doit avoir plus de :value éléments.',
        'file' => 'L\'attribut :attribute doit être plus grand que :value kilooctets.',
        'numeric' => 'L\'attribut :attribute doit être plus grand que :value.',
        'string' => 'L\'attribut :attribute doit avoir plus de :value caractères.',
    ],
    'gte' => [
        'array' => 'L\'attribut :attribute doit avoir :value éléments ou plus.',
        'file' => 'L\'attribut :attribute doit être plus grand ou égal à :value kilooctets.',
        'numeric' => 'L\'attribut :attribute doit être plus grand ou égal à :value.',
        'string' => 'L\'attribut :attribute doit avoir autant ou plus de :value caractères.',
    ],
    'image' => 'L\'attribut :attribute doit être une image.',
    'in' => 'L\'attribut sélectionné :attribute est invalide.',
    'in_array' => 'L\'attribut :attribute n\'existe pas dans :other.',
    'integer' => 'L\'attribut :attribute doit être un nombre.',
    'ip' => 'L\'attribut :attribute doit être une adresse IP valide.',
    'ipv4' => 'L\'attribut :attribute doit être une adresse IPv4 valide.',
    'ipv6' => 'L\'attribut :attribute doit être une adresse IPv6 valide.',
    'json' => 'L\'attribut :attribute doit être une chaîne de caractères JSON valide.',
    'lt' => [
        'array' => 'L\'attribut :attribute doit avoir moins de :value éléments.',
        'file' => 'L\'attribut :attribute doit être moins de :value kilooctets.',
        'numeric' => 'L\'attribut :attribute doit être plus petit que :value.',
        'string' => 'L\'attribut :attribute doit avoir moins de :value caractères.',
    ],
    'lte' => [
        'array' => 'L\'attribut :attribute ne doit pas avoir plus de :value éléments.',
        'file' => 'L\'attribut :attribute doit être plus petit ou égal à :value kilooctets.',
        'numeric' => 'L\'attribut :attribute doit être plus petit ou égal à :value.',
        'string' => 'L\'attribut :attribute doit être plus petit ou égal à :value caractères.',
    ],
    'mac_address' => 'L\'attribut :attribute doit être a valid MAC address.',
    'max' => [
        'array' => 'L\'attribut :attribute ne doit pas avoir plus de :max éléments.',
        'file' => 'L\'attribut :attribute ne doit pas être plus grand que :max kilooctets.',
        'numeric' => 'L\'attribut :attribute ne doit pas être plus grand que :max.',
        'string' => 'L\'attribut :attribute ne doit pas avoir plus de :max caractères.',
    ],
    'max_digits' => 'L\'attribut :attribute ne doit pas avoir plus de :max chiffres.',
    'max_lines' => 'L\'attribut :attribute ne doit pas avoir plus de :max lignes',
    'mimes' => 'L\'attribut :attribute doit être un fichier de type : :values.',
    'mimetypes' => 'L\'attribut :attribute doit être un fichier de type : :values.',
    'min' => [
        'array' => 'L\'attribut :attribute doit avoir au moins :min éléments.',
        'file' => 'L\'attribut :attribute doit être au moins :min kilooctets.',
        'numeric' => 'L\'attribut :attribute doit être au moins :min.',
        'string' => 'L\'attribut :attribute doit avoir au moins :min caractères.',
    ],
    'min_digits' => 'L\'attribut :attribute doit avoir au moins :min chiffres.',
    'multiple_of' => 'L\'attribut :attribute doit être un multiple de :value.',
    'not_in' => 'L\'attribut sélectionné :attribute est invalide.',
    'not_regex' => 'Le format de l\'attribut :attribute est invalide.',
    'numeric' => 'L\'attribut :attribute doit être un nombre.',
    'password' => [
        'letters' => 'L\'attribut :attribute doit contenir au moins une lettre.',
        'mixed' => 'L\'attribut :attribute doit contenir au moins une majuscule et une minuscule.',
        'numbers' => 'L\'attribut :attribute doit contenir au moins un chiffre.',
        'symbols' => 'L\'attribut :attribute doit contenir au moins un symbole.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'L\'attribut :attribute doit être présent.',
    'prohibited' => 'L\'attribut :attribute field is prohibited.',
    'prohibited_if' => 'L\'attribut :attribute field is prohibited quand :other is :value.',
    'prohibited_unless' => 'L\'attribut :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'L\'attribut :attribute field prohibits :other from being present.',
    'regex' => 'L\'attribut :attribute format est invalide.',
    'required' => 'L\'attribut :attribute est requis.',
    'required_array_keys' => 'L\'attribut :attribute field doit contenir entries for: :values.',
    'required_if' => 'L\'attribut :attribute est requis quand :other vaut :value.',
    'required_if_accepted' => 'L\'attribut :attribute est requis quand :other est accepté.',
    'required_unless' => 'L\'attribut :attribute est requis unless :other is in :values.',
    'required_with' => 'L\'attribut :attribute est requis quand :values est présent.',
    'required_with_all' => 'L\'attribut :attribute est requis quand :values sont présents.',
    'required_without' => 'L\'attribut :attribute est requis quand :values is not present.',
    'required_without_all' => 'L\'attribut :attribute est requis quand none of :values sont présents.',
    'same' => 'L\'attribut :attribute et :other doivent être égaux.',
    'size' => [
        'array' => 'L\'attribut :attribute doit contenir :size éléments.',
        'file' => 'L\'attribut :attribute doit être :size kilooctets.',
        'numeric' => 'L\'attribut :attribute doit être :size.',
        'string' => 'L\'attribut :attribute doit être :size caractères.',
    ],
    'starts_with' => 'L\'attribut :attribute doit commencer par l\'une des valeurs suivantes : :values.',
    'string' => 'L\'attribut :attribute doit être une chaîne de caractères.',
    'timezone' => 'L\'attribut :attribute doit être un fuseau horaire valide.',
    'unique' => 'L\'attribut :attribute a déjà été utilisé.',
    'uploaded' => 'L\'envoi de :attribute a échoué.',
    'url' => 'L\'attribut :attribute doit être un URL valide.',
    'uuid' => 'L\'attribut :attribute doit être un UUID valide.',

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
        'attachments.0' => 'première pièce jointe',
        'attachments.1' => 'seconde pièce jointe',
        'attachments.2' => 'troisième pièce jointe',
        'full-description' => 'description complète',
        'job-type' => 'Type de travail',
        'phone-number' => 'numéro de téléphone',
        'salary-max' => 'salaire maximum',
        'salary-min' => 'salaire minimum',
        'salary-type' => 'type de salaire',
        'salary-currency' => 'devise',
        'short-description' => 'description complète',
    ],

];
