<?php

namespace HaiPhan\BaseL7\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model as BaseModel;
use HaiPhan\BaseL7\Filters\Traits\CanSearch;

class Model extends BaseModel
{
    use CanSearch;
}
