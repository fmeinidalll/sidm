<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'hypothesis_id',
        'evidence_id',
        'value',
        'condition',
    ];

    public function hypothesis()
    {
        return $this->belongsTo(Hypothesis::class);
    }

    public function evidence()
    {
        return $this->belongsTo(Evidence::class);
    }

    public static function getForward()
    {
        $evidence = Evidence::orderBy('code', 'asc')->get();
        $hypothesis = Hypothesis::orderBy('code', 'asc')->get();
        $data = [
            'hypothesis' => $hypothesis,
            'roles' => [],
        ];
        foreach ($evidence as $key => $evidance) {
            $data['roles'][$key] = (object) [
                'id' => $evidance->id,
                'code' => $evidance->code,
                'name' => $evidance->name,
                'roles' => [],
            ];
            foreach ($hypothesis as $keyHypo => $hypo) {
                $role = Role::where('evidence_id', $evidance->id)->where('hypothesis_id', $hypo->id)->first();
                $data['roles'][$key]->roles[$keyHypo] = (object) [
                    'id' => $role->id ?? NULL,
                    'hypothesis_id' => $hypo->id,
                    'code' => $hypo->code,
                    'name' => $hypo->name,
                    'condition' => $role->condition ?? NULL,
                ];
            }
        }
        return $data;
    }

    public static function setForward($data)
    {
        DB::beginTransaction();
        try {
            foreach ($data as $key => &$item) {
                $parseKey = explode('|', $key);
                $item = (object) [
                    'evidence_id' => $parseKey[0],
                    'hypothesis_id' => $parseKey[1],
                    'condition' => $item,
                ];
                $role = Role::where('evidence_id', $item->evidence_id)->where('hypothesis_id', $item->hypothesis_id)->first();
                if ($role) {
                    $role->update([
                        'condition' => $item->condition
                    ]);
                } else {
                    Role::create([
                        'evidence_id' => $item->evidence_id,
                        'hypothesis_id' => $item->hypothesis_id,
                        'condition' => $item->condition
                    ]);
                }
            }
            DB::commit();
            return [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil disimpan'
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return [
                'code' => 500,
                'status' => 'error',
                'message' => 'Data gagal disimpan'
            ];
        }
    }
}
