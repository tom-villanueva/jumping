<?php

namespace App\Repositories\User;

use App\Core\BaseRepository;
use App\Models\User;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository
{
    public function __construct(User $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}
