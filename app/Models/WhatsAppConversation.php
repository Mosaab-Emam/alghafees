<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppConversation extends Model
{
    use HasFactory;

    protected $table = 'whatsapp_conversations';

    protected $fillable = [
        'phone_number',
        'state',
        'current_field',
        'collected_data',
    ];

    protected $casts = [
        'collected_data' => 'array',
    ];

    /**
     * Get collected data as array
     */
    public function getCollectedData(): array
    {
        return $this->collected_data ?? [];
    }

    /**
     * Set collected data
     */
    public function setCollectedData(array $data): void
    {
        $this->collected_data = $data;
        $this->save();
    }

    /**
     * Add or update a field in collected data
     */
    public function setField(string $field, $value): void
    {
        $data = $this->getCollectedData();
        $data[$field] = $value;
        $this->setCollectedData($data);
    }

    /**
     * Get a specific field from collected data
     */
    public function getField(string $field)
    {
        $data = $this->getCollectedData();
        return $data[$field] ?? null;
    }

    /**
     * Get current field being collected
     */
    public function getCurrentField(): ?string
    {
        return $this->current_field;
    }

    /**
     * Set current field being collected
     */
    public function setCurrentField(?string $field): void
    {
        $this->current_field = $field;
        $this->save();
    }

    /**
     * Reset conversation state
     */
    public function reset(): void
    {
        $this->state = 'collecting_field';
        $this->current_field = null;
        $this->collected_data = [];
        $this->save();
    }

    /**
     * Mark conversation as completed
     */
    public function markCompleted(): void
    {
        $this->state = 'completed';
        $this->save();
    }

    /**
     * Mark conversation as cancelled
     */
    public function markCancelled(): void
    {
        $this->state = 'cancelled';
        $this->save();
    }

    /**
     * Find or create conversation for a phone number
     */
    public static function findOrCreateForPhone(string $phoneNumber): self
    {
        return self::firstOrCreate(
            ['phone_number' => $phoneNumber],
            [
                'state' => 'collecting_field',
                'collected_data' => [],
            ]
        );
    }
}
