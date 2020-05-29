<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenderboq extends Model
{
    protected $table   = 'tender_boq';
    protected $guarded = [];

    public function uom(){
    	return $this->belongsTo('App\Uom','uom_id');
    }

    public function item(){
    	return $this->belongsTo('App\Models\Items','item_id');
    }
}
