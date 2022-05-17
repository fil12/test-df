<?php

namespace app\models\enum;

class DepartmentStatusEnum  extends BaseEnum
{
    public const ACTIVE= [
        'title' => 'Активний',
        'value' => 10
    ];

    public const REZERVED = [
        'title' => 'Резерв',
        'value' => 15
    ];

    public const DISBANDED = [
        'title' => 'Розформаваний',
        'value' => 0
    ];

    public static $available = [
        self::ACTIVE,
        self::REZERVED,
        self::DISBANDED
    ];

}