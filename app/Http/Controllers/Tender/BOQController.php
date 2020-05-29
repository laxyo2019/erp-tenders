<?php

namespace App\Http\Controllers\Tender;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tenderboq;
use App\Models\Items;
use App\Uom;
use App\Models\Tenders\Tender;

class BOQController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
   public function index()
    {
        $data = Tender::where('deleted_at',NULL)->get();
        return view('tender.BOQ.index',compact('data'));
    }

    public function create(){
        return view('tender.BOQ.create');   
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'item_id'=>'required',
            'uom_id'=>'required',
            'quantit'=>'required',
            'rate'=>'required',
            'amount'=>'required',
            'remark'=>'required',
            'item_desc'=>'required',
            'tender_id'=>'required'
        ]);

        Tenderboq::create($data);        
    }

 
    public function show($id)
    {
        //
    }

    public function edit($id){

        $data = Tenderboq::with(['item','uom'])->where('tender_id',$id)->get();
        $item = Items::all();        
        $uom  = Uom::all(); 
        $sum  =  Tenderboq::sum('amount');

        return view('tender.BOQ.create',compact('data','item','uom','id','sum')); 
    }

    public function update(Request $request, $id)
    {        
        $data = $request->validate([
            'item_id'=>'required',
            'uom_id'=>'required',
            'quantit'=>'required',
            'rate'=>'required',
            'amount'=>'required',
            'remark'=>'required',
            'item_desc'=>'required',
            'tender_id'=>'required'
        ]);

        Tenderboq::where('id',$id)->update($data);
        $data  = Tenderboq::with(['item','uom'])->where('tender_id',$id)->get();
        $sum   =  Tenderboq::sum('amount');
        $array = array('data'=>$data,'sum'=>$sum);
        return view('tender.BOQ.refresh',compact('array'));  
    }

    public function destroy($id)
    {
        $data = Tenderboq::where('id',$id)->delete();
    }

    public function customEdit($id){
       $data = Tenderboq::find($id);
       return $data ;
    }
}
