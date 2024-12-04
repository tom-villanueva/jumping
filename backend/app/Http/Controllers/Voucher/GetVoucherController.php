<?php
namespace App\Http\Controllers\Voucher;

use App\Http\Controllers\Controller;
use App\Repositories\Voucher\VoucherRepository;

class GetVoucherController extends Controller
{
    private $repository;

    public function __construct(VoucherRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $result = $this->repository->get();
       
        return response()->json($result);
    }
}
