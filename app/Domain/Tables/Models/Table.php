<?php

namespace App\Domain\Tables\Models;

use Database\Factories\TableFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Table
 *
 * @property int $id
 * @property int $seats
 * @property string $location
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Table extends Model
{
    use HasFactory;
    protected $table = 'tables';
    protected $fillable = [
        'seats',
        'location',
    ];

    public static function factory(): TableFactory
    {
        return TableFactory::new();
    }
}
