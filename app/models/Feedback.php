<?php

class Feedback extends Eloquent {

    public static $Positions = [
     'CHI_CTR' => 'Enroute (Chicago Center)',
     'APP' => '-------- APPROACH/DEPARTURE --------',
     'ALO_APP' => '(ALO) Waterloo Approach/Departure', 
     'AZO_APP' => '(AZO) Kalamazoo Approach/Departure', 
     'CID_APP' => '(CID) Cedar Rapids Approach/Departure',
     'CHI_APP' => '(C90) Chicago Approach/Departure',
     'CMI_APP' => '(CMI) Champaign Approach/Departure',
     'FWA_APP' => '(FWA) Fort Wayne Approach/Departure',
     'GRR_APP' => '(GRR) Grand Rapids Approach.Departure',
     'MKE_APP' => '(MKE) Milwaukee Approach/Departure',
     'MKG_APP' => '(MKG) Muskegon Approach/Departure', 
     'MLI_APP' => '(MLI) Quad City Approach/Departure', 
     'MSN_APP' => '(MSN) Madison Approach/Departure',
     'PIA_APP' => '(PIA) Peoria Approach/Departure',
     'RFD_APP' => '(RFD) Rockford Approach/Departure',
     'SBN_APP' => '(SBN) South Bend Approach/Departure',
     'TWR' => '-------------- TOWER --------------',
     'ALO_TWR' => '(ALO) Waterloo Tower', 
     'AZO_TWR' => '(AZO) Kalamazoo Tower', 
     'CID_TWR' => '(CID) Cedar Rapids Tower',
     'CMI_TWR' => '(CMI) Champaign Tower',
     'FWA_TWR' => '(FWA) Fort Wayne Tower',
     'GRR_TWR' => '(GRR) Grand Rapids Tower',
     'MDW_TWR' => '(MDW) Midway Tower',
     'MKE_TWR' => '(MKE) Milwaukee Tower',
     'MKG_TWR' => '(MKG) Muskegon Tower', 
     'MLI_TWR' => '(MLI) Quad City Tower', 
     'MSN_TWR' => '(MSN) Madison Tower',
     'ORD_TWR' => '(ORD) OHare Tower',
     'PIA_TWR' => '(PIA) Peoria Tower',
     'RFD_TWR' => '(RFD) Rockford Tower',
     'SBN_TWR' => '(SBN) South Bend Tower',
     'GND' => '-------------- GROUND --------------',
     'ALO_GND' => '(ALO) Waterloo Ground', 
     'AZO_GND' => '(AZO) Kalamazoo Ground', 
     'CID_GND' => '(CID) Cedar Rapids Ground',
     'CMI_GND' => '(CMI) Champaign Ground',
     'FWA_GND' => '(FWA) Fort Wayne Ground',
     'GRR_GND' => '(GRR) Grand Rapids Ground',
     'MDW_GND' => '(MDW) MidwayGround',
     'MKE_GND' => '(MKE) Milwaukee Ground',
     'MKG_GND' => '(MKG) Muskegon Ground', 
     'MLI_GND' => '(MLI) Quad City Ground', 
     'MSN_GND' => '(MSN) Madison Ground',
     'ORD_DEL' => '(ORD) OHare Ground',
     'PIA_GND' => '(PIA) Peoria Ground',
     'RFD_GND' => '(RFD) Rockford Ground',
     'SBN_GND' => '(SBN) South Bend Ground',       
     'DEL' => '------------ DELIVERY ------------',
     'ALO_DEL' => '(ALO) Waterloo Clearance Delivery', 
     'AZO_DEL' => '(AZO) Kalamazoo Clearance Delivery', 
     'CID_DEL' => '(CID) Cedar Rapids Clearance Delivery',
     'CMI_DEL' => '(CMI) Champaign Clearance Delivery',
     'FWA_DEL' => '(FWA) Fort Wayne Clearance Delivery',
     'GRR_DEL' => '(GRR) Grand Rapids Clearance Delivery',
     'MDW_DEL' => '(MDW) Midway Clearance Delivery',
     'MKE_DEL' => '(MKE) Milwaukee Clearance Delivery',
     'MKG_DEL' => '(MKG) Muskegon Clearance Delivery', 
     'MLI_DEL' => '(MLI) Quad City Clearance Delivery', 
     'MSN_DEL' => '(MSN) Madison Clearance Delivery',
     'ORD_DEL' => '(ORD) OHare Clearance Delivery',
     'PIA_DEL' => '(PIA) Peoria Clearance Delivery',
     'RFD_DEL' => '(RFD) Rockford Clearance Delivery',
     'SBN_DEL' => '(SBN) South Bend Clearance Delivery',       
     'UNKNOWN' => 'Unknown'
    ];

    protected $table = 'feedback';

    protected $fillable = array('controller_id', 'position', 'level', 'comments', 'staff_comments', 'pilot_name', 'pilot_id', 'pilot_email', 'flight_callsign', 'status');

    public function controller() {
        return $this->hasOne('User', 'id', 'controller_id');
    }

    public function getLevelTextAttribute()
    {
    	switch($this->level)
    	{
    		case 0: return "Unsatisfactory";
    		case 1: return "Poor";
    		case 2: return "Fair";
    		case 3: return "Good";
    		case 4: return "Excellent";
    	}
    }

    public function getFeedbackPosAttribute()
    {
        foreach (Feedback::$Positions as $id => $Long) {
            if ($this->position == $id) {
                return $Long;
            }
        }

        return "";
    }

    public function sendPilotEmail()
    {
        return Mail::send('emails.feedbackpilot', ['feedback' => $this], function($message){
            $message->from('atm@zauartcc.org', 'ZAU ATM');
            $message->to($this->pilot_email);
            $message->subject('ZAU - Feedback Response');
        });
    }

    public function sendControllerEmail()
    {
        return Mail::send('emails.feedbackcontroller', ['feedback' => $this], function($message){
            $message->from('atm@zauartcc.org', 'ZAU ATM');
            $message->to($this->controller->email);
            $message->subject('ZAU - New Feedback');
        });
    }

}
