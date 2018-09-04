<?php

use Carbon\Carbon;

class EventController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$event = Events::orderBy('event_start', 'DESC')->get();
		return View::make('admin.events.index')->withErrors(['event', $event]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.events.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$purifier = new HTMLPurifier();
		$description = $purifier->purify(Input::get('description'));

		$events = new Events;
		$events->title = Input::get('title');
		$events->description = $description;
		$events->event_start = new Carbon(Input::get('event_start'), 'UTC');
		$events->event_end = new Carbon(Input::get('event_end'), 'UTC');
		$events->banner_link = Input::get('banner_link');
		$events->host = Input::get('host');
		$events->save();

		ActivityLog::create(['note' => 'Created Event: '.Input::get('title'), 'user_id' => Auth::id(), 'log_state' => 1, 'log_type' => 4]);

		$positions = Input::get('defaultpos');
		if($positions == '1') {
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_10_CTR', 'order_index' => 0]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'MCO_E_APP', 'order_index' => 1]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'MCO_E_TWR', 'order_index' => 2]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'MCO_W_GND', 'order_index' => 3]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'MCO_DEL', 'order_index' => 4]);
		}
		elseif($positions == '2') {
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_10_CTR', 'order_index' => 0]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_13_CTR', 'order_index' => 1]);
		}
		elseif($positions == '3') {
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_10_CTR', 'order_index' => 0]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_13_CTR', 'order_index' => 1]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_N_APP', 'order_index' => 2]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_S_APP', 'order_index' => 3]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_J_APP', 'order_index' => 4]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_TWR', 'order_index' => 5]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_GND', 'order_index' => 6]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_DEL', 'order_index' => 7]);
		}
		elseif($positions == '4') {
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_10_CTR', 'order_index' => 0]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_13_CTR', 'order_index' => 1]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'MCO_E_APP', 'order_index' => 2]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'MCO_W_APP', 'order_index' => 3]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'MCO_M_APP', 'order_index' => 4]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'MCO_E_TWR', 'order_index' => 5]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'MCO_W_TWR', 'order_index' => 6]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'MCO_E_GND', 'order_index' => 7]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'MCO_W_GND', 'order_index' => 8]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'MCO_DEL', 'order_index' => 9]);
		}
		elseif($positions == '5') {
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_10_CTR', 'order_index' => 0]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_13_CTR', 'order_index' => 1]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'DAB_H_APP', 'order_index' => 2]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'DAB_M_APP', 'order_index' => 3]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'DAB_L_APP', 'order_index' => 4]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'DAB_F_TWR', 'order_index' => 5]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'DAB_N_TWR', 'order_index' => 6]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'DAB_N_GND', 'order_index' => 7]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'DAB_DEL', 'order_index' => 8]);
		}
		elseif($positions == '6') {
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_10_CTR', 'order_index' => 0]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_13_CTR', 'order_index' => 1]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'CHS_E_APP', 'order_index' => 2]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'CHS_W_APP', 'order_index' => 3]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'CHS_TWR', 'order_index' => 4]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'CHS_GND', 'order_index' => 5]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'CHS_DEL', 'order_index' => 6]);
		}
		elseif($positions == '7') {
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_10_CTR', 'order_index' => 0]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'JAX_13_CTR', 'order_index' => 1]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'PNS_E_APP', 'order_index' => 2]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'PNS_W_APP', 'order_index' => 3]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'PNS_F_APP', 'order_index' => 4]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'PNS_TWR', 'order_index' => 5]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'NPA_TWR', 'order_index' => 6]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'PNS_GND', 'order_index' => 7]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'NPA_GND', 'order_index' => 8]);
			EventPosition::create(['event_id' => $events->id, 'name' => 'PNS_DEL', 'order_index' => 9]);
		}
		
		return Redirect::route('admin.events.index')->withErrors(['message', 'Event Created!']);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$event = Events::withErrors(['positions', 'Positions updated'])->find($id);
		$pos_req = Position::where('eventid', '=', $id)->where('position_id', '!=', '0')->where('done', '0')->get();
		return View::make('admin.events.show')->withErrors(['event', $event])->withErrors(['pos_req', $pos_req]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$event = Events::find($id);
		return View::make('admin.events.edit')->withErrors(['event', $event]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$purifier = new HTMLPurifier();
		$description = $purifier->purify(Input::get('description'));

		$events = Events::find($id);
		$events->title = Input::get('title');
		$events->description = $description;
		$events->event_start = new Carbon(Input::get('event_start'), 'UTC');
		$events->event_end = new Carbon(Input::get('event_end'), 'UTC');
		$events->banner_link = Input::get('banner_link');
		$events->host = Input::get('host');
		$events->save();

		ActivityLog::create(['note' => 'Updated Event: '.Input::get('title'), 'user_id' => Auth::id(), 'log_state' => 2, 'log_type' => 4]);

		return Redirect::to('/admin/events')->withErrors(['message', 'Event Updated!']);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Events::destroy($id);
		return Redirect::to('/admin/events')->withErrors(['message', 'Event Archived']);
	}

	public function setEventHidden($id)
	{
		$event = Events::find($id);
		$event->status = 0;
		$event->save();

		ActivityLog::create(['note' => 'Hid Event: '.$event->title, 'user_id' => Auth::id(), 'log_state' => 2, 'log_type' => 4]);

		return Redirect::to('/admin/events')->withErrors(['message', 'Event Status Changed!']);
	}

	public function setEventActive($id)
	{
		$event = Events::find($id);
		$event->status = 1;
		$event->save();

		ActivityLog::create(['note' => 'Unhid Event: '.$event->title, 'user_id' => Auth::id(), 'log_state' => 2, 'log_type' => 4]);

		return Redirect::to('/admin/events')->withErrors(['message', 'Event Status Changed!']);
	}


	public function createPosition($id)
	{
		$last_index = EventPosition::where('event_id', '=', $id)->max('order_index');
		EventPosition::create([
			'event_id' => $id,
			'name' => Input::get('name'),
			'order_index' => $last_index + 1,
		]);

		ActivityLog::create(['note' => 'Created Position: '.Input::get('name'), 'user_id' => Auth::id(), 'log_state' => 2, 'log_type' => 4]);

		return Redirect::action('EventController@show', [$id])->withMessage('Event Position Added');
	}

	public function deletePosition($event_id, $position_id)
	{
		$position = EventPosition::find($position_id);
		EventPosition::destroy($position_id);
		Position::where('eventid', '=', $event_id)->where('position_id', '=', $position_id)->delete();

		ActivityLog::create(['note' => 'Deleted Position: '.$position->name, 'user_id' => Auth::id(), 'log_state' => 2, 'log_type' => 4]);

		return Redirect::back()->withMessage('Event Position Deleted');
	}

	public function unassignPosition($event_id, $position_id)
	{
		$position = EventPosition::find($position_id);
		$position->controller_id = null;
		$position->save();

		ActivityLog::create(['note' => 'Unassigned Position: '.$position->name, 'user_id' => Auth::id(), 'log_state' => 1, 'log_type' => 4]);

		return Redirect::back()->withMessage('Event Position Unassigned');
	}

	public function assignPosition($position_id, $controller_id)
	{
		$position = EventPosition::where('id', $position_id)->first();
		$position->controller_id = $controller_id;
		$position->save();

		ActivityLog::create(['note' => 'Assigned Position: '.$position->name.' to '.$position->user->full_name, 'user_id' => Auth::id(), 'log_state' => 1, 'log_type' => 4]);

		Position::where('eventid', $position->event_id)->where('controller_id', $controller_id)->delete();

		return Redirect::back()->withErrors(['message', 'Event Request Accepted']);
	}

	public function requestPosition($event_id)
	{
		$user_id = Auth::id();

		$CurrentPositions = Position::where('eventid', $event_id)->where('controller_id', $user_id)->get();
		$positions = Input::get('position_id');
		$current_pos_ids = $CurrentPositions->lists('position_id');

		$diff = array_diff($positions, $current_pos_ids);
		$del_diff = array_diff($current_pos_ids, $positions);

		foreach ($diff as $position) {
			if ($position == 0) continue;
			$posreq = new Position;
			$posreq->controller_id = $user_id;
			$posreq->position_id = $position;
			$posreq->eventid = $event_id;
			$posreq->done = 0;
			$posreq->save();
		}

		Position::where('eventid', $event_id)->where('controller_id', $user_id)->whereIn('position_id', $del_diff)->delete();

		return Redirect::action('FrontController@showEvents', [$event_id])->withMessage('Event Request Placed');
	}

	public function deleteRequest($id)
	{
		$posreq = Position::find($id);
		$controller_id = $posreq->controller_id;
		$eventid = $posreq->eventid;
		Position::where('controller_id', '=', $controller_id)->where('eventid', '=', $eventid)->delete();
		return Redirect::back()->withMessage('Event Requests Deleted for User');
	}

	public function selfUnnasign($id)
	{
		$position = EventPosition::find($id);
		$position->controller_id = null;
		$position->save();

		ActivityLog::create(['note' => 'Seld Unnasigned from position: '.$position->name, 'user_id' => Auth::id(), 'log_state' => 1, 'log_type' => 4]);

		return Redirect::back()->withMessage('You have been unnasigned from the position');
	}

	public function resortPositions($event_id)
	{
		$orders = json_decode(Request::getContent(), true);
		$pos_ids = array_pluck($orders, 'id');

		$positions = EventPosition::where('event_id', '=', $event_id)->whereIn('id', $pos_ids)->get();

		foreach ($positions as $position) {
			$order = array_first($orders, function($k, $v) use ($position) {
				return $v['id'] == $position->id;
			});

			$position->order_index = $order['order_index'];
			$position->save();
		}

		return Response::json(['success' => true]);
	}


}
