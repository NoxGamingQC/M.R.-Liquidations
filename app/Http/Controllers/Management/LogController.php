<?php

namespace App\Http\Controllers\Management;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\PageList;

class LogController extends Controller
{
    public function index(Request $request)
    {
        if(PageList::isInMaintenance('management.logs')) {
            abort(503);
        }
        if (Auth::user()) {
            if (Auth::user()->isDev) {
                if($request->date) {
                    $date = new Carbon($request->date);
                } else {
                    $date = new Carbon(today());
                }
                $parsedDate = $date->format('Y-m-d');
                $filePath = storage_path("logs/laravel-{$parsedDate}.log");
                $data = [];
                $fileData = [];
                $dataDate = [];
                $dataStatus = [];
                $dataStatusColor = [];
                if(File::exists($filePath)) {
                    $rawData = explode("\n", File::get($filePath));
                    $errorNumber = 0;
                    foreach($rawData as $key => $value) {
                        if ($value == '"} ') {
                            $errorNumber += 1;
                        }
                        if(array_key_exists($errorNumber, $fileData)) {
                            if(strlen($value) > 1) {
                                $newData = $fileData[$errorNumber] . '\n' . utf8_encode($value);
                                $fileData[$errorNumber] = $newData;
                            }
                        } else {
                            if($value !== '"} ' && strlen($value) > 1) {
                                array_push($fileData, utf8_encode($value));
                            }
                        }
                    }
                    foreach($fileData as $key => $value) {
                        $logDate = str_replace("[", "", explode("]", $value)[0]) ? Carbon::parse(str_replace("[", "", explode("]", $value)[0]))->format('Y-m-d H:i:s') : '';
                        $logStatus = "undefined";
                        if(str_contains($value, 'developement.ERROR') || str_contains($value, 'production.ERROR')) {
                            $logStatus = "error";
                            $logStatusColor = "danger";
                        } elseif(str_contains($value, 'developement.WARNING') || str_contains($value, 'production.WARNING')) {
                            $logStatus = "warning";
                            $logStatusColor = "warning";
                        } elseif(str_contains($value, 'developement.INFO') || str_contains($value, 'production.INFO')) {
                            $logStatus = "info";
                            $logStatusColor = "info";
                        } elseif(str_contains($value, 'developement.ALERT') || str_contains($value, 'production.ALERT')) {
                            $logStatus = "alert";
                            $logStatusColor = "danger";
                        } elseif(str_contains($value, 'developement.EMERGENCY') || str_contains($value, 'production.EMERGENCY')) {
                            $logStatus = "emergency";
                            $logStatusColor = "danger";
                        } elseif(str_contains($value, 'developement.CRITICAL') || str_contains($value, 'production.CRITICAL')) {
                            $logStatus = "critical";
                            $logStatusColor = "danger";
                        } elseif(str_contains($value, 'developement.NOTICE') || str_contains($value, 'production.NOTICE')) {
                            $logStatus = "notice";
                            $logStatusColor = "warning";
                        } elseif(str_contains($value, 'developement.DEBUG') || str_contains($value, 'production.DEBUG')) {
                            $logStatus = "debug";
                            $logStatusColor = "primary";
                        } else {
                            $logStatusColor = "default";
                        }
                }
                    array_push($dataDate, $logDate);
                    array_push($dataStatusColor, $logStatusColor);
                    array_push($dataStatus, $logStatus);
                }
                if(File::exists($filePath)) {
                    $data = [
                        'lastModified' => Carbon::parse(date("Y-m-d H:i:s", File::lastModified($filePath))),
                        'size' => File::size($filePath),
                        'isReadable' => File::isReadable($filePath),
                        'file' => $fileData,
                        'elementsDates' => $dataDate,
                        'elementsStatus' => $dataStatus,
                        'elementsStatusColor' => $dataStatusColor
                    ];
                }
                return view('management.logs', compact('date', 'data'));
            }
        }
        abort(403);
    }

    public function download(Request $request)
    {
        if (Auth::user()) {
            if (Auth::user()->isAdmin || Auth::user()->isDev) {
                if($request->date) {
                    $date = new Carbon($request->date);
                } else {
                    $date = new Carbon(today());
                }
                $parsedDate = $date->format('Y-m-d');
                $filePath = storage_path("logs/laravel-{$parsedDate}.log");

                return response()->download($filePath);
            }
        }
    }
}