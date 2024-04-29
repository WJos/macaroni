<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Enreg;
use DB;

class OfflineSyncController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function postData()
    {

        $users =  DB::table('users')
                    ->select('users.*','roles.name As role')
                    ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                    ->join('roles','model_has_roles.role_id','=','roles.id')
                    ->where('online',0)
                    ->where('offline',1)
                    ->get();

        $enregs = DB::table('enregs')
                    ->where('online',0)
                    ->where('offline',1)
                    ->get();
        
        $data = array('status' => 'success', 'data' => array('users' => $users, 'enregs' => $enregs));        

        try {
        $response = Http::post('http://localhost:8001/online_sync/postData',$data);
                            // ->get('http://localhost:8001/online_sync/getData');https://jsonplaceholder.typicode.com/posts
                            //https://e-macaroni.com/public/online_sync/postData

        $response->throw();
        $jsonData = $response->json();

        if ($jsonData['status'] == 'success') {

            $users1 = $jsonData['data']['users'] ;
            $enregs1 = $jsonData['data']['enregs'] ;
            
        if (count($users1) > 0) {
            foreach ($users1 as $user) {
                //return $user->id;
                $id = $user['id'];
                $role = $user['role'];
                unset($user['id']);
                unset($user['role']);
                $user['online'] = 1;
                $user['offline'] = 1;
                DB::table('users')->updateOrInsert(['id' => $id], $user);
                $user = User::where('email', $user['email'])->where('name', $user['name'])->first();
                $user->assignRole($role);
            }
        }

        if (count($enregs1) > 0) {
            foreach ($enregs1 as $enreg) {
                    $enreg_id = $enreg['enreg_id'];
                    unset($enreg['enreg_id']);
                    $enreg['online'] = 1;
                    $enreg['offline'] = 1;
                    DB::table('enregs')->updateOrInsert(['enreg_id' => $enreg_id], $enreg);
            }
        }
        return json_encode($jsonData);
        }else {
            return array('status' => 'ifOfflinePostDataError');
        }

        } catch (\Throwable $th) {

            return array('status' => 'tryOfflinePostDataError');
        }
        
        // return json_encode($jsonData['status']);

        // dd($jsonData);
    }


    public function getData()
    {
        $response = Http::get('http://localhost:8001/online_sync/getData');
                            // ->get('http://localhost:8001/online_sync/getData');https://jsonplaceholder.typicode.com/posts
                            //https://e-macaroni.com/public/online_sync/getData
    
        $jsonData = $response->json();
                  
        // dd($jsonData);

        if ($jsonData && $jsonData['status'] == 'success') {
            $users = $jsonData['data']['users'];
            $enregs = $jsonData['data']['enregs'];

            $usersTemp = $jsonData['data']['users'];
            $enregsTemp = $jsonData['data']['enregs'];


            if (count($users) > 0) {
                foreach ($users as $user) {
                    //dd($user['id']);
                    $id = $user['id'];
                    $role = $user['role'];
                    unset($user['id']);
                    unset($user['role']);
                    $user['online'] = 1;
                    $user['offline'] = 1;
                    DB::table('users')->updateOrInsert(['id' => $id], $user);
                    $user = User::where('email', $user['email'])->where('name', $user['name'])->first();
                    $user->assignRole($role);
                }
            }

            if (count($enregs) > 0) {
                foreach ($enregs as $enreg) {
                        $enreg_id = $enreg['enreg_id'];
                        unset($enreg['enreg_id']);
                        $enreg['online'] = 1;
                        $enreg['offline'] = 1;
                        DB::table('enregs')->updateOrInsert(['enreg_id' => $enreg_id], $enreg);
                }
            }

            $dataa = array('status' => 'success', 'data' => array('users' => $usersTemp, 'enregs' => $enregsTemp));
            $response1 = Http::post('http://localhost:8001/online_sync/updateGetData',$dataa);

            $response1->throw();
            $jsonDataa = $response1->json();
        }
        
    }
    
}
