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


        $activeMenu = 'banks';
        $title = get_translation('list_of_banks');
        $banks = $this->bankService->getAll();
        return view('admin.banks.index', compact('activeMenu', 'banks','title'));

    }


    public function create()
    {
        // return view('bank-names.create');
    }


    /**
     * @param StoreBankNameRequest $request
     * @return mixed
     */

    public function store(StoreBankNameRequest $request): mixed
    {
        $validatedData = $request->validated();


        $validatedData['user_id'] = auth()->id();

        $this->bankService->createBank($validatedData);
        notyf()->info('Bank created successfully.');
        return redirect()
            ->route('banks.index');
    }


    /**
     * @param $bankNameId
     * @return mixed
     */
    public function show($bankNameId): mixed
    {
        return response()->json($this->bankService->getBankById($bankNameId));
    }


    /**
     * @param UpdateBankNameRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(UpdateBankNameRequest $request, int $id): mixed
    {
        $bank = $this->bankService->getBankById($id);

        if (!$bank) {
            abort(404);
        }

        // Validate using the request
        $validatedData = $request->validated();

        // Update bank record
        $this->bankService->updateBank($bank, $validatedData);
        notyf()->info(get_translation('bank_name_update_successfully'));
        return redirect()
            ->route('banks.index');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id): mixed
    {
        $bank = $this->bankService->getBankById($id);
        if (!$bank) {
            abort(404);
        }

        $bank->delete();

        return redirect()->route('banks.index');

    }
}
