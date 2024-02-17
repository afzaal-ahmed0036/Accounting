<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Item;
use App\Models\Party;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ProductionController extends Controller
{
    public function projectIndex(Request $request)
    {
        try {
            $pagetitle = 'Project Index';
            if ($request->ajax()) {
                $data = Project::with('client', 'teamLead')
                    ->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<div class="d-flex align-items-center col-actions"><a href="' . URL('/ProjectView/' . $row->id) . '"><i class="font-size-18 mdi mdi-eye-outline align-middle me-1 text-secondary"></i></a><a href="' . URL('/ProjectEdit/' . $row->id) . '"><i class="font-size-18 bx bx-pencil align-middle me-1 text-secondary"></i></a><a href="' . URL('/ProjectDelete/' . $row->id) . '"><i class="font-size-18 bx bx-trash align-middle me-1 text-danger"></i></a></div>';
                        return $btn;
                    })
                    ->addColumn('clientName', function ($row) {
                        return $row->client ? $row->client->PartyName : 'N/A';
                    })
                    ->addColumn('teamleadName', function ($row) {
                        return $row->teamLead ? $row->teamLead->name : 'N/A';
                    })
                    ->rawColumns(['action', 'clientName', 'teamleadName'])
                    ->make(true);
            }
            return view('projects.index', compact('pagetitle'));
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }
    public function projectCreate()
    {
        try {
            $pagetitle = 'Project Create';
            $teamLeads = Employee::where('designation', 'TeamLead')->get();
            $parties = DB::table('party')->get();

            return view('projects.create', compact('pagetitle', 'teamLeads', 'parties'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }

    public function projectSave(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'title' => 'required|max:255'
            ]);
            DB::beginTransaction();
            Project::create($request->except('_token'));
            DB::commit();
            return redirect('Project/Index')->with('error', 'Project Created Successfully')->with('class', 'success');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }

    public function projectView($id)
    {
        try {
            $project = Project::with('client', 'teamLead')
                ->findOrFail($id);
            // dd($project);
            return view('projects.show', compact('project'));
        } catch (\Exception $e) {
            // dd($e->getMessage());
            // DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }
    public function projectEdit($id)
    {
        try {
            $pagetitle = 'Project Create';
            $teamLeads = Employee::where('designation', 'TeamLead')->get();
            $parties = Party::all();
            $project = Project::findOrFail($id);
            return view('projects.edit', compact('pagetitle', 'teamLeads', 'parties', 'project'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }
    public function projectUpdate(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'title' => 'required|max:255'
            ]);
            DB::beginTransaction();
            Project::findOrFail($request->project_id)->update($request->except('_token', 'project_id'));
            DB::commit();
            return redirect('Project/Index')->with('error', 'Project Updated Successfully')->with('class', 'success');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }
    public function projectDelete($id)
    {
        try {
            DB::beginTransaction();
            Project::findOrFail($id)->delete();
            DB::commit();
            return redirect('Project/Index')->with('error', 'Project Deleted Successfully')->with('class', 'success');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }

    public function productionLogs(Request $request)
    {
        try {
            $pagetitle = 'Production Log';
            if ($request->ajax()) {
                $data = DB::table('invoice_master')->where('InvoiceNo', 'LIKE', 'BATCH%')->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<div class="d-flex align-items-center col-actions"><a href="' . URL('/ProductionLog/View/' . $row->InvoiceMasterID) . '"><i class="font-size-18 mdi mdi-eye-outline align-middle me-1 text-secondary"></i></a><a href="' . URL('/ProductionLog/Edit/' . $row->InvoiceMasterID) . '"><i class="font-size-18 bx bx-pencil align-middle me-1 text-secondary"></i></a><a href="javascript:void(0)" onclick="delete_invoice(' . $row->InvoiceMasterID . ')" ><i class="font-size-18 bx bx-trash text-danger align-middle me-1 text-secondary"></i></a></div>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('production.production_log', compact('pagetitle'));
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }
    public function productionLogCreate()
    {
        try {
            $pagetitle = 'Production Log Create';
            $items = Item::where('ItemType', 'Product')->get();
            $materials = Item::where('ItemType', 'RawMaterial')->get();
            $referenceNo = DB::table('invoice_master')
                ->select(DB::raw('LPAD(IFNULL(MAX(right(InvoiceNo,5)),0)+1,5,0) as VHNO '))->whereIn(DB::raw('left(InvoiceNo,5)'), ['BATCH'])->first();

            $invoice_no = 'BATCH-' . $referenceNo->VHNO;
            $referenceNo = (string)($referenceNo->VHNO);
            // dump($invoice_no);
            // dd($referenceNo);
            return view('production.production_log_create', compact('pagetitle', 'items', 'invoice_no', 'referenceNo', 'materials'));
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }
    public function productionLogSave(Request $request)
    {
        // dd($request->all());
        try {
            $rules = [
                '_token' => 'required|string',
                'BatchNo' => 'required|string|max:255',
                'ReferenceNo' => 'required|numeric',
                'Date' => 'required|string',
                'description' => 'nullable|string|max:255',
                'itemID' => 'required',
                'itemQty' => 'required',
                'total_value' => 'required',
                'rate' => 'required',
                'materialID' => 'required|array',
                'materialTotalQty' => 'required|array',
            ];
            $messages = [
                'itemID.required' => 'Please Select at least 1 Product.',
                'itemQty.required' => 'Please add the product quantity.',
                'total_value.required' => 'Please Select at least 1 Product',
                'rate.required' => 'Please Select at least 1 Product',
                'materialID.*.distinct' => 'Please select distinct Materials.',
                'materialID.*.required' => 'Please select Materials.',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            $validator->sometimes('materialID.*', 'distinct', function ($input) {
                return count($input->materialID) > 1;
            });
            if ($validator->fails()) {
                $firstErrorMessage = $validator->errors()->first();
                return back()->with('error', $firstErrorMessage)->with('class', 'danger')->withInput();
            }
            // dd($request->all());
            DB::beginTransaction();
            $invoice_mst = array(
                'InvoiceNo' => $request->BatchNo,
                'Date' => $request->Date,
                'ReferenceNo' => $request->BatchNo,
                'Subject' => $request->description,
                'SubTotal' => $request->total_value,
                'Total' => $request->total_value,
                'GrandTotal' => $request->total_value,
                'UserID' => Session::get('UserID'),
            );
            // dd($logData);
            $InvoiceMasterID = DB::table('invoice_master')->insertGetId($invoice_mst);
            $proINV = str_replace('BATCH', 'BATCHOUT', $request->BatchNo);
            $proBill = str_replace('BATCH', 'BATCHIN', $request->BatchNo);

            $proINdata = [
                'InvoiceMasterID' =>  $InvoiceMasterID,
                'InvoiceNo' => $proBill,
                'ItemID' => $request->itemID,
                'Qty' => $request->itemQty,
                'Rate' => $request->rate,
                'Total' => $request->total_value,
                'Gross' => $request->total_value
            ];
            DB::table('invoice_detail')->insertGetId($proINdata);
            foreach ($request->materialID as $key => $materialID) {
                $material = Item::findOrFail($materialID);
                $proOutdata = [
                    'InvoiceMasterID' =>  $InvoiceMasterID,
                    'InvoiceNo' => $proINV,
                    'ItemID' =>  $materialID,
                    'Qty' => $request->materialTotalQty[$key],
                    'Rate' => $material->CostPrice,
                    'Total' => $request->materialTotalQty[$key] * $material->CostPrice,
                    'Gross' => $request->materialTotalQty[$key] * $material->CostPrice,
                ];
                DB::table('invoice_detail')->insertGetId($proOutdata);
            }
            DB::commit();
            return redirect('Production/Logs')->with('error', 'Production LOG Saved Successfully')->with('class', 'success');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger')->withInput();
        }
    }
    public function productionLogEdit($id)
    {
        try {
            $pagetitle = 'Production Log Edit';
            $items = Item::where('ItemType', 'Product')->get();
            // $production = ProductionLog::with('productionLogDetails.material')->findOrFail($id);
            $production = DB::table('invoice_master')->where('InvoiceMasterID', $id)->first();
            $productDetails = DB::table('invoice_detail')->where('InvoiceMasterID', $id)->where('InvoiceNo', 'LIKE', 'BATCHIN%')->first();
            // dd($productDetails->ItemID);
            $materialDetails = DB::table('invoice_detail')->where('InvoiceMasterID', $id)->where('InvoiceNo', 'LIKE', 'BATCHOUT%')->get();
            $materials = Item::where('ItemType', 'RawMaterial')->get();
            return view('production.production_log_edit', compact('pagetitle', 'items', 'production', 'materials', 'productDetails', 'materialDetails'));
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }
    public function productionLogUpdate(Request $request)
    {
        // dd($request->all());
        try {
            $rules = [
                '_token' => 'required|string',
                'BatchNo' => 'required|string|max:255',
                // 'ReferenceNo' => 'required|numeric',
                'Date' => 'required|string',
                'description' => 'nullable|string|max:255',
                'itemID' => 'required',
                'itemQty' => 'required',
                'total_value' => 'required',
                'rate' => 'required',
                'materialID' => 'required|array',
                'materialTotalQty' => 'required|array',
            ];
            $messages = [
                'itemID.required' => 'Please Select at least 1 Product.',
                'itemQty.required' => 'Please Select at least 1 Product.',
                'total_value.required' => 'Please Select at least 1 Product',
                'rate.required' => 'Please Select at least 1 Product',
                'materialID.*.distinct' => 'Please select distinct Materials.',
                'materialID.*.required' => 'Please select Materials.',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            $validator->sometimes('materialID.*', 'distinct', function ($input) {
                return count($input->materialID) > 1;
            });
            if ($validator->fails()) {
                $firstErrorMessage = $validator->errors()->first();
                return back()->with('error', $firstErrorMessage)->with('class', 'danger')->withInput();
            }
            DB::beginTransaction();
            $id = $request->id;
            DB::table('invoice_detail')->where('InvoiceMasterID', $id)->delete();
            $logData = [
                'Date' => $request->Date,
                'description' => $request->description,
                'TotalQty' => ($request->itemQty),
                'Value' => ($request->total_value),
                'ProductID' => ($request->itemID),
                'ProductRate' => ($request->rate),
                'ReferenceNo' => str_replace('BATCH-', '', $request->BatchNo),
            ];
            $invoice_mst = array(
                'Date' => $request->Date,
                'Subject' => $request->description,
                'SubTotal' => $request->total_value,
                'Total' => $request->total_value,
                'GrandTotal' => $request->total_value,
                'UserID' => Session::get('UserID'),
            );
            // dd($logData);
            // $InvoiceMasterID = DB::table('invoice_master')->insertGetId($invoice_mst);
            DB::table('invoice_master')->where('InvoiceMasterID', $id)->update($invoice_mst);
            $proINV = str_replace('BATCH', 'BATCHOUT', $request->BatchNo);
            $proBill = str_replace('BATCH', 'BATCHIN', $request->BatchNo);

            $proINdata = [
                'InvoiceMasterID' =>  $id,
                'InvoiceNo' => $proBill,
                'ItemID' => $request->itemID,
                'Qty' => $request->itemQty,
                'Rate' => $request->rate,
                'Total' => $request->total_value,
                'Gross' => $request->total_value
            ];
            DB::table('invoice_detail')->insertGetId($proINdata);
            foreach ($request->materialID as $key => $materialID) {
                $material = Item::findOrFail($materialID);
                $proOutdata = [
                    'InvoiceMasterID' =>  $id,
                    'InvoiceNo' => $proINV,
                    'ItemID' =>  $materialID,
                    'Qty' => $request->materialTotalQty[$key],
                    'Rate' => $material->CostPrice,
                    'Total' => $request->materialTotalQty[$key] * $material->CostPrice,
                    'Gross' => $request->materialTotalQty[$key] * $material->CostPrice,
                ];
                DB::table('invoice_detail')->insertGetId($proOutdata);
            }
            DB::commit();
            return redirect('Production/Logs')->with('error', 'Production LOG Updated Successfully')->with('class', 'success');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger')->withInput();
        }
    }
    public function productionLogDelete($id)
    {
        try {
            DB::beginTransaction();
            // $production = ProductionLog::with('productionLogDetails')->findOrFail($id);
            // $production->productionLogDetails()->delete();
            $invoice_detail = DB::table('invoice_detail')->where('InvoiceMasterID', $id)->delete();
            $invoice_master = DB::table('invoice_master')->where('InvoiceMasterID', $id)->delete();
            DB::commit();
            return redirect('Production/Logs')->with('error', 'Production LOG Deleted Successfully')->with('class', 'success');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger')->withInput();
        }
    }
    public function productionLogView($id)
    {
        try {
            $pagetitle = 'Production Log View';
            $company = DB::table('company')->first();
            // $production = ProductionLog::with('product', 'productionLogDetails.material')->findOrFail($id);
            $production = DB::table('invoice_master')->where('InvoiceMasterID', $id)->first();
            $productDetails = DB::table('invoice_detail')->where('InvoiceMasterID', $id)->where('InvoiceNo', 'LIKE', 'BATCHIN%')->first();
            $materialDetails = DB::table('invoice_detail')->where('InvoiceMasterID', $id)->where('InvoiceNo', 'LIKE', 'BATCHOUT%')->get();

            return view('production.production_log_show', compact('pagetitle', 'production', 'company', 'productDetails', 'materialDetails'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }
    public function getMaterialStock($id)
    {
        try {
            $data = DB::table('v_inventory1')->select('Balance')->where('ItemID', $id)->first();
            if ($data) {
                $stock = $data->Balance;
            } else {
                $stock = 0;
            }
            $item = Item::findOrFail($id);
            return response()->json([
                'stock' => $stock,
                'item' => $item,
            ]);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function productionLogCreateNew()
    {
        try {
            $pagetitle = 'Production Log Create';
            $items = Item::where('ItemType', 'Product')->get();
            $units = DB::table('unit')->get();

            $materials = Item::where('ItemType', 'RawMaterial')->get();
            $referenceNo = DB::table('invoice_master')
                ->select(DB::raw('LPAD(IFNULL(MAX(right(InvoiceNo,5)),0)+1,5,0) as VHNO '))->whereIn(DB::raw('left(InvoiceNo,5)'), ['BATCH'])->first();

            $invoice_no = 'BATCH-' . $referenceNo->VHNO;
            $referenceNo = (string)($referenceNo->VHNO);
            // dump($invoice_no);
            // dd($referenceNo);
            return view('production.production_log_createNew', compact('pagetitle', 'items', 'invoice_no', 'referenceNo', 'materials', 'units'));
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }
}
