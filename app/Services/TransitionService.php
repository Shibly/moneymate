<?php

namespace App\Services;

use App\Repositories\Eloquent\TransitionRepository;

class TransitionService
{
    private TransitionRepository $transitionRepository;

    public function __construct(TransitionRepository $transitionRepository)
    {
        $this->transitionRepository = $transitionRepository;
    }
}
