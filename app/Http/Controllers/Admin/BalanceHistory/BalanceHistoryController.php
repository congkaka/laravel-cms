<?php

namespace App\Http\Controllers\Admin\BalanceHistory;

use App\Http\Controllers\Admin\CrudController;
use App\Http\Requests\BalanceHistoryCreateRequest;
use App\Http\Requests\BalanceHistoryUpdateRequest;
use App\Repositories\EloquentRepository;
use App\Repositories\BalanceHistoryRepository;
use Illuminate\Http\Request;

class BalanceHistoryController extends CrudController
{
    /**
     * @var BalanceHistoryRepository
     */
    private BalanceHistoryRepository $balancehistoryRepository;

    public function __construct(BalanceHistoryRepository $balancehistoryRepository){
        $this->balancehistoryRepository = $balancehistoryRepository;
    }

    /**
     * @return BalanceHistoryRepository
     */
    public function getRepository(): EloquentRepository
    {
        return $this->balancehistoryRepository;
    }

    public function getViewFolder(): string
    {
        return 'admin.balance_history';
    }
}
