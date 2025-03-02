<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    public function index()
    {
        $activeMenu = "application-settings";
        $title = get_translation('application_settings');
        return view('admin.application-settings.settings', compact('activeMenu', 'title'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:512',
            'smtp_host' => 'nullable|string|max:255',
            'smtp_port' => 'nullable|integer',
            'smtp_username' => 'nullable|string|max:255',
            'smtp_password' => 'nullable|string|max:255',
            'smtp_encryption' => 'nullable|in:tls,ssl,none',
            'smtp_from_email' => 'nullable|email|max:255',
            'app_timezone' => 'nullable|in:' . implode(',', \DateTimeZone::listIdentifiers()) . '|max:255',
        ]);

        $inputs = $request->except('_token', 'smtp_password');

        foreach ($inputs as $key => $value) {
            $option = Option::firstOrCreate(['key' => $key]);
            $option->value = $value;
            $option->save();
        }


        if ($request->hasFile('app_logo')) {
            $logoName = time() . '.' . $request->file('app_logo')->getClientOriginalExtension();
            $logoPath = $request->file('app_logo')->storeAs('', $logoName, 'local');
            Option::updateOrCreate(['key' => 'app_logo'], ['value' => $logoPath]);
        }


        if ($request->hasFile('favicon')) {
            $faviconName = time() . '.' . $request->file('favicon')->getClientOriginalExtension();
            $faviconPath = $request->file('favicon')->storeAs('', $faviconName, 'local');
            Option::updateOrCreate(['key' => 'favicon'], ['value' => $faviconPath]);
        }


        if ($request->has('smtp_host') || $request->has('smtp_port') || $request->has('smtp_username') || $request->has('smtp_password') || $request->has('smtp_encryption') || $request->has('smtp_from_email')) {
            $this->updateEnv([
                'MAIL_HOST' => $request->input('smtp_host'),
                'APP_NAME' => '"' . $request->input('application_name') . '"',
                'MAIL_PORT' => $request->input('smtp_port'),
                'MAIL_USERNAME' => $request->input('smtp_username'),
                'MAIL_PASSWORD' => $request->input('smtp_password'),
                'MAIL_ENCRYPTION' => $request->input('smtp_encryption'),
                'MAIL_FROM_ADDRESS' => $request->input('smtp_from_email'),
            ]);
        }

        // Handling app timezone
        if ($request->has('app_timezone')) {
            $this->updateEnv([
                'APP_TIMEZONE' => $request->input('app_timezone'),
            ]);
        }

        Artisan::call('optimize:clear');

        notyf()->info(get_translation('application_settings_has_been_updated'));
        return redirect()->route('settings.index');
    }


    /**
     *
     * @param array $data
     * @return void
     */
    protected function updateEnv(array $data)
    {
        $path = base_path('.env');
        $envContent = file_get_contents($path);

        foreach ($data as $key => $value) {

            if ($value) {
                $pattern = "/^" . preg_quote($key, '/') . "=[^\n]*/m";
                $replacement = $key . '=' . $value;
                $envContent = preg_replace($pattern, $replacement, $envContent);
            }
        }
        file_put_contents($path, $envContent);
    }


}
