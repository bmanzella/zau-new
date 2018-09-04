<?php

class Comms extends Eloquent {

	public static $FacilityLong = [
        'a' => 'ZJX - Enroute',
        'b' => 'F11 - Central Florida TRACON', 
        'c' => 'JAX - Jacksonville ATCT', 
        'd' => 'CHS - Charleston ATCT', 
        'e' => 'P31 - Pensacola TRACON', 
        'f' => 'DAB - Daytona ATCT', 
        'g' => 'TLH - Tallahassee ATCT',
        'h' => 'SAV - Savannah ATCT', 
        'i' => 'CAE - Columbia ATCT',
        'j' => 'MYR - Myrtle Beach ATCT', 
        'k' => 'FLO - Florence ATCT', 
        'l' => 'VLD - Valdosta ATCT', 
        'm' => 'PAM - Tyndall RAPCON', 
        'n' => 'OZR - Cairns ARAC',
        'o' => 'VPS - Eglin RAPCON', 
        'p' => 'NBC - Beaufort RATCF',
        ];

    protected $table = 'comms_airport';
    protected $fillable = array('position', 'name', 'facility', 'frequency', 'pofid');

    public function getFacilityLongAttribute()
    {
        foreach (Comms::$FacilityLong as $id => $facility) {
            if ($this->facility == $id) {
                return $facility;
            }
        }

        return "";
    }

}