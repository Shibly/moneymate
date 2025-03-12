<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InstallationController extends Controller
{
    public function showInstallForm()
    {
        if (File::exists(storage_path('app/installed'))) {
            abort(403, 'Application is already installed.');
        }

        $requirements = [
            'php_version' => version_compare(PHP_VERSION, '8.2', '>='),
            'open_ssl_extension' => extension_loaded('openssl'),
            'pdo_php_extension' => extension_loaded('pdo'),
            'mbstring_php_extension' => extension_loaded('mbstring'),
            'tokenizer_php_extension' => extension_loaded('tokenizer'),
            'xml_php_extension' => extension_loaded('xml'),
            'ctype_php_extension' => extension_loaded('ctype'),
        ];


        $allRequirementsMet = collect($requirements)->every(fn($status) => $status);

        return view('installer.install', compact('requirements', 'allRequirementsMet'));
    }

    public function install(Request $request): RedirectResponse
    {

        $requirements = [
            'php_version' => version_compare(PHP_VERSION, '8.2', '>='),
            'open_ssl_extension' => extension_loaded('openssl'),
            'pdo_php_extension' => extension_loaded('pdo'),
            'mbstring_php_extension' => extension_loaded('mbstring'),
            'tokenizer_php_extension' => extension_loaded('tokenizer'),
            'xml_php_extension' => extension_loaded('xml'),
            'ctype_php_extension' => extension_loaded('ctype'),
        ];


        $allRequirementsMet = collect($requirements)->every(fn($status) => $status);
        if (!$allRequirementsMet)
        {
            return  redirect()->back()->withErrors('Installation Requirements not met.');
        }

        $validated = $request->validate([
            'db_name' => 'required|string',
            'db_user' => 'required|string',
            'db_password' => 'required',
            'db_host' => 'required|string',
            'db_port' => 'required|numeric',
        ], [
            'db_name.required' => 'Database name is required.',
            'db_user.required' => 'Database user name is required.',
            'db_password.required' => 'Database password is required.',
            'db_host.required' => 'Host name is required.',
            'db_port.required' => 'Port name is required.',
        ]);

        // Update .env file with database credentials
        $this->updateEnv([
            'DB_HOST' => $validated['db_host'],
            'DB_PORT' => $validated['db_port'],
            'DB_DATABASE' => $validated['db_name'],
            'DB_USERNAME' => $validated['db_user'],
            'DB_PASSWORD' => $validated['db_password'] ?? '',
        ]);

        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['db_error' => 'Unable to connect to the database. Please check the credentials or try again']);
        }

        return redirect(route('databaseImport'));

    }

    public function databaseImport(): RedirectResponse
    {
        // Test database connection
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['db_error' => 'Unable to connect to the database. Please check the credentials.']);
        }

        try {
            Artisan::call('migrate:fresh');
            Artisan::call('migrate', ['--force' => true]);
            Artisan::call('db:seed', ['--force' => true]);
            Artisan::call('storage:link');
        } catch (\Exception $e) {
            return back()->withErrors(['db_error' => 'Error during migration or seeding: ' . $e->getMessage()]);
        }

        $user = User::find(1);
        Auth::login($user);
        File::put(storage_path('app/installed'), 'Installed on ' . now());
        return redirect(route('dashboard'))->with('success', 'Installation completed successfully');
    }

    private function updateEnv(array $data): void
    {
        $envPath = base_path('.env');
        $content = File::get($envPath);

        foreach ($data as $key => $value) {
            $pattern = "/^{$key}=.*/m";
            $replacement = "{$key}={$value}";
            $content = preg_replace($pattern, $replacement, $content);
        }
        File::put($envPath, $content);

        Artisan::call('config:clear');
        Artisan::call('config:cache');
    }
}
