<?php

namespace App\Http\Controllers;

use App\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\User;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class UserController extends Controller
{

    public function interest()
    {
        if (count(Auth::user()->interest)){
            return redirect()->route('submit.interest');
        }
        else {
            $client = new \GuzzleHttp\Client();
            $res = $client->get('https://api.meetup.com/find/topic_categories?&sign=true&photo-host=public&key=317b642c2b786435471147751de3f12');
            return \view('interest')->with([
                'interests' => json_decode($res->getBody(), true)
            ]);
        }

    }

    public function submitInterest(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        if($request->isMethod('post')) {

            $res = [];
            foreach ($request->interest as $interest){
                $prevInterest = Interest::
                where('user_id', Auth::id())->where('interest', $interest)->get();

                if ($prevInterest->isEmpty()){
                    $insert[] = [
                        'user_id' => Auth::id(),
                        'interest' => $interest,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                }

                $res = $client->get('https://api.meetup.com/find/upcoming_events?&sign=true&photo-host=public&topic_category='. urlencode($interest) .'&page=20&key=317b642c2b786435471147751de3f12');
            }

            if (!empty($insert)){
                Interest::insert($insert);
            }

        }
        else {

            foreach (Auth::user()->interest as $interest){
                $prevInterest = Interest::
                where('user_id', Auth::id())->where('interest', $interest->interest)->get();

                $res = $client->get('https://api.meetup.com/find/upcoming_events?&sign=true&photo-host=public&topic_category='. urlencode($prevInterest) .'&page=20&key=317b642c2b786435471147751de3f12');
            }
        }

        return \view('meetup')->with([
            'interests' => (json_decode($res->getBody(), true))
        ]);

        
    }
}
