<?php
/**
 * 	Document date model
 */
class Date extends Eloquent{

  protected $softDelete = true;

	//Document this meta is describing
	public function docs(){
		return $this->belongsTo('Doc');
	}
}

