<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Door\Door;
use Illuminate\Http\Request;
use App\Models\Temperature\TemperatureHumidity;
use App\Models\Light\Light;
use App\Models\AirConditioner\AirConditioner;
use App\Models\Arduino\ArduinoClient;
use App\Models\LogEvent\LogEvent;

use App\Notifications\StatusDoor;
use App\User;
use Auth, DB, View, Alert;

class DashboardController extends Controller
{
    public function arduinoAPISaveTemperatureHumidity(Request $request) {
        $temperature = $request->temperature;
        $humidity = $request->humidity;       
        $temperatureHumidity =  new TemperatureHumidity;
        $temperatureHumidity->temperature = $temperature;
        $temperatureHumidity->humidity = $humidity;
        $temperatureHumidity->save();        
    }

    public function arduinoAPICheckDoor(Request $request) {
        $users = User::whereId(1)->first();
        
        $doorStatus = $request->doorstatus;  
        $doorId = $request->doorid; 
        $door =  Door::findOrFail($doorId);
        $door->status = $doorStatus;
        $door->save();    
        if($request->doorstatus == 1){
            $information = "Pintu Rumah Tertutup";
        }else{
            $information = "Pintu Rumah Terbuka";
        }
        
        $this->eventLog($information,NULL);  

        if($users->email_notification == 1){
            $users->notify(new StatusDoor($information));
        }


    }

    public function arduinoAPICheckLight(Request $request) {
        $idLight = $request->idlight;
        $statusLight = $request->statuslight;  
        $arduinoClient = ArduinoClient::whereid(1)->first();
        //Initialize cURL.
        $ch = curl_init();        
        //Set the URL that you want to GET by using the CURLOPT_URL option.        
        if($statusLight == 2){
            $updateLight =  Light::select('status')->whereId($idLight)->first();
            if($updateLight->status == 1){
                $statusLight = 0;
                curl_setopt($ch, CURLOPT_URL, 'http://'.$arduinoClient->ip_address.'/?relay'.$request->idlight.'off');
                $information = "Mematikan Lampu ".$request->idlight;
            }else{
                $statusLight = 1;
                curl_setopt($ch, CURLOPT_URL, 'http://'.$arduinoClient->ip_address.'/?relay'.$request->idlight.'on');
                $information = "Mematikan Lampu ".$request->idlight;

            }
        }

        $updateLight =  Light::findOrFail($idLight);
        $updateLight->status = $statusLight;
        $updateLight->save();    
        
        
        
        
        //Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        //Execute the request.
        curl_exec($ch);        
        //Close the cURL handle.
        curl_close($ch);
        //error_log($request);
        $this->eventLog($information,NULL);  

        

    }

    public function arduinoAPIStoreActionAC(Request $request){
        $actionAC = $request->actionac;  
        
        $storeActionAC = new AirConditioner;
        $storeActionAC->command_name = "test";
        $storeActionAC->command_code = $actionAC;
        $storeActionAC->save();        
    }

