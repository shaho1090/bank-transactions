<?php

namespace Banking\Http\Controllers;


use Banking\Events\CardToCardEvent;
use Banking\Http\Requests\CardToCardTransferStore;
use Banking\Services\Transfer\TransferService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CardToCardTransferController
{
    public function __construct(private readonly TransferService $transferService)
    {

    }

    public function store(CardToCardTransferStore $request): JsonResponse
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $transfer = $this->transferService->cardToCard($data);

            CardToCardEvent::dispatch($transfer);

            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();

            info($exception->getMessage(), $exception->getTrace());

            return response()->json([
                'message' => 'The problem occurred while transferring money.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'message' => 'The money has been transferred successfully.',
        ], Response::HTTP_OK);
    }
}
