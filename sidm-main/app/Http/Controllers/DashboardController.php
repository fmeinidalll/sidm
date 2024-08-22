<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Evidence;
use App\Models\Hypothesis;
use App\Models\User;
use App\Models\Role;
use App\Models\History;
use App\Models\HistoryDetail;
use App\Models\Setting;
use App\Models\Value;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DashboardController extends Controller
{
    public function index()
    {
        $history = History::orderby('id', 'desc');

        return view('dashboard', [
            'title' => 'Dashboard',
            'count_user' => User::count(),
            'count_evidence' => Evidence::count(),
            'count_hypotesis' => Hypothesis::count(),
            'count_history' => $history->count(),
            'histores' => $history->get(),
            'hypotesis' => Hypothesis::all(),
            'history' => $history->get(),
        ]);
    }

    public function expert_system()
    {
        $evidences = Evidence::all();

        return view('expert_system', [
            'title' => 'Deteksi Dini',
            'evidences' => $evidences,
            'setting_type_input' => Setting::find(1),
            'values' => Value::orderby('value', 'asc')->get(),
            'min' => Value::where('value', 0)->first(),
            'max' => Value::where('value', 1)->first(),
            'data' => Patient::where('user_id', auth()->user()->id)->first(),
        ]);
    }

    public function expert_system_post(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
        ]);

        $_evidence = $request->evidance_value;
        unset($_evidence[0]);
        unset($_evidence[1]);
        if (array_sum($_evidence) == 0) {
            return redirect()->back()->with('status', 'Setidaknya isi salah satu dari gejala yang ada!')->withInput();
        }

        $hypothesyes = Hypothesis::all();
        $roles = Role::all();
        DB::beginTransaction();
        try {
            foreach ($hypothesyes as $hypothesis) {
                $arrid = 0;
                $cf_old = 0;
                foreach ($roles as  $role) {
                    if ($hypothesis->id == $role->hypothesis_id) {
                        $ard = $arrid++;
                        if ($request->evidance_value[$ard] != 0) {
                            $cfhe = $role->value * $request->evidance_value[$ard];
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
            if (auth()->user()->level != 'patient') {
                $patient = Patient::create([
                    'name' => $request->name,
                    'dob' => $request->dob,
                    'gender' => $request->gender,
                    'address' => $request->address,
                ]);
            } else {
                $patient = auth()->user()->patient;
            }

            $history = History::create([
                'hypothesis_id' => $a,
                'name' => $request->name,
                'description' => $request->description,
                'value' => $b,
                'result_treatment' => $request->result_treatment,
                'random_treatment' => $request->random_treatment,
                'patient_id' => $patient->id,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);
            $sHistoryDetail = [];
            foreach ($request->id_evidence as $key => $evidence) {
                $sHistoryDetail[] = [
                    'history_id' => $history->id,
                    'evidence_id' => $evidence,
                    'value' => $request->evidance_value[$key],
                ];
            }

            HistoryDetail::insert($sHistoryDetail);
            DB::commit();
            return redirect()->route('history.show', $history->id);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memproses data <br>' . $th);
        }
    }

    public function home()
    {
        return view('home', [
            'title' => 'Home',
            'setting' => Setting::find(1),
        ]);
    }

    public function login()
    {
        return view('login', [
            'title' => 'Login',
        ]);
    }

    public function login_process(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required|min:6|'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('/');
        }
        return redirect('/login')->with('status', 'Login Gagal! Silahkan cek email dan password anda!');
    }
    public function register()
    {
        return view('register', [
            'title' => 'Login',
        ]);
    }

    public function register_process(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|',
            're-password' => 'required|same:password',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'level' => 'patient',
            ]);
            return redirect('/login')
                ->with('success', 'Pendaftaran berhasil! Silahkan login dengan akun yang didaftarkan sebelumnya');
        } catch (\Throwable $th) {
            return redirect('/register')->with('status', 'Pendaftaran gagal! Mohon hubungi Administrator!');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function profile()
    {
        $user = User::find(auth()->user()->id);
        return view('profile', [
            'title' => 'Profile',
            'user' => $user,
        ]);
    }

    public function profile_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            // 'password' => 'required|min:6|confirmed',
            // 'repassword' => 'required|same:password',
        ]);


        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/profile')->with('status', 'Profile Berhasil Diupdate!');
    }
    public function biodata(Request $request)
    {
        $data = $request->user()->patient ?? $request->user();
        return view('biodata', [
            'title' => 'Biodata',
            'data' => $data,
        ]);
    }
    public function biodataStore(Request $request)
    {

        $data =  $request->validate([
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'age' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'address' => 'nullable',
            'phone_number' => 'nullable',
            'occupation' => 'nullable',
        ]);
        DB::beginTransaction();
        try {
            $request->user()->update([
                'name' => $request->name,
            ]);
            $request->user()->patient()->updateOrCreate([
                'user_id' => $request->user()->id,
            ], $data);
            DB::commit();
            return redirect()->route('biodata.index')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('biodata.index')->with('error', 'Data Gagal Disimpan');
        }
    }
    public function reportHypothesis(Request $request)
    {
        // check if post request
        if ($request->isMethod('post')) {
            $request->validate([
                'date_start' => 'nullable|date',
                'date_end' => 'nullable|date',
                'hypothesis' => 'nullable|exists:hypotheses,id'
            ]);
        }

        if ($request->date_start && $request->date_end) {
            $request->validate([
                'date_start' => 'required|date',
                'date_end' => 'required|date',
            ]);
        }

        $data = Hypothesis::withCount(['history' => function ($query) use ($request) {
            if ($request->date_start && $request->date_end) {
                $query->whereBetween('created_at', [$request->date_start, $request->date_end]);
            }
        }]);

        if ($request->hypothesis) {
            $data->where('id', $request->hypothesis);
        }

        $data = $data->get();

        return view('report/hypothesis/index', [
            'title' => 'Laporan Penyakit',
            'data' => $data,
            'hypothesis' => Hypothesis::orderBy('code', 'asc')->get(),
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'hypothesis_id' => $request->hypothesis,
        ]);
    }
    public function reportHypothesisPrint(Request $request)
    {
        $data = Hypothesis::withCount(['history' => function ($query) use ($request) {
            if ($request->date_start && $request->date_end) {
                $query->whereBetween('created_at', [$request->date_start, $request->date_end]);
            }
        }]);

        if ($request->hypothesis) {
            $data->where('id', $request->hypothesis);
        }

        $data = $data->get();
        $document = [
            'code' => Str::lower(Str::random(32)),
            'date' => now('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ];
        $pdf = Pdf::loadView('report/hypothesis/print', [
            'title' => 'Laporan Penyakit - ' . now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'data' => $data,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'hypothesis_id' => $request->hypothesis,
            'document' => $document,
        ]);
        return $pdf->stream();
    }

    public function reportUser(Request $request)
    {
        // check if post request
        if ($request->isMethod('post')) {
            $request->validate([
                'date_start' => 'nullable|date',
                'date_end' => 'nullable|date',
                'hypothesis' => 'nullable|exists:hypotheses,id'
            ]);
        }

        $data = History::withWhereHas('patient')->with('hypothesis');
        if ($request->date_start && $request->date_end) {
            $data->whereBetween('created_at', [$request->date_start, $request->date_end]);
        }
        if ($request->hypothesis) {
            $data->where('hypothesis_id', $request->hypothesis);
        }
        $data = $data->with(['historyDetails' => function ($query) use ($request) {
            $query->where('value', '>', 0);
        }]);
        $data = $data->get();

        return view('report/user/index', [
            'title' => 'Laporan Pengguna',
            'data' => $data,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'hypothesis_id' => $request->hypothesis,
            'hypothesis' => Hypothesis::orderBy('code', 'asc')->get(),
        ]);
    }
    public function reportUserPrint(Request $request)
    {
        $data = History::withWhereHas('patient')->with('hypothesis');
        if ($request->date_start && $request->date_end) {
            $data->whereBetween('created_at', [$request->date_start, $request->date_end]);
        }
        $data = $data->get();
        $document = [
            'code' => Str::lower(Str::random(32)),
            'date' => now('Asia/Jakarta')->format('Y-m-d H:i:s'),
        ];
        $pdf = Pdf::loadView('report/user/print', [
            'title' => 'Laporan Pengguna - ' . now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'data' => $data,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'document' => $document,
        ]);
        return $pdf->stream();
    }
}