    public function arduinoAPIActionAC(Request $request){
        $arduinoClient = ArduinoClient::whereid(2)->first();//arduino mega ac
        $actionACON1 = AirConditioner::whereId($request->command)->first();
        //$actionACON2 = AirConditioner::whereId(2)->first();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_BUFFERSIZE, 128000);
        
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Expect: ',
            //'Content-Type: text/plain',
            'Content-Type: text-plain',
            'Content-Length: ' . strlen($actionACON1->command_code)
        ));
        curl_setopt($ch, CURLOPT_URL,"http://".$arduinoClient->ip_address."/");
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
        //curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch,CURLOPT_POST, strlen($actionACON1->command_code));
        //kode ac menyala
        curl_setopt($ch, CURLOPT_POSTFIELDS,$request->command.'x'.$actionACON1->command_code);        
        //Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        
        //Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        //Tell cURL that it should only spend 10 seconds
        //trying to connect to the URL in question.
        //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        
        //A given cURL operation should only take
        //30 seconds max.
        //curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        //Execute the request.
        curl_exec($ch);        
        //Close the cURL handle.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //$info = curl_getinfo($ch);
       // print_r($info);
        //error_log($request);
        /*sleep(10);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://".$arduinoClient->ip_address."/");
        curl_setopt($ch, CURLOPT_POST, 1);
        //kode ac menyala
        curl_setopt($ch, CURLOPT_POSTFIELDS,$actionACON2->command_code);
         //Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        
        //Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        //Execute the request.
        curl_exec($ch);        
        //Close the cURL handle.
        curl_close($ch);*/
        //dd($actionACON1->command_code, strlen($actionACON1->command_code));
        //echo "okay";

        $information = "Mengubah Kontrol AC ".$request->ac." menjadi ".$actionACON1->command_name;

        $this->eventLog($information,Auth::user()->id);
        Alert::success('Success Control AC', $information);
        return redirect()->route('home');
    }

    public function dashboard(){
        $temperatures = TemperatureHumidity::select('temperature')
        ->from(DB::raw("(
                SELECT * FROM temperature_humidities ORDER BY created_at DESC LIMIT 11
                ) as sub"))
        ->orderBy('created_at','asc')->get();



        $times = TemperatureHumidity::select('created_at')
        ->from(DB::raw("(
            SELECT * FROM temperature_humidities ORDER BY created_at DESC LIMIT 11
            ) as sub"))
        ->orderBy('created_at','asc')->get();
                
        foreach($times as $time) {
            $timesTemperature[] = $time->created_at->format('H:i');
        }
        foreach($temperatures as $temperature) {
            $logTemperatures[] = $temperature->temperature;
        }

        $timesJson =  json_encode($timesTemperature);
        $temperatureJson = json_encode($logTemperatures);
        

        $lastTemperature = TemperatureHumidity::select('temperature')->orderBy('created_at','desc')->first();
        $lastHumidity = TemperatureHumidity::select('humidity')->orderBy('created_at','desc')->first();
        $lastStatusLamps1 = Light::select('id','status')->whereId(1)->get();
        $lastStatusLamps2 = Light::select('id','status')->whereId(2)->get();
        $lastStatusLamps3 = Light::select('id','status')->whereId(3)->get();
        $lastStatusDoors = Door::select('id','status')->get();


        $server = "bhome.bnet.id";
        //$temperatures = TemperatureHumidity::select('temperature')->orderBy('id','desc')->limit(11)->get();
        //$humidities = TemperatureHumidity::select('humidity')->orderBy('id','desc')->limit(11)->get();
        //$times = TemperatureHumidity::select('created_at')->orderBy('id','desc')->limit(11)->get();

        return view('dashboard.index',compact('temperatureJson','lastTemperature','lastHumidity','timesJson','lastStatusLamps1','lastStatusLamps2','lastStatusLamps3','lastStatusDoors','server') );


    }

    public function settings(){
        return view('setting.index');
    }

    public function viewCCTV(){
        
        return view('cctv.index');
    }

    public function emailNotification(Request $request)
    {
        $users = User::whereId(1)->first();        
        $users->email_notification = $request->email_notification;
        $users->save();
        Alert::success('Success','Berhasil Mengubah Notifikasi Email');
        return redirect()->route('setting.index');
    }

    public function temperatureAjax()
    {
        $temperatures = TemperatureHumidity::select('temperature')
        ->from(DB::raw("(
                SELECT * FROM temperature_humidities ORDER BY created_at DESC LIMIT 11
                ) as sub"))
        ->orderBy('created_at','asc')->get();

        foreach($temperatures as $temperature) {
            $data[] = $temperature->temperature;
        }
        //b$data = json_encode($logTemperatures);


        $times = TemperatureHumidity::select('created_at')
        ->from(DB::raw("(
            SELECT * FROM temperature_humidities ORDER BY created_at DESC LIMIT 11
            ) as sub"))
        ->orderBy('created_at','asc')->get();
                
        foreach($times as $time) {
            $labels[] = $time->created_at->format('H:i');
        }
        return response()->json(compact('labels', 'data'));
    }

    public function overviewAjax()
    {
        $temperature = TemperatureHumidity::select('temperature')->orderBy('created_at','desc')->first();
        $lastTemperature[] = $temperature->temperature;

        $humidity = TemperatureHumidity::select('humidity')->orderBy('created_at','desc')->first();
        $lastHumidity[] = $humidity->humidity;
        return response()->json(compact('lastTemperature', 'lastHumidity'));
    }

    public function room1Ajax()
    {
        $server = "bhome.bnet.id";
        $lastStatusLamps1 = Light::select('id','status')->whereId(1)->get();  
        $lastStatusDoors = Door::select('id','status')->get();      
        return View::make("dashboard.partial.room.room1", compact('lastStatusLamps1','lastStatusDoors','server'));
    }

    public function room2Ajax()
    {
        $server = "bhome.bnet.id";
        $lastStatusLamps2 = Light::select('id','status')->whereId(2)->get();  
        return View::make("dashboard.partial.room.room2", compact('lastStatusLamps2','server'));
    }
    public function room3Ajax()
    {
        $server = "bhome.bnet.id";
        $lastStatusLamps3 = Light::select('id','status')->whereId(3)->get();  
        return View::make("dashboard.partial.room.room3", compact('lastStatusLamps3','server'));
    }

    /*public function lightAjax()
    {
        $server = "bhome.bnet.id";
        $lastStatusLamps = Light::select('id','status')->get();       
        return View::make("dashboard.partial.light", compact('lastStatusLamps','server'));
    }*/

    public function doorAjax()
    {
        $lastStatusDoors = Door::select('id','status')->get();       
        return View::make("dashboard.partial.door", compact('lastStatusDoors'));
    }

    private function eventLog($information, $userId)
    {
        $eventLog = new LogEvent;
        //$eventLog->user_id = Auth::user()->id;
        $eventLog->user_id = $userId;
        $eventLog->information = $information;
        $eventLog->save();
        return;
    }

}
