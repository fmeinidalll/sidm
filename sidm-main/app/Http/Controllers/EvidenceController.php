<?php

namespace App\Http\Controllers;

use App\Models\Evidence;
use App\Models\Hypothesis;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Http\Request;

class EvidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('evidence.index', [
            'title' => 'Gejala',
            'evidences' => Evidence::orderby('code', 'asc')->get(),
        ]);
    }

    public function autoCode()
    {
        $lates_evidence = Evidence::orderby('code', 'desc')->first();
        $code = $lates_evidence->code;
        $order = (int) substr($code, 2, 4);
        $order++;
        $letter = "G";
        $code = $letter . sprintf("%04s", $order);
        return $code;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('evidence.create', [
            'title' => 'Buat Gejala',
            'code' => $this->autoCode()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEvidenceRequest  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|max:255|unique:evidence',
            'name' => 'required|max:255'
        ]);

        $evidence = Evidence::create([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        $hypothesis = Hypothesis::all();

        foreach ($hypothesis as $h) {
            Role::create([
                'hypothesis_id' => $h->id,
                'evidence_id' => $evidence->id,
                'value' => 0.0
            ]);
        }

        return redirect()->route('evidence.index')->with('status', 'Data created succesfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evidence  $evidence
     * @return \Illuminate\Http\Response
     */
    public function show(Evidence $evidence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evidence  $evidence
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evidence = Evidence::where('id', $id)->first();
        return view('evidence.edit', [
            'title' => 'Ubah Gejala',
            'evidence' => $evidence
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEvidenceRequest  $request
     * @param  \App\Models\Evidence  $evidence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        Evidence::where('id', $id)
            ->update([
                'name' => $request->name
            ]);

        return redirect()->route('evidence.index')->with('status', 'Data updated succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evidence  $evidence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Evidence::where('id', $id)->delete();
        Role::where('evidence_id', $id)->delete();
        return redirect()->route('evidence.index')->with('status', 'Data deleted succesfully!');
    }
}
