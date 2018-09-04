<?php

class FrontController extends BaseController {

    public function showWelcome()
    {
        $online = ATC::all();
        $events = Events::current()->orderBy('event_start', 'ASC')->get();
        $news = SMFAnnouncements::getAnnouncements();
        $lastTop5 = ControllerLog::top5Controllers(date('Y-n', strtotime("first day of previous month")));
        $currentTop5 = ControllerLog::top5Controllers(date('Y-n'));
        $announcements = Announcement::where('active', '1')->get();

        return View::make('site.home')->withErrors(['events', $events])->withErrors(['news', $news])->withErrors(['online', $online])
                                      ->withErrors(['lastTop5', $lastTop5])->withErrors(['currentTop5', $currentTop5])
                                      ->withErrors(['announcements', $announcements]);
    }

    public function loadHomeTables()
    {
        $online = ATC::all();
        $weather = Weather::whereIn('id', array('KORD', 'KMKE', 'KMDW', 'KGRR', 'KFWA', 'KPIA', 'KRFD', 'KCMI'))->get();
        $atcupdate = Settings::where('key', 'ATCUPDATE')->pluck('value');
        $wxupdate = Settings::where('key', 'WXUPDATE')->pluck('value');

        return View::make('site.hometables')->withErrors(['weather', $weather])->withErrors(['online', $online])
                                            ->withErrors(['wxupdate', $wxupdate])->withErrors(['atcupdate', $atcupdate])->render();
    }

    public function showTest()
    {
        dd(strtotime(preg_replace("/^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/", "$1-$2-$3 $4:$5:$6", 20160409104604)));
    }

    public function showStaff()
    {
        $Roles = Role::withErrors('users')->get();
        return View::make('site.staff')->withErrors(['Roles', $Roles]);
    }

    public function showWeather()
    {
        $weather = Weather::orderBy('id', 'ASC')->get();
        return View::make('site.weather')->withErrors(['weather', $weather]);
    }

    public function showScenery()
    {
        $fsx = Scenery::where('type', '1')->get();
        $xpl = Scenery::where('type', '2')->get();
        return View::make('site.scenery')->withErrors(['fsx', $fsx])->withErrors(['xpl', $xpl]);
    }

    public function showDocuments()
    {
        $Documents = Document::all();
        $byType = function($type){
            return function($Document) use ($type){
                return $Document->type == $type;
            };
        };

        return View::make('site.documents',[
            'vrc'    => $Documents->filter($byType('vrc')),
            'vstars' => $Documents->filter($byType('vstars')),
            'veram' => $Documents->filter($byType('veram')),
            'vatis' => $Documents->filter($byType('vatis')),
            'sop'    => $Documents->filter($byType('sop')),
            'loa'    => $Documents->filter($byType('loa')),
        ]);
    }

    public function showVisit()
    {
        return View::make('site.visit');
    }

    public function showProfile($id = null)
    {
        if ($id == null || !Entrust::can('profile'))
        {
            $id = Auth::id();
        }

        $user = User::find($id);
        $feedback = Feedback::where('controller_id', '=', $id)->where('status', 1)->limit(8)->orderBy('created_at', 'DESC')->get();
        $log = ControllerLog::where('cid', '=', $id)->limit(8)->orderBy('id', 'DESC')->get();
        $stats = ControllerLog::getControllerStats($id);

        return View::make('site.profile')->withErrors(['user', $user])->withErrors(['feedback', $feedback])
                                         ->withErrors(['log', $log])->withErrors(['stats', $stats]);
    }

    public function showEvents($id)
    {
        $event = Events::find($id);
        $available_positions = $event->positions()->orderBy('order_index', 'ASC')->where('controller_id', null)->lists('name', 'id');
        $userreq = DB::table('event_position_requests')->where('controller_id', '=', Auth::id())->where('eventid', $id)->get();
        $userpos = DB::table('event_positions')->where('controller_id', '=', Auth::id())->where('event_id', $id)->first();

        $available_positions = ['0' => 'Select One'] + $available_positions;

        $pos_req = Position::where('eventid', '=', $id)->where('position_id', '!=', '0')->where('done', '0')->get();

        return View::make('site.events')->withErrors(['event', $event])->withErrors(['available_positions', $available_positions])
                                        ->withErrors(['userreq', $userreq])->withErrors(['userpos', $userpos])->withErrors(['pos_req', $pos_req]);
    }

    public function showStats($year = null, $month = null)
    {
        if ($year == null)
            $year = date('y');

        if ($month == null)
            $month = date('n');

        $stats = ControllerLog::aggregateAllControllersByPosAndMonth($year, $month);
        $all_stats = ControllerLog::getAllControllerStats();

        $home = User::where('visitor', 0)->where('loa', '0')->where('status', '0')->orderBy('last_name', 'ASC')->get();
        $homeloa = User::where('visitor', 0)->where('loa', '1')->where('status', '0')->orderBy('last_name', 'ASC')->get();
        $visit = User::where('visitor', '1')->where('loa', '0')->where('status', '0')->orderBy('last_name', 'ASC')->get();
        $visitloa = User::where('visitor', '1')->where('loa', '1')->where('status', '0')->orderBy('last_name', 'ASC')->get();
        
        return View::make('site.stats')->withErrors(['all_stats', $all_stats])->withErrors(['year', $year])
                                        ->withErrors(['month', $month])->withErrors(['stats', $stats])
                                        ->withErrors(['home', $home])->withErrors(['homeloa', $homeloa])
                                       ->withErrors(['visit', $visit])->withErrors(['visitloa', $visitloa]);
    }


    public function showAirportList()
    {
        return View::make('site.airports.index');
    }

    public function showComms()
    {
        $comms = Comms::orderBy('facility', 'ASC')->orderBy('type', 'DESC')->get();
        $atis = ATIS::orderBy('facility', 'ASC')->get();
        return View::make('site.comms')->withErrors(['comms', $comms])->withErrors(['atis', $atis]);
    }
    
    public function getAirport($id)
    {
        $airport = Airport::find($id);
        $airport->loadChartsData();

        $weather = Weather::find($id);
        $departure_flights = Pilot::where('dep_apt', $id)->get();
        $arrival_flights = Pilot::where('arr_apt', $id)->get();

        return View::make('site.airports.show')->withErrors(['airport', $airport])->withErrors(['weather', $weather])->withErrors(['arrival_flights', $arrival_flights)->withErrors('departure_flights', $departure_flights]);
    }

    public function showRunways()
    {
        $kmco = Weather::find('KMCO');
        $kchs = Weather::find('KCHS');
        $kjax = Weather::find('KJAX');

        return View::make('site.runways')->withErrors(['kmco', $kmco])->withErrors(['kchs', $kchs])->withErrors(['kjax', $kjax]);
    }

    public function showATCast()
    {
        return View::make('site.atcast');
    }


    public function sendEmail()
    {
        $User = User::find(1123084);

        Mail::send('emails.newmember', ['user' => $User], function($message) use ($User)
        {
            $message->to($User->email)->subject('Welcome to ZAU');
        });
    }


}
