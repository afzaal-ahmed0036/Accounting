<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    public function Employee(Request $request)
    {
        $pagetitle = 'Employees';
        $teamLeads = Employee::where('designation', 'TeamLead')->get();
        if ($request->ajax()) {
            $data = Employee::with('teamLead')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('action', function ($row) {
                //     $btn = '<div class="d-flex align-items-center col-actions"><a href="' . URL('/PettyCashEdit/' . $row->PettyMstID) . '"><i class="bx bx-pencil align-middle me-1 text-secondary"></i></a><a href="' . URL('/PettyDelete/' . $row->PettyMstID) . '"><i class="bx bx-trash align-middle me-1 text-secondary"></i></a></div>';
                //     return $btn;
                // })
                ->addColumn('teamLeadName', function ($row) {
                    return $row->teamLead ? $row->teamLead->name : 'N/A';
                })
                ->rawColumns(['teamLeadName'])
                ->make(true);
        }

        return view('employee.employee', compact('pagetitle', 'teamLeads'));
    }
    public function EmployeeSave(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $request->validate([
                'EmployeeName' => 'required|max:255',
                'designation' => 'required'
            ]);
            if ($request->designation == "TeamLead") {
                Employee::create([
                    'name' => $request->EmployeeName,
                    'mobile' => $request->Mobile,
                    'address' => $request->Address,
                    'designation' => $request->designation,
                ]);
            } else {
                Employee::create([
                    'name' => $request->EmployeeName,
                    'mobile' => $request->Mobile,
                    'address' => $request->Address,
                    'designation' => $request->designation,
                    'teamLeadID' => $request->team_lead_id
                ]);
            }
            DB::commit();
            return back()->with('error', 'Employee Created Successfully')->with('class', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->with('class', 'danger');
            //throw $th;
        }
    }
}
