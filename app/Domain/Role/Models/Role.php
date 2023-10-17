<?php

namespace App\Domain\Role\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function scopeSearch(Builder $query, $value)
    {
        $query->when($value ?? false, function ($query, $value) {
            return $query->where('name', 'LIKE', '%' . $value . '%');
        });
    }

    public function scopeSort(Builder $query, $value)
    {
        $query->when($value ?? false, function ($query, $value) {
            $value = explode(":", $value);
            $field = $value[0];
            $order = $value[1];

            return $query->orderBy($field, $order);
        });
    }

    public function scopeFilter(Builder $query, $value): void
    {
        $query->when($value['created_at'] ?? false, function ($query, $value) {
            return $query->where('created_at', $value);
        });

        $query->when($value['updated_at'] ?? false, function ($query, $value) {
            return $query->where('updated_at', $value);
        });
    }
}
