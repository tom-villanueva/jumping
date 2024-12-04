<?php
namespace App\Http\Controllers\Voucher;

use App\Http\Controllers\Controller;
use App\Repositories\Voucher\VoucherRepository;

class DeleteVoucherController extends Controller
{
    private $repository;

    public function __construct(VoucherRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($id)
    {
        $result = $this->repository->delete($id);

        return response()->json($result);
    }
}
