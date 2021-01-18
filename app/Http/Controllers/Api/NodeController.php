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
        $data = [
            'id' => $req['id'],
            'position' => $req['position'],
            'status' => $req['status']
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
            $json = [
                'success' => true,
                'status' => Response::HTTP_OK,
                'data' => $response
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
