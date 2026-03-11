<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppChatbotString extends Model
{
    use HasFactory;

    protected $table = 'whatsapp_chatbot_strings';

    protected $fillable = [
        'key',
        'value',
        'description',
    ];

    /**
     * Get value for a key, or return default if not found/empty.
     */
    public static function getValue(string $key, ?string $default = null): string
    {
        $row = self::where('key', $key)->first();
        $value = $row?->value;
        return trim((string) $value) !== '' ? (string) $value : (string) $default;
    }
}
