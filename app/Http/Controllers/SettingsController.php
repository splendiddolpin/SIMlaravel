<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Http\Requests\UpdatesettingsRequest;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch the latest settings from the database
        return view('librarian.settings', ['data' => Settings::latest()->first()]);
    }

    /**
     * Update the settings.
     *
     * @param  \App\Http\Requests\UpdatesettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesettingsRequest $request)
    {
        // Fetch the latest settings record
        $setting = Settings::latest()->first();

        // Update the return_days and denda values
        $setting->return_days = $request->return_days;  // Ensure it matches the column name in the database
        $setting->denda = $request->denda;  // Ensure denda is being saved correctly as per your form

        // Save the updated settings
        $setting->save();

        // Redirect back to the settings page with a success message
        return redirect()->route('librarian.settings')->with('success', 'Settings updated successfully!');
    }

}
