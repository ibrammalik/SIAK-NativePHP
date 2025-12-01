<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class RoleFilterScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = auth()->user();

        if (! $user) return;

        if ($user->isRT()) {
            $builder->where('rt_id', $user->rt_id);
        } elseif ($user->isRW()) {
            $builder->where('rw_id', $user->rw_id);
        }
        // super_admin & kelurahan tidak difilter
    }
}
