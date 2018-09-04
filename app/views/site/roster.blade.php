@extends('layouts.master')

@section('title')
@parent
| Roster
@stop

@section('content')

<div class="page-heading-two">
    <div class="container">
        <h2>Roster</h2>
    </div>
</div>

    <div class="container">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a data-toggle="tab" href="#home">Home Controllers</a></li>
            <li><a data-toggle="tab" href="#visit">Visiting Controllers</a></li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th width="20%">Name</th>
                                        <th width="5%">Rating</th>
                                        <th width="10%">Status</th>
                                        <th width="13%">Clearance Delivery</th>
                                        <th width="13%">Ground</th>
                                        <th width="13%">Local Control</th>
                                        <th width="13%">Approach/Departure</th>
                                        <th width="13%">Enroute</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($homecontroller as $h)
                                    <tr>

                                        @if(Auth::check())
                                        @if(Auth::user()->can('profile'))
                                            <td><a href="/profile/{{$h->id}}">{{{$h->backwards_name}}}</a></td>
                                        @else
                                        <td>{{{$h->backwards_name}}}</td>
                                        @endif
                                    @else
                                        <td>{{{$h->backwards_name}}}</td>
                                    @endif
                                        <td>{{{$h->rating_short}}}</td>
                                        <td>
                                            @if($h->loa == '1') <span class="label label-danger">LOA</span> @elseif($h->hasStaff()) <span class="label label-info">{{$h->userFirstStaff()}}</span> @elseif($h->hasTrainingStaff()) <span class="label label-info">{{$h->roles->first()->name}}</span> @else <span class="label label-success">Active</span> @endif
                                        </td>
                                        <td>{{{$h->del_cert}}}</td>
                                        <td>{{{$h->gnd_cert}}}</td>
                                        <td>{{{$h->twr_cert}}}</td>
                                        <td>{{{$h->app_cert}}}</td>
                                        <td>{{{$h->ctr_cert}}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">No Home Controllers</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="visit" class="tab-pane fade in">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th width="20%">Name</th>
                                        <th width="5%">Rating</th>
                                        <th width="10%">Status</th>
                                        <th width="13%">Clearance Delivery</th>
                                        <th width="13%">Ground</th>
                                        <th width="13%">Local Control</th>
                                        <th width="13%">Approach/Departure</th>
                                        <th width="13%">Enroute</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($visitcontroller as $v)
                                    <tr>
                                          @if(Auth::check())
                                              @if(Auth::user()->can('profile'))
                                                  <td><a href="/profile/{{$v->id}}">{{{$v->backwards_name}}}</a> from {{{$v->visitor_from}}}</td>
                                              @else
                                                  <td>{{{$v->backwards_name}}} from {{{$v->visitor_from}}}</td>
                                              @endif
                                          @else
                                          <td>{{{$v->backwards_name}}} from {{{$v->visitor_from}}}</td>
                                          @endif
                                          <td>{{{$v->rating_short}}}</td>
                                          <td>
                                              @if($v->loa == '1') <span class="label label-danger">LOA</span> @else <span class="label label-success">Active</span> @endif
                                          </td>
                                          <td>{{{$v->del_cert}}}</td>
                                          <td>{{{$v->gnd_cert}}}</td>
                                          <td>{{{$v->twr_cert}}}</td>
                                          <td>{{{$v->app_cert}}}</td>
                                          <td>{{{$v->ctr_cert}}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                      <td colspan="6">No Visiting Controllers</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
