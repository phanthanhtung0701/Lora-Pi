<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\NodeModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Node\Node;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function info(Request $request)
    {
        $req = $request->all();
        $date_update = date('Y-m-d H:i:s', strtotime('now'));
        $data = [
            'id' => $req['id'],
            'position' => $req['position'],
            'status' => $req['status'],
            'update_time' => $date_update
        ];
        NodeModel::updateNode($data);
//        $data = NodeModel::getNode($req['id']);
        $json = [
            'success' => true,
            'status'  => Response::HTTP_OK,
            'data' => $request->all(),
            'node' => $data
        ];

        return response()->json($json, Response::HTTP_OK);
    }

    public function getNode(Request $request) {
        $id = $request->all()['id'];
        $data = NodeModel::getNode($id);
        return response()->json($data, Response::HTTP_OK);
    }

    public function getAllNode(Request $request) {
        $data = NodeModel::getAllNode();
        foreach ($data as $node) {
            $update_time = $node->update_time;
            if ((strtotime('now') - strtotime($update_time) > 180)) {
                NodeModel::updateStatus($node->id, ['status' => 16]);
            }
        }
        return response()->json($data, Response::HTTP_OK);
    }

    public function sendAction(Request $request) {
        $id = $request->all()['id'];
        $data = [
            'action' => $request->all()['action']
        ];
        $response = NodeModel::updateAction($id, $data);
        if ($response) {
            $json = [
                'success' => true,
                'status' => Response::HTTP_OK,
            ];
            return response()->json($json, Response::HTTP_OK);
        }
        else {
            $json = [
                'success' => false,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ];
            return response()->json($json, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAction(Request $request) {
        $id = $request->all()['id'];
        $response = NodeModel::getAction($id);
        if ($response) {
            $json = [
                'success' => true,
                'status' => Response::HTTP_OK,
                'action' => $response->action
            ];
            return response()->json($json, Response::HTTP_OK);
        }
        else {
            $json = [
                'success' => false,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ];
            return response()->json($json, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAllAction(Request $request) {
        $response = NodeModel::getAllAction();
        if ($response) {
            $rep = [
                $response[0]->id => $response[0]->action,
                $response[1]->id => $response[1]->action,
                $response[2]->id => $response[2]->action,
                $response[3]->id => $response[3]->action
            ];
            $json = [
                'success' => true,
                'status' => Response::HTTP_OK,
                'data' => $rep
            ];
            return response()->json($json, Response::HTTP_OK);
        }
        else {
            $json = [
                'success' => false,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ];
            return response()->json($json, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
