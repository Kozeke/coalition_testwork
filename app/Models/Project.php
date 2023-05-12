<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static findOrFail(mixed $project_id)
 * @method static get()
 * @method static create(array $array)
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public $timestamps = false;

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
