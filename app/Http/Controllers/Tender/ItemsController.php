<?php

namespace App\Http\Controllers\Tender;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenders\TenderItems;
use App\Models\Tenders\UnitsMast;

class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $item = TenderItems::with('unit')->get();
        return view('tender.items.index',compact('item'));
    }

    public function create()
    {   
        $unit = UnitsMast::all();
        return view('tender.items.create',compact('unit'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name'     =>'required',
                                    'unit_id'  =>'required',
                                    'remarks'  =>'nullable'     
                                    ]);

        $data['name']      = ucfirst($data['name']);        
        TenderItems::create($data);
        return redirect()->route('tender_item.index')->with('success','Created Successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = TenderItems::find($id);
         $unit = UnitsMast::all();
        return view('tender.items.edit',compact('data','unit'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate(['name'     =>'required',
                                    'unit_id'  =>'required',
                                    'remarks'  =>'nullable'     
                                    ]);        
        $data['name']      = ucfirst($data['name'] );
        TenderItems::where('id',$id)->update($data);
        return redirect()->route('tender_item.index')->with('success','Update Successfully.');
    }

    public function destroy($id)
    {
        TenderItems::destroy($id);
        return redirect()->route('tender_item.index')->with('success','Deleted Successfully.');
    }
}
