<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected array $attributes = [
        'country' => '',
        'city' => '',
        'street' => '',
        'building' => '',
        'flat' => '',
        'zip_code' => '',
    ];

    protected array $visible = [
        'id',
        'country',
        'city',
        'street',
        'building',
        'flat',
        'zip_code',
    ];

    protected array $fillable = [
        'country',
        'city',
        'street',
        'building',
        'flat',
        'zip_code',
    ];

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
