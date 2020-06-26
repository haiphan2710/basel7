<?php

namespace HaiPhan\BaseL7\Filters\Traits;

use App\BaseL7\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

trait CanSearch
{
    /**
     *
     *
     * @param Builder $query
     * @param BaseFilter $filters
     * @return Builder
     */
    public function scopeSearch($query, BaseFilter $filters)
    {
        return $filters->apply($query);
    }
}
