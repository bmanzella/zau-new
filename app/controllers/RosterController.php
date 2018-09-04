<?php

use SimpleXMLElement;

class RosterController extends \BaseController {

    public function index()
    {
        $controllers = User::query()->orderBy('last_name', 'ASC')->get();

        $homecontroller = $controllers->filter(function($user){
            return !$user->visitor && !$user->status;
        });

        $visitcontroller = $controllers->filter(function($user){
            return $user->visitor == 1 && !$user->status;
        });

        $formercontroller = $controllers->filter(function($user){
            return $user->status == 1;
        });

        return View::make('admin.roster.index')->withErrors(['homecontroller', $homecontroller])
                                        ->withErrors(['visitcontroller', $visitcontroller])
                                        ->withErrors(['formercontroller', $formercontroller]);
    }

    public function front_index()
    {
        $controllers = User::with('roles')->where('status', '0')->orderBy('last_name', 'ASC')->get();

        $homecontroller = $controllers->filter(function($user){
            return !$user->visitor;
        });

        $visitcontroller = $controllers->filter(function($user){
            return $user->visitor;
        });

        return View::make('site.roster')->withErrors(]'homecontroller', $homecontroller])->withErrors(['visitcontroller', $visitcontroller]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.roster.create');
    }

    public function ajax_get_user_info($cid)
    {
        if (empty($cid) || !is_numeric($cid))
            return Response::json(['error' => 'Invalid or empty cid given']);

        $client = new GuzzleHttp\Client();
        $url = sprintf(Config::get('services.vatsim.url'), $cid);
        $result = $client->get($url);
        $xml = new SimpleXMLElement($result->getBody());

        $res = [
            'cid' => $xml->user['cid']->__toString(),
        ];

        foreach ($xml->user->children() as $child) {
            $res[$child->getName()] = $child->__toString();
        }

        foreach (User::$RatingLong as $id => $long) {
            if (strtolower($res['rating']) == strtolower($long)) {
                $res['rating'] = $id;
            }
        }

        return Response::json($res);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
public function store()
    {
        if(User::where('id', '=', Input::get('id'))->exists()) {
            return Redirect::back()->withErrors(['User already exists.', 'The user already exists on the roster. They may be listed as a home controller, visiting controller, or former controller.']);
        } else {
            $rules = array(
                'id' => 'required:unique:roster',
                'first_name' => 'required',
                'last_name' => 'required',
                'rating_id' => 'required',
            );
   
            $validator = Validator::make(Input::all(), $rules);
   
            if($validator->fails())
            {
                return Redirect::route('admin.roster.create')->withErrors($validator)->withInput();
            }
            else
            {
                $User = User::create([
                        'id' => Input::get('id'),
                        'first_name' => Input::get('first_name'),
                        'last_name' => Input::get('last_name'),
                        'initials' => Input::get('controller_initials'),
                        'email' => Input::get('email'),
                        'rating_id' => Input::get('rating_id'),
                        'visitor' => empty(Input::get('visitor')) ? 0 : 1,
                        'visitor_from' => empty(Input::get('visitor_from')) ? null : Input::get('visitor_from'),
                        'canTrain' => 1,
                        'created_at' => Carbon::now()
                    ]);
               
                $newuser = User::find(Input::get('id'));
   
                if($newuser->visitor == '1') {
                    if($newuser->rating_id == '2') {
                        $newuser->del = '2';
                        $newuser->gnd = '2';
                        $newuser->save();
                    } elseif($newuser->rating_id == '3') {
                        $newuser->del = '2';
                        $newuser->gnd = '2';
                        $newuser->twr = '2';
                        $newuser->save();
                    } else {
                        $newuser->del = '2';
                        $newuser->gnd = '2';
                        $newuser->twr = '2';
                        $newuser->app = '2';
                        $newuser->save();
                    }
                }
               
   
                ActivityLog::create(['note' => 'Added Member '. Input::get('id') .' to Roster', 'user_id' => Auth::id(), 'log_state' => 1, 'log_type' => 9]);
   
 
                if($User->visitor == '0') {
                    Mail::send('emails.newmember', ['user' => $User], function($message) use ($User)
                    {
                        $message->from('atm@zauartcc.org', 'ZAU Member Department');
                        $message->to(Input::get('email'))->subject('Welcome to the ZAU ARTCC!');
                        $message->cc('atm@zauartcc.org');
                        $message->cc('datm@zauartcc.org');
                    });
                }
   
                return Redirect::route('admin.roster.index')->withErrors(['User Added', 'The user was successfully added to the roster.']);
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Possibly have a link to show stats/information pulled from vatsim on the user
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $User = User::with('roles')->find($id);
        $Roles = Role::orderBy('id')->get();

        $isStaff = function($is_staff) {
            return function($Role) use ($is_staff){
                return $Role->is_staff == $is_staff;
            };
        };

        $TrainingRoles = $Roles->filter($isStaff('0'))->lists('name', 'id');
        $TrainingRoles =  ['0' => 'None'] + $TrainingRoles;

        $StaffRoles = $Roles->filter($isStaff('1'))->lists('name', 'id');
        $StaffRoles = ['0' => 'None'] + $StaffRoles;

        $UserRoles = $User->roles;
        $UserTRole = $UserRoles->filter($isStaff('0'))->first();
        $UserSRole = $UserRoles->filter($isStaff('1'))->first();

        return View::make('admin.roster.edit',[
            'staff_roles' => $StaffRoles,
            'training_roles' => $TrainingRoles,
            'User' => $User,
            'UserTRoleID' => !empty($UserTRole) ? $UserTRole->id : 0,
            'UserSRoleID' => !empty($UserSRole) ? $UserSRole->id : 0,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $User = User::find($id);
        $User->rating_id = Input::get('rating_id');
        $User->del = Input::get('del');
        $User->gnd = Input::get('gnd');
        $User->twr = Input::get('twr');
        $User->app = Input::get('app');
        $User->ctr = Input::get('ctr');
        
        if(Auth::user()->can('snrstaff') || Auth::user()->can('instruct'))
        {
            $User->canTrain = Input::get('canTrain');
        }

        if (Auth::user()->can('snrstaff') || Auth::user()->hasRole('TA'))
        {
            $User->visitor = Input::get('visitor');
            $User->visitor_from = Input::get('visitor_from');
            $User->first_name = Input::get('first_name');
            $User->last_name = Input::get('last_name');
            $User->email = Input::get('email');

            $staff_role = Input::get('staff_role');
            $training_role = Input::get('training_role');

            DB::table(Config::get('entrust::assigned_roles_table'))->where('user_id', $User->id)->delete();
            if($staff_role != '0') {
                $User->attachRole($staff_role);
                DB::connection('zjxforum')
                    ->table('smf_members')
                    ->where('member_name', $id)
                    ->update(['id_group' => User::$StaffRoleToSMFGroup[$staff_role]]);
            } else {
                DB::connection('zjxforum')
                    ->table('smf_members')
                    ->where('member_name', $id)
                    ->update(['id_group' => $User->visitor == 1 ? 21 : 20]);
            }

            if($training_role != '0') {
                $User->attachRole($training_role);
            }

            if (!empty(User::$TrainingRoleToSMFGroup[$training_role])) {
                DB::connection('zjxforum')
                    ->table('smf_members')
                    ->where('member_name', $id)
                    ->update(['additional_groups' => User::$TrainingRoleToSMFGroup[$training_role]]);
            }
        }

        $User->save();

        ActivityLog::create(['note' => 'Updated Member '. $id, 'user_id' => Auth::id(), 'log_state' => 2, 'log_type' => 9]);
        
        return Redirect::action('RosterController@index')->withMessage('Successfully edited user!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function loginv2()
    {
        if (Auth::check()) {
            return Redirect::action('FrontController@showWelcome')->withMessage("Already logged in.");
        }

        if (!Auth::check() && !isset($_GET['token']))
        {
            $_SESSION['redirect'] = "https://zauartcc.org";
            header("Location: https://login.vatusa.net/uls/v2/login?fac=ZAU?dev"); 
            exit;
        }
        
        $token = $_GET['token'];
        $parts = explode('.', $token);
        $token = $this->base64url_decode($parts[1]);

        $jwk = json_decode('{"alg":"HS256","use":"sig","kty":"oct","k":"9-ymVSYuEodzxclfFrcQN_mpTq9aRHXJFqt2CGqhVJs2Xjo47czie97NaSpkNx5Wwq4rP_KUcVftDDFZLNJbbw"}',   true);

        $algorithms = ['HS256' => 'sha256', 'HS384' => 'sha384', 'HS512' => 'sha512'];

        if (!isset($algorithms[$jwk['alg']])) { 
            return Redirect::action('FrontController@showWelcome')->withMessage("Invalid Operation");
        }
        
        $sig = $this->base64url_encode(hash_hmac($algorithms[$jwk['alg']], "$parts[0].$parts[1]", $this->base64url_decode($jwk['k']), true));

        if($sig == $parts[2]) {

            $token = json_decode($token, true);

            if($token['iss'] != 'VATUSA') {
                return Redirect::action('FrontController@showWelcome')->withMessage("Not issued from VATUSA");
            }
            if($token['aud'] != 'ZAU') {
                return Redirect::action('FrontController@showWelcome')->withMessage("Not issued for ZAU");
            }

            $client = new GuzzleHttp\Client();
            $url = "https://login.vatusa.net/uls/v2/info?token={$parts[1]}";
            $result = $client->get($url);
            $res = json_decode($result->getBody()->__toString(), true);

            $userstatuscheck = User::find($res['cid']);
            if($userstatuscheck) {
                if($userstatuscheck->status == 1) {
                    return Redirect::action('FrontController@showWelcome')->withMessage("You are not an active controller, and cannot login.");
                } else {
                    Auth::login($userstatuscheck, true);
                }
            } else {
                return Redirect::action('FrontController@showWelcome')->withMessage("No user matching your information on the roster.");
            }

            //update email records and rating
            $member = User::find($res['cid']);
            $member->rating_id = $res['intRating'];
            $member->email = $res['email'];
            $member->save();


            return Redirect::action('FrontController@showWelcome')->withMessage('You have been logged in!');

        } else {
                return Redirect::action('FrontController@showWelcome')->withMessage("Bad Signature");
        }
    }

    public function testLogin($cid)
    {
        Auth::loginUsingId($cid);
        return Redirect::action('FrontController@showWelcome')->withMessage('You have been logged in!');
    }
    
    public function logout()
    {
        Auth::logout();
        return Redirect::to('/')->withMessage('You have successfully logged out!');
    }

    public function base64url_encode($data, $use_padding = false) {
        $encoded = strtr(base64_encode($data), '+/', '-_');
        return true === $use_padding ? $encoded : rtrim($encoded, '=');
    }

    public function base64url_decode($data) {
        return base64_decode(strtr($data, '-_', '+/'));
    }

}
