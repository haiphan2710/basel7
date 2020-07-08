<?php

namespace HaiPhan\BaseL7\Http\Filters;

use HaiPhan\BaseL7\Filters\BaseFilter;

class UserFilter extends BaseFilter
{
    public function nickname(string $nickname)
    {
        if (empty($nickname)) {
            return $this->builder;
        }

        return $this->builder->where('nickname', 'LIKE', '%' . $nickname . '%');
    }
}
