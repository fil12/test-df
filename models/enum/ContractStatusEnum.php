<?php

namespace app\models\enum;

class ContractStatusEnum extends BaseEnum
{
    public const MISSING = [
        'title' => 'Відсутній',
        'value' => 0
    ];
    public const CANDIDATE_SIGNED = [
        'title' => 'Підписано кандидатом',
        'value' => 5
    ];
    public const BOTH_SIDES_SIGNED = [
        'title' => 'Підписано з обох сторін',
        'value' => 7
    ];
    public const TRANSFERRED = [
        'title' => 'Передано кандидату',
        'value' => 10
    ];
    public const BROKEN = [
        'title' => 'Розірвано',
        'value' => 15
    ];

    public static $available = [
        self::MISSING,
        self::CANDIDATE_SIGNED,
        self::BOTH_SIDES_SIGNED,
        self::TRANSFERRED,
        self::BROKEN
    ];

    public static function getCurrentStatusTitle(int $status): string
    {
        $availableStatuses = \app\models\enum\ContractStatusEnum::getAvailable();
        foreach ($availableStatuses as $availableStatus) {
            if ($availableStatus['value'] === $status) {
                return $availableStatus['title'];
            }
        }
        throw new \InvalidArgumentException('Contract have incorrect status.');
    }
}