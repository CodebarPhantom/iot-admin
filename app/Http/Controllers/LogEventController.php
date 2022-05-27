<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\LogEvent\LogEvent;
use Auth, DB, View, DataTables;

class LogEventController extends Controller
{
    public function index()
    {
        $logEvents = LogEvent::orderBy('created_at','desc')->paginate(25);        
        return view('log-event.index',compact('logEvents'));
    }

    public function logEventData()
    {
        $logEvents = LogEvent::select('log_events.id as id_logevent','users.name as username','log_events.information', 'log_events.created_at')
                ->leftJoin('users', 'users.id', '=', 'log_events.user_id')
                ->orderBy('log_events.created_at','desc');
        return DataTables::of($logEvents)            
            ->editColumn('users.name', function($logEvent) {
                return $logEvent->username;
            })
            ->editColumn('created_at', function($logEvent) {
                return $logEvent->created_at->translatedFormat('l, d F Y H:i');
            })
            ->make(true);
    }
}
