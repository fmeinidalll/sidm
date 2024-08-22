<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Value;
use App\Models\Role;

class SettingController extends Controller
{
    public function index()
    {
        // dd(Setting::where('id', 1)->get());
        return view('setting', [
            'title' => 'Setting',
            'setting' => Setting::find(1),
            'values' => Value::orderby('value', 'asc')->get(),
            'count_value' => Value::count(),
        ]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            // 'evidence_name' => 'required',
            // 'hypothesis_name' => 'required',
        ]);

        // dd($request->all());

        $setting = Setting::find(1);
        $setting->title = $request->title;
        $setting->description = $request->description;
        // $setting->evidence_name = $request->evidence_name;
        // $setting->hypothesis_name = $request->hypothesis_name;

        $setting->save();

        return redirect()->route('setting.index')->with('success', 'Setting berhasil diubah');
    }

    public function saveValue(Request $request)
    {
        if (Value::count() === count($request->value)) {
            foreach ($request->name as $key => $name) {
                if ($name == null) {
                    $name = $key + 1 . "th Option";
                }

                Value::where('id', $request->value_id[$key])
                    ->update([
                        'name' => $name
                    ]);
            }
        } else {
            $length = count($request->value) - 1;

            $val_per_point = 1 / $length;

            Value::truncate();

            foreach ($request->name as $key => $name) {
                if ($name == null) {
                    $name = $key + 1 . "th Option";
                }

                if ($key === 0) {
                    $value = 0;
                } else {
                    $value = $val_per_point * $key;
                }
                Value::create([
                    'name' => $name,
                    'value' => $value,
                ]);
            }

            Role::query()->update([
                'value' => 0.0
            ]);
        }


        $setting = Setting::find(1);
        $setting->input_type = $request->input_type;

        $setting->save();

        return redirect()->route('setting.index');
    }
}
