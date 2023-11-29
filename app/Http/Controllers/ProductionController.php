<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Party;
use App\Models\Product;
use App\Models\ProductionLog;
use App\Models\ProductionLogDetail;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                $data = ProductionLog::all();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<div class="d-flex align-items-center col-actions"><a href="' . URL('/ProductionLog/View/' . $row->ProductionLogID) . '"><i class="font-size-18 mdi mdi-eye-outline align-middle me-1 text-secondary"></i></a><a href="' . URL('/ProductionLog/Edit/' . $row->ProductionLogID) . '"><i class="font-size-18 bx bx-pencil align-middle me-1 text-secondary"></i></a><a href="javascript:void(0)" onclick="delete_invoice(' . $row->ProductionLogID . ')" ><i class="font-size-18 bx bx-trash text-danger align-middle me-1 text-secondary"></i></a></div>';
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
            $items = Product::all();
            $invoice_no = ProductionLog::select('ReferenceNo')
                ->orderBy('ProductionLogID', 'desc')
                ->first();
            if ($invoice_no)
                $referenceNo = ++$invoice_no->ReferenceNo;
            else
                $referenceNo = 1;
            switch (strlen($referenceNo)) {
                case 1:
                    $paddingZeros = '0000';
                    break;
                case 2:
                    $paddingZeros = '000';
                    break;
                case 3:
                    $paddingZeros = '00';
                    break;
                case 4:
                    $paddingZeros = '0';
                    break;
                default:
                    $paddingZeros = '';
            }

            $invoice_no = 'BATCH-' . $paddingZeros . $referenceNo;
            $referenceNo = (string)($paddingZeros . $referenceNo);
            return view('production.production_log_create', compact('pagetitle', 'items', 'invoice_no', 'referenceNo'));
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
                'itemID' => 'required|array',
                'itemQty' => 'required|array',
                'total_value' => 'required|array',
                'rate' => 'required|array',
            ];
            $messages = [
                'itemID.required' => 'Please Select at least 1 Product.',
                'itemID.*.distinct' => 'Please Select Distinct Products.',
                'itemQty.required' => 'Please Select at least 1 Product.',
                'total_value.required' => 'Please Select at least 1 Product',
                'rate.required' => 'Please Select at least 1 Product'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            $validator->sometimes('itemID.*', 'distinct', function ($input) {
                return count($input->itemID) > 1;
            });
            if ($validator->fails()) {
                $firstErrorMessage = $validator->errors()->first();
                return back()->with('error', $firstErrorMessage)->with('class', 'danger')->withInput();
            }
            DB::beginTransaction();
            $logData = $request->except('_token', 'itemID', 'itemQty', 'total_value', 'rate');
            $logData['TotalQty'] = array_sum($request->itemQty);
            $logData['Value'] = array_sum($request->total_value);
            $logData['ReferenceNo'] = str_replace('BATCH-', '', $request->BatchNo);
            // dd($logData);
            $log = ProductionLog::create($logData);
            foreach ($request->itemID as $key => $productId) {
                $data = [
                    'ProductionLogID' => $log->ProductionLogID,
                    'BatchNo' => $request->BatchNo,
                    'ProductID' => $productId,
                    'Rate' => $request->rate[$key],
                    'Qty' => $request->itemQty[$key],
                    'Total' => $request->total_value[$key],
                    'WarehouseID' => null
                ];
                ProductionLogDetail::create($data);
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
            $items = Product::all();
            $production = ProductionLog::with('productionLogDetails')->findOrFail($id);
            return view('production.production_log_edit', compact('pagetitle', 'items', 'production'));
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
                'ReferenceNo' => 'required|numeric',
                'Date' => 'required|string',
                'description' => 'nullable|string|max:255',
                'itemID' => 'required|array',
                'itemQty' => 'required|array',
                'total_value' => 'required|array',
                'rate' => 'required|array',
            ];
            $messages = [
                'itemID.required' => 'Please Select at least 1 Product.',
                'itemID.*.distinct' => 'Please Select Distinct Products.',
                'itemQty.required' => 'Please Select at least 1 Product.',
                'total_value.required' => 'Please Select at least 1 Product',
                'rate.required' => 'Please Select at least 1 Product'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            $validator->sometimes('itemID.*', 'distinct', function ($input) {
                return count($input->itemID) > 1;
            });
            if ($validator->fails()) {
                $firstErrorMessage = $validator->errors()->first();
                return back()->with('error', $firstErrorMessage)->with('class', 'danger')->withInput();
            }
            DB::beginTransaction();
            $id = $request->id;
            ProductionLogDetail::where('ProductionLogID', $id)->delete();
            $logData = $request->except('_token', 'itemID', 'itemQty', 'total_value', 'rate', 'id');
            $logData['TotalQty'] = array_sum($request->itemQty);
            $logData['Value'] = array_sum($request->total_value);
            $logData['ReferenceNo'] = str_replace('BATCH-', '', $request->BatchNo);
            // dd($logData);
            ProductionLog::findOrFail($id)->update($logData);
            foreach ($request->itemID as $key => $productId) {
                $data = [
                    'ProductionLogID' => $id,
                    'BatchNo' => $request->BatchNo,
                    'ProductID' => $productId,
                    'Rate' => $request->rate[$key],
                    'Qty' => $request->itemQty[$key],
                    'Total' => $request->total_value[$key],
                    'WarehouseID' => null
                ];
                ProductionLogDetail::create($data);
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
            $production = ProductionLog::with('productionLogDetails')->findOrFail($id);
            $production->productionLogDetails()->delete();

            // Delete the main model
            $production->delete();
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
            $production = ProductionLog::with('productionLogDetails.product')->findOrFail($id);
            return view('production.production_log_show', compact('pagetitle', 'production', 'company'));
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }
}
