<?php

namespace App\Http\Controllers;

use App\Models\Evidence;
use Illuminate\Http\Request;
use App\Models\Hypothesis;
use App\Models\Role;
use App\Models\Value;
use App\Models\Setting;

class RoleController extends Controller
{
    public function index()
    {
        $hypothesis  = Hypothesis::orderBy('code', 'asc')
            ->withWhereHas('role', function ($query) {
                $query->whereNotNull('condition');
            })
            ->get();
        return view('role.index', [
            'title' => 'Rule Certainty Factor',
            'hypothesis' => $hypothesis,
            'setting_type_input' => Setting::find(1),
            'values' => Value::orderby('value', 'asc')->get(),
            'min' => Value::where('value', 0)->first(),
            'max' => Value::where('value', 1)->first(),
        ]);
    }

    public function store(Request $request)
    {
        foreach ($request->id_role as $key => $role) {
            Role::where('id', $role)->update([
                'value' => $request->evidance_value[$key]
            ]);
        }
        return redirect()->route('role.index')->with('success', 'Berhasil melakukan perubahan nilai pada aturan Certainty Factor!');
    }
    public function forward()
    {
        $data = Role::getForward();
        return view('role.forward.index', [
            'title' => 'Rule Forward Chaining',
            ...$data
        ]);
    }

    public function forwardStore(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $response = Role::setForward($data);
        return redirect()->route('role.forward.index')->with($response['status'], $response['message']);
    }
}
