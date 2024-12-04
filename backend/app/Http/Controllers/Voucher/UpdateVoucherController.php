<?php
namespace App\Http\Controllers\Voucher;

use App\Http\Controllers\Controller;
use App\Repositories\Voucher\VoucherRepository;
use App\Http\Requests\Voucher\UpdateVoucherRequest;

class UpdateVoucherController extends Controller
{
    private $repository;

    public function __construct(VoucherRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateVoucherRequest $request, $id)
    {
        $result = $this->repository->update($id, $request->all());

        return response()->json($result);
    }
}
