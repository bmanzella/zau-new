<?php

class ATCCollection extends \Illuminate\Database\Eloquent\Collection
{

	public function getCenter()
	{
		return $this->filter(function($c){
			return preg_match('/^JAX_(.*)_CTR$/', $c->atc);
		})->lists('atc');
	}

	public function getF11()
	{
		return $this->filter(function($c){
			return preg_match('/^MCO(_(.*))?_APP$/', $c->atc);
		})->lists('atc');
	}

	public function getMCO()
	{
		return $this->reduce(function($m, $c){
			if (preg_match_all('/^MCO(_(.*))?_(TWR|GND|DEL)$/', $c->atc, $matches)) {
				$m = array_merge($m, $matches[3]);
			}
			return array_unique($m);
		}, []);
	}

	public function getJAX()
	{
		return $this->reduce(function($m, $c){
			if (preg_match_all('/^JAX(_(.*))?_(APP|TWR|GND|DEL)$/', $c->atc, $matches)) {
				$m = array_merge($m, $matches[3]);
			}
			return array_unique($m);
		}, []);
	}

	public function getCHS()
	{
		return $this->reduce(function($m, $c){
			if (preg_match_all('/^CHS(_(.*))?_(APP|TWR|GND|DEL)$/', $c->atc, $matches)) {
				$m = array_merge($m, $matches[3]);
			}
			return array_unique($m);
		}, []);
	}

	public function getDAB()
	{
		return $this->reduce(function($m, $c){
			if (preg_match_all('/^DAB(_(.*))?_(APP|TWR|GND|DEL)$/', $c->atc, $matches)) {
				$m = array_merge($m, $matches[3]);
			}
			return array_unique($m);
		}, []);
	}
}
