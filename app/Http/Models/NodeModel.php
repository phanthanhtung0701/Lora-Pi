<?php


namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class NodeModel
{
    public static function updateNode($data) {
        $now = date('Y-m-d H:i:s', strtotime('now'));
        DB::table('node')
            ->where('id',$data['id'])
            ->update([
//                'position' => $data['position'],
                'status' => $data['status'],
                'update_time' => $now
            ]);
    }

    public static function getNode($id) {
        $data = DB::table('node')
            ->select('id', 'name', 'position', 'status', 'action')
            ->where('id', $id)
            ->distinct()
            ->get()
            ->first();

        return $data;
    }

    public static function getAllNode() {
        $data = DB::table('node')
            ->select('id', 'name', 'position', 'status', 'action', 'update_time')
            ->distinct()
            ->get()
            ->toArray();

        return $data;
    }

    public static function updateAction($id, $data) {
        return DB::table('node')
            ->where('id', $id)
            ->update(
                $data
            );
    }

    public static function updateStatus($id, $data) {
        return DB::table('node')
            ->where('id', $id)
            ->update(
                $data
            );
    }

    public static function getAction($id) {
        $query = DB::table('node')
            ->where('id', $id)
            ->select('action')
            ->get()
            ->first();
        self::updateAction($id, ['action' => -1]);
        return $query;
    }

    public static function getAllAction() {
        $query = DB::table('node')
            ->select('id','action')
            ->get()
            ->toArray();
        DB::table('node')
            ->update(['action' => -1]);
        return $query;
    }
}
