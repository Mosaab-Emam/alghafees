<?php

namespace App\Support;

class LeadContactData
{
    public static function trim(string $value): string
    {
        return preg_replace('/^[\s\p{Z}\x{FEFF}]+|[\s\p{Z}\x{FEFF}]+$/u', '', $value) ?? trim($value);
    }

    public static function digits(string $value): string
    {
        return strtr($value, array_combine(
            preg_split('//u', '٠١٢٣٤٥٦٧٨٩۰۱۲۳۴۵۶۷۸۹', -1, PREG_SPLIT_NO_EMPTY),
            str_split('01234567890123456789'),
        ));
    }

    public static function phone(string $value): string
    {
        $value = self::digits($value);

        return preg_replace('/[\s\p{Z}().\-\x{200E}\x{200F}\x{061C}]/u', '', $value) ?? $value;
    }

    public static function validPhone(string $value): bool
    {
        return (bool) preg_match('/^\+?[0-9]{7,15}$/D', self::phone($value));
    }

    /** Compare complete records without treating a shared name as the same person. */
    public static function fingerprint(array $data): string
    {
        $phones = array_map(fn ($phone) => self::phone($phone), $data['phones'] ?? []);
        $emails = array_map(fn ($email) => mb_strtolower(self::trim($email)), $data['emails'] ?? []);
        sort($phones);
        sort($emails);

        return hash('sha256', json_encode([
            self::trim($data['name']),
            isset($data['lead_category_id']) ? (int) $data['lead_category_id'] : null,
            array_values(array_unique($phones)), array_values(array_unique($emails)),
            filled($data['notes'] ?? null) ? self::trim($data['notes']) : null,
        ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR));
    }
}
