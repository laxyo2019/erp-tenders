<?php

namespace App\Http\Controllers\Tender;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tender_status;

class TenderStatus extends Controller
{
    
    public function index()
    {
        $data = Tender_status::all();
        return view('tender.tender_status.index',compact('data'));
    }


    public function create()
    {
        return view('tender.tender_status.create');
    }

    
    public function store(Request $request)
    {
        $data = $request->validate(['name'=>'required']);
        Tender_status::create($data);
        return redirect()->route('tender_status.index')->with('success','Created Successfully.');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $data = Tender_status::find($id);
        return view('tender.tender_status.edit',compact('data'));
    }

   
    public function update(Request $request, $id)
    {
        $data = $request->validate(['name'=>'required']);
        Tender_status::where('id',$id)->update($data);
        return redirect()->route('tender_status.index')->with('success','Update Successfully.');
    }
    

    public function destroy($id)
    {
        Tender_status::where('id',$id)->delete();
        return redirect()->route('tender_status.index')->with('success','Delete Successfully.');
    }
}
