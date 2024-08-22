<?php

namespace App\Http\Controllers;

use App\Models\Evidence;
use App\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Hypothesis;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;


class HistoryController extends Controller
{
    public function index()
    {
        $history = History::orderby('id', 'desc');
        if (auth()->user()->level == 'patient') {
            $history->where('patient_id', auth()->user()->patient->id);
        }
        $history = $history->get();

        return view('history.index', [
            'title' => 'Riwayat',
            'histores' => $history,
            'hypotesis' => Hypothesis::all(),
            'history' => $history,
        ]);
    }

    public function show(History $history)
    {
        if ($history == null) {
            return redirect()->to('dashboard')->with('status', 'Data gejala tidak ditemukan');
        }
        $hypothesyes = Hypothesis::all();
        $roles = Role::all();
        $evidences = Evidence::all();
        $historyDetail = $history->historyDetails;
        $patient = $history->patient;
        try {
            foreach ($hypothesyes as $hypothesis) {
                $arrid = 0;
                $cf_old = 0;
                foreach ($roles as  $role) {
                    if ($hypothesis->id == $role->hypothesis_id) {
                        $ard = $arrid++;
                        if ($historyDetail[$ard]->value != 0) {
                            $cfhe = $role->value * $historyDetail[$ard]->value;
                            $cf_old === 1 ? $cfhe : $cf_old = $cf_old + $cfhe * (1 - $cf_old);
                        }
                    }
                }
                $menu[] = array(
                    'id' => $hypothesis->id,
                    'nama' => $hypothesis->name,
                    'hsl' => number_format($cf_old * 100, 6, '.', ''),
                    'slsi' => $hypothesis->solution
                );
            }
            $b = 0;
            foreach ($menu as $record) {
                if ($record['hsl'] > $b) {
                    $a = $record['id'];
                    $b = $record['hsl'];
                }
            }

            if ($b == 0) {
                return redirect()->back()->with('status', 'Setidaknya isi salah satu dari gejala yang ada!')->withInput();
            }

            return view(
                'expert_result',
                [
                    'title' => 'Hasil Deteksi Dini',
                    'hypothesyes' => $hypothesyes,
                    'roles' => $roles,
                    'evidences' => $evidences,
                    'history' => $history,
                    'historyDetail' => $historyDetail,
                    'patient' => $history->patient,
                ]
            );
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal memproses data <br>' . $th);
        }
    }

    public function print(History $history)
    {
        if ($history == null) {
            return redirect()->to('dashboard')->with('status', 'Data gejala tidak ditemukan');
        }
        $roles = Role::all();
        $evidences = Evidence::all();
        $historyDetail = $history->historyDetails;
        $patient = $history->patient;
        $hypothesis = $history->hypothesis;
        try {
            $arrid = 0;
            $cf_old = 0;
            foreach ($roles as  $role) {
                if ($hypothesis->id == $role->hypothesis_id) {
                    $ard = $arrid++;
                    if ($historyDetail[$ard]->value != 0) {
                        $cfhe = $role->value * $historyDetail[$ard]->value;
                        $cf_old === 1 ? $cfhe : $cf_old = $cf_old + $cfhe * (1 - $cf_old);
                    }
                }
            }
            $menu[] = array(
                'id' => $hypothesis->id,
                'nama' => $hypothesis->name,
                'hsl' => number_format($cf_old * 100, 6, '.', ''),
                'slsi' => $hypothesis->solution
            );
            $b = 0;
            foreach ($menu as $record) {
                if ($record['hsl'] > $b) {
                    $a = $record['id'];
                    $b = $record['hsl'];
                }
            }

            if ($b == 0) {
                return redirect()->back()->with('status', 'Setidaknya isi salah satu dari gejala yang ada!')->withInput();
            }


            $document = [
                'code' => Str::lower(Str::random(32)),
                'date' => now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ];
            $pdf = Pdf::loadView('history.print', [
                'title' => 'Hasil Deteksi Dini - ' . now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'roles' => $roles,
                'evidences' => $evidences,
                'history' => $history,
                'historyDetail' => $historyDetail,
                'patient' => $patient,
                'hypothesis' => $hypothesis,
                'document' => $document,
            ]);
            return $pdf->stream();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal memproses data <br>' . $th);
        }
    }
}
