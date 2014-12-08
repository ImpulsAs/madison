<?php
/**
 * 	Note meta model
 */
class NoteMeta extends Eloquent{
	protected $table = 'note_meta';
  protected $softDelete = true;
	
	const TYPE_USER_ACTION = "user_action";
	
	public function user(){
		return $this->belongsTo('User');
	}
	
}

