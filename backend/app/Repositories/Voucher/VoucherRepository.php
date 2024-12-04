<?php

namespace App\Repositories\Voucher;

use App\Core\BaseRepository;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherRepository extends BaseRepository
{
    public function __construct(Voucher $model, Request $request)
    {
        parent::__construct($model, $request);
    }
}
