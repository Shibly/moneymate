<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();
        $translations = [
            ['code' => 'en', 'key' => 'login_to_your_account', 'value' => 'Login to your account', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'email_address', 'value' => 'Email Address', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'password', 'value' => 'Password', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'i_forget_password', 'value' => 'I forget Password', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'sign_in', 'value' => 'Sign In', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'your_email_com', 'value' => 'your@email.com', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'your_password', 'value' => 'Your Password', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'categories', 'value' => 'Categories', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'income_and_expense_categories', 'value' => 'Income and Expense Categories', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'category_name', 'value' => 'Category Name', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'category_type', 'value' => 'Category Type', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'action', 'value' => 'Action', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'edit', 'value' => 'Edit', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'delete', 'value' => 'Delete', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'add_new_category', 'value' => 'Add New Category', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'category_type', 'value' => 'Category Type', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'cancel', 'value' => 'Cancel', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'add_new', 'value' => 'Add New', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'conform_deletion', 'value' => 'Confirm Deletion', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'are_you_sure_to_delete_this_category', 'value' => 'Are you sure to delete this category ?', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'this_action_can_not_be_undone', 'value' => 'This action can not be undone.', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'currencies', 'value' => 'Currencies', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'manage_currencies', 'value' => 'Manage Currencies', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'currency', 'value' => 'Currency', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'exchange_rate', 'value' => 'Exchange Rate', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'is_default', 'value' => 'Is Default', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'is_default', 'value' => 'Is Default', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'edit_currency', 'value' => 'Edit Currency', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'currency_name_or_symbol', 'value' => 'Currency Name or Symbol', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'are_you_sure_to_delete_this_currency', 'value' => 'Are you sure to delete this currency ?', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'banks', 'value' => 'Banks', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'List Of Banks', 'value' => 'List Of Banks', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'bank_name', 'value' => 'Bank Name', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'edit_bank_name', 'value' => 'Edit Bank Name', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'edit_bank_name', 'value' => 'Edit Bank Name', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'update_bank', 'value' => 'Update Bank', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'are_you_sure_to_delete_this_bank', 'value' => 'Are you sure to delete this bank ?', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'en', 'key' => 'yes_delete', 'value' => 'Yes Delete', 'created_at' => $now, 'updated_at' => $now],


        ];

        // Insert the translations into the database
        DB::table('translations')->insert($translations);
    }
}
