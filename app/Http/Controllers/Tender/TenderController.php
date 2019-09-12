<?php

namespace App\Http\Controllers\Tender;

use App\Http\Controllers\Controller;
use App\Models\Tenders\Tender;
use App\Models\Tenders\TenderCategory;
use App\Models\Tenders\TenderType;
use Illuminate\Http\Request;

class TenderController extends Controller
{
	public function index()
	{
		$types = TenderType::all();
		$categories = TenderCategory::all();
		$tenders = Tender::with('category', 'type')->get();
		return view('tender.master.index', compact('tenders', 'types', 'categories'));
	}

	public function getForm(Request $request, $type)
	 {
	  return view('tender.master.forms.'.$type);
	 }

	public function create()
	{
		$tender_types = TenderType::all();
		$tender_categories = TenderCategory::all();
		return view('tender.master.create',compact('tender_types','tender_categories'));
	}

	public function store(Request $request)
	{
		$data = $request->validate([
 			'title'	=> 'required|string|max:255',
 			'category_id'	=> 'required',
 			'type_id'	=> 'required',
 			'priority'	=> 'required'
 		]);
 		$is_eligible = isset($request->is_eligible) ? $request->is_eligible : 0;
 		$tender = new Tender();
 		$tender->title = $data['title'];
 		$tender->account_code = 12345;
 		$tender->is_eligible = $is_eligible;
 		$tender->category_id = $data['category_id'];
 		$tender->type_id = $data['type_id'];
 		$tender->priority = $data['priority'];
 		$tender->save();
 		return redirect()->route('tender_master.index')->with('success','Created Successfully.');
	}

	public function show($id)
	{
		$tender = Tender::find($id);
		return view('tender.master.show',compact('tender'));
	}

	public function edit($id)
	{
		$tender_types = TenderType::all();
		$tender_categories = TenderCategory::all();
		$tender = Tender::find($id);
		return view('tender.master.edit',compact('tender','tender_types','tender_categories'));
	}

	public function update(Request $request,$id)
	{
		$data = $request->validate([
 			'title'	=> 'required|string|max:255',
 			'category_id'	=> 'required',
 			'type_id'	=> 'required',
 			'priority'	=> 'required'
 		]);
		$is_eligible = isset($request->is_eligible) ? $request->is_eligible : 0;
 		 $tender = Tender::find($id);
     $tender->title = $data['title'];
     $tender->is_eligible = $is_eligible;
     $tender->category_id = $data['category_id'];
     $tender->type_id = $data['type_id'];
     $tender->priority = $data['priority'];
     $tender->save();
 		return redirect()->route('tender_master.index')->with('success','Updated Successfully.');
	}

	public function destroy($id)
	{
		$tender = Tender::find($id);
    $tender->delete();
  	return redirect()->route('tender_master.index')->with('success','Deleted Successfully.');
	}
}