<?php

namespace App\Repositories\Eloquent;

use App\Models\BankAccount;
use App\Models\Borrow;
use App\Models\Debt;
use App\Models\DebtCollection;
use App\Models\Lend;
use App\Models\Repayment;
use App\Repositories\Contracts\DebtLoanRepositoryInterface;
use Illuminate\Support\Collection;
use Exception;
use Illuminate\Support\Facades\DB;

class DebtLoanRepository implements DebtLoanRepositoryInterface
{

    public function getAll()
    {
        return Debt::where('user_id', auth()->id())
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @param $id
     * @return Debt
     */

    public function getById(int $id): Debt
    {
        return Debt::findOrFail($id);
    }

    /**
     * @param array $data
     * @return mixed
     * @throws Exception
     */

    public function store(array $data): mixed
    {

        $selectedBankAccount = BankAccount::find($data['account_id']);

        $usd_amount = convert_to_usd_amount($data['currency_id'], $data['amount']);
        $exchange_amount = convert_to_exchange_amount($selectedBankAccount->currency_id, $usd_amount);

        if ($data['type'] === 'borrow') {
            $debtAmount = -$data['amount'];
            $debtExchangeAmount = -$exchange_amount;
            $debtUsdAmount = -$usd_amount;
        } else {

            if ($exchange_amount > $selectedBankAccount->balance)
            {
                throw new Exception('Insufficient balance in the selected bank account. Please use another bank account to repay.');
            }

            $debtAmount = $data['amount'];
            $debtExchangeAmount = $exchange_amount;
            $debtUsdAmount = $usd_amount;
        }

        DB::beginTransaction();

        try {
            $debt = Debt::firstOrCreate([
                'user_id' => auth()->user()->id,
                'amount' => $debtAmount,
                'exchange_amount' => $debtExchangeAmount,
                'usd_amount' => $debtUsdAmount,
                'account_id' => $data['account_id'],
                'currency_id' => $data['currency_id'],
                'type' => $data['type'],
                'person' => $data['person'],
                'date' => $data['date'],
                'note' => $data['note']
            ]);

            $bankAccount = BankAccount::find($debt->account_id);
            // Means you are lending money to someone.

            if ($data['type'] === 'lend') {
                Lend::create([
                    'user_id' => auth()->user()->id,
                    'amount' => $debt->amount,
                    'exchange_amount' => $exchange_amount,
                    'usd_amount' => $usd_amount,
                    'account_id' => $debt->account_id,
                    'currency_id' => $data['currency_id'],
                    'date' => $debt['date'],
                    'debt_id' => $debt->id
                ]);

                // Update Associated bank account by decreasing account balance
                $bankAccount->balance -= $exchange_amount;
                $bankAccount->usd_balance -= $usd_amount;
                $bankAccount->save();

            }


            // Means you are lending money form someone.

            if ($debt['type'] === 'borrow') {
                Borrow::create([
                    'amount' => ($debt->amount * -1),
                    'exchange_amount' => ($exchange_amount * -1),
                    'usd_amount' => ($usd_amount * -1),
                    'account_id' => $debt->account_id,
                    'currency_id' => $data['currency_id'],
                    'date' => $debt->date,
                    'debt_id' => $debt->id
                ]);

                // Update Associated bank account by increasing account balance
                $bankAccount->balance += $exchange_amount;
                $bankAccount->usd_balance += $usd_amount;
                $bankAccount->save();
            }

            DB::commit();

            return $debt;

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception( $e->getMessage());
        }



    }

    public function storeDebtCollection(array $data, int $debt_id): mixed
    {

        $bankAccount = BankAccount::find($data['account_id']);
        $debt = Debt::findOrFail($debt_id);
        $usd_amount = convert_to_usd_amount($data['currency_id'], $data['amount']);
        $exchange_amount = convert_to_exchange_amount($bankAccount->currency_id, $usd_amount);

        if ($exchange_amount > $bankAccount->balance)
        {
            throw new Exception('Insufficient balance in the selected bank account. Please use another bank account to repay.');
        }

        $data['debt_id'] = $debt_id;
        $data['exchange_amount'] = $exchange_amount;
        $data['usd_amount'] = $usd_amount;

        DB::beginTransaction();

        try {
            DebtCollection::create($data);
            $exchange_amount_for_debt = convert_to_exchange_amount($debt->currency_id, $usd_amount);
            $debt->exchange_amount -= $exchange_amount_for_debt;
            $debt->usd_amount -= $usd_amount;
            $debt->save();

            $bankAccount->balance += $exchange_amount;
            $bankAccount->usd_balance += $usd_amount;
            $bankAccount->save();

            DB::commit();

            return $debt;

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception( $e->getMessage());
        }

    }

    public function storeRepayment(array $data, int $debt_id): mixed
    {
        $bankAccount = BankAccount::find($data['account_id']);
        $debt = Debt::find($debt_id);

        $usd_amount = convert_to_usd_amount($data['currency_id'], $data['amount']);
        $exchange_amount = convert_to_exchange_amount($bankAccount->currency_id, $usd_amount);

        if ($exchange_amount > $bankAccount->balance) {
            throw new Exception('Insufficient balance in the selected bank account. Please use another bank account to repay.');
        }



        if ($exchange_amount > ($debt->exchange_amount * -1)) {
            throw new Exception('You have entered invalid amount');
        }

        $data['exchange_amount'] = $exchange_amount;
        $data['usd_amount'] = $usd_amount;
        $data['debt_id'] = $debt_id;

        DB::beginTransaction();
        try {

            Repayment::create($data);
            $exchange_amount_for_debt = convert_to_exchange_amount($debt->currency_id, $usd_amount);
            $debt->exchange_amount += $exchange_amount_for_debt;
            $debt->usd_amount += $usd_amount;
            $debt->save();


            $bankAccount->balance -= $exchange_amount;
            $bankAccount->usd_balance -= $usd_amount;
            $bankAccount->save();

            DB::commit();

            return $debt;

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception( $e->getMessage());
        }

    }



    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $debt = Debt::find($id);

        $bankAccount = BankAccount::find($debt->account_id);
        $bankAccount->balance += $debt->exchange_amount;
        $bankAccount->usd_balance += $debt->usd_amount;
        $bankAccount->save();

        Lend::where('debt_id', $id)->delete();
        Borrow::where('debt_id', $id)->delete();

        $debt->delete();

        return true;

    }


}
