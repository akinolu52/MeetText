<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;

class CalendarController extends Controller
{
    protected $client;
    public function __construct()
    {
        $client = new Google_Client();
        $client->setAuthConfig('client_secret.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
        $this->client = $client;
    }

    public function index()
    {
        session_start();

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
            $calendarId = 'primary';
            $results = $service->events->listEvents($calendarId);

            $insert = [];

            foreach ($results->getItems() as $task) {
                $previous_task = Task::where('calendar_id', $task->id)->get();
                if($previous_task->count() == 0){
                    $insert[] = [
                        'user_id' => Auth::id(),
                        'calendar_id' => $task->id,
                        'summary' => $task->summary ,
                        'description' => $task->description,
                        'htmlLink' => $task->htmlLink,
                        'location' => $task->location,
                        'status' => $task->status,
                        'creator_displayName' => $task->creator['displayName'],
                        'creator_email' => $task->creator['email'],
                        'organizer_displayName' => $task->organizer['displayName'],
                        'organizer_email' => $task->organizer['email'],
                        'start_dateTime' => date('Y-m-d H:m:s', strtotime($task->start['dateTime'])),
                        'end_dateTime' => date('Y-m-d H:m:s', strtotime($task->end['dateTime'])),
                    ];
                }
            }

            Task::insert($insert);

            if (Auth::user()->phone) {
                return redirect()->route('welcome');
            }
            else {
                return redirect()->route('user.edit', Auth::user());
            }
        }
        else {
            return redirect()->route('oauthCallback');
        }
    }

    public function oauth()
    {
        session_start();
        $rurl = action('CalendarController@oauth');
        $this->client->setRedirectUri($rurl);
        if (!isset($_GET['code'])) {
            $auth_url = $this->client->createAuthUrl();
            $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
            return redirect($filtered_url);
        } else {
            $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();

            return redirect()->route('cal.index');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        session_start();
        $startDateTime = $request->start_date;
        $endDateTime = $request->end_date;
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
            $calendarId = 'primary';
            $event = new Google_Service_Calendar_Event([
                'summary' => $request->title,
                'description' => $request->description,
                'start' => ['dateTime' => $startDateTime],
                'end' => ['dateTime' => $endDateTime],
                'reminders' => ['useDefault' => true],
            ]);
            $results = $service->events->insert($calendarId, $event);
            if (!$results) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'message' => 'Event Created']);
        } else {
            return redirect()->route('oauthCallback');
        }
    }

    public function show($id)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
            $event = $service->events->get('primary', $id);
            if (!$event) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'data' => $event]);
        } else {
            return redirect()->route('oauthCallback');
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
            $startDateTime = Carbon::parse($request->start_date)->toRfc3339String();
            $eventDuration = 30; //minutes
            if ($request->has('end_date')) {
                $endDateTime = Carbon::parse($request->end_date)->toRfc3339String();
            } else {
                $endDateTime = Carbon::parse($request->start_date)->addMinutes($eventDuration)->toRfc3339String();
            }
            // retrieve the event from the API.
            $event = $service->events->get('primary', $id);
            $event->setSummary($request->title);
            $event->setDescription($request->description);
            //start time
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($startDateTime);
            $event->setStart($start);
            //end time
            $end = new Google_Service_Calendar_EventDateTime();
            $end->setDateTime($endDateTime);
            $event->setEnd($end);
            $updatedEvent = $service->events->update('primary', $event->getId(), $event);
            if (!$updatedEvent) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'data' => $updatedEvent]);
        } else {
            return redirect()->route('oauthCallback');
        }
    }

    public function destroy($id)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
            $service->events->delete('primary', $id);
        } else {
            return redirect()->route('oauthCallback');
        }
    }
}
