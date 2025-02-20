<?php

namespace App\Http\Controllers;

use App\Services\TransitionService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransitionController extends Controller
{
    protected TransitionService $transitionService;

    public function __construct(TransitionService $transitionService)
    {
        $this->transitionService = $transitionService;
    }

    /**
     * @return View
     */

    public function balanceTransfer(): View
    {
        $data['activeMenu'] = 'balance-transfer';
        return view('admin.transition.balance-transfer', $data);
    }
}
