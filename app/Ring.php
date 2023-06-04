<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Type;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ring extends Model
{
    protected $fillable = ['inwendige_maat', 'dikte', 'hoogte', 'prijs'];

    public static function getAllRings()
    {
        return self::with('type')->get();
    }

    // Get the associated type with image column and foreign key type_id
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class,'type_id');
    }
}
