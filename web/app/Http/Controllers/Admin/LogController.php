<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //ファイル名リスト取得
        $logFiles = array();
        $list = glob(storage_path('logs') . "/*");
        foreach ($list as $file) {
            array_push($logFiles, ["title" => basename($file),  "link" => basename($file)]);
        }
        $fileName = "";
        if ($request->file) {
            if (file_exists(storage_path('logs') . "/" . $request->file)) {
                $fileName = $request->file;
            } else {
                return abort(404);
            }
        } else {
            $fileName = $logFiles[0]["title"];
        }
        $logPath = storage_path('logs') . "/" . $fileName;


        //ログの中身取得
        $json
            = mb_convert_encoding(File::get($logPath), 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $json = str_replace(array("\r\n", "\r", "\n"), ',', $json);
        $json = rtrim($json, ',');
        $json = "[" . $json . "]";
        $logData = json_decode($json, true);
        $logData = array_reverse($logData);

        return Inertia::render('Admin/Log/Index', ['logFiles' => $logFiles, "logData" => $logData, "fileName" => $fileName]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
}
