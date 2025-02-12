<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBankNameRequest;
use App\Http\Requests\UpdateBankNameRequest;
use App\Services\BankService;
use Illuminate\Http\RedirectResponse;

class BankNameController extends Controller
{
    protected BankService $bankService;

    /**
     * BankNameController constructor.
     */
    public function __construct(BankService $bankService)
    {
        $this->bankService = $bankService;
    }


    public function index()
    {

    }


    public function create()
    {
        // return view('bank-names.create');
    }


    public function store(StoreBankNameRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();


        $validatedData['user_id'] = auth()->id();

        $bank = $this->bankService->createBank($validatedData);

        return redirect()
            ->route('bank-names.index')
            ->with('success', 'Bank created successfully!');
    }

    /**
     * Display the specified resource.
     * GET /bank-names/{id}
     */
    public function show($id)
    {
        // If needed:
        // $bank = $this->bankService->getBankById($id);
        // if (!$bank) {
        //     abort(404);
        // }
        // return view('bank-names.show', compact('bank'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /bank-names/{id}/edit
     */
    public function edit($id)
    {
        // $bank = $this->bankService->getBankById($id);
        // if (!$bank) {
        //     abort(404);
        // }
        // return view('bank-names.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     * PUT/PATCH /bank-names/{id}
     */
    public function update(UpdateBankNameRequest $request, $id): RedirectResponse
    {
        $bank = $this->bankService->getBankById($id);
        if (!$bank) {
            abort(404);
        }

        $validatedData = $request->validated();
        $this->bankService->updateBank($bank, $validatedData);

        return redirect()
            ->route('bank-names.index')
            ->with('success', 'Bank updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /bank-names/{id}
     */
    public function destroy($id): RedirectResponse
    {
        $bank = $this->bankService->getBankById($id);
        if (!$bank) {
            abort(404);
        }

        $bank->delete();

        return redirect()
            ->route('bank-names.index')
            ->with('success', 'Bank deleted successfully!');
    }
}
