<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cases\CaseSessions_R;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Cases;
use App\Models\Admin\CaseSessions_M;
use App\Models\Admin\CaseSettings;
use App\Models\Admin\Employees;
use App\Models\Admin\Masrofat_M;
use App\Services\CaseSessionService;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;
class CaseSessions_C extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /*---------------------------------------------------*/
    protected $caseSessionService;

    public function __construct(CaseSessionService $caseSessionService)
    {
        $this->caseSessionService = $caseSessionService;
    }
    /*******************************************************************/
    public function sessions()
    {
        return view('dashbord.admin.sessions.sessions_data');
    }
    /*******************************************************************/
    public function get_ajax(Request $request,CaseSessions_M $caseSessions_M)
    {
        if ($request->ajax()) {

            $data = $caseSessions_M->get_sessions();

            $counter = 0;

            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('case_name', function ($row) {
                    return $row->case_name;
                })
                ->addColumn('session_title', function ($row) {
                    return $row->session_title;
                })
                ->addColumn('session_date', function ($row) {
                    return $row->session_date;
                })
                ->addColumn('session_time', function ($row) {
                    return $row->session_time;;
                })
                ->addColumn('assign_to', function ($row) {
                    return $row->employee_name;
                })

                ->addColumn('court', function ($row) {

                    return $row->court_name;
                })

                ->addColumn('session_judge', function ($row) {

                    return $row->session_judge;
                })

                ->addColumn('session_notes', function ($row) {

                    return $row->session_notes;
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group">
    <a href="'.route('admin.edit_session', $row->id).'" class="btn btn-sm btn-warning" title="'.translate('edit').'">
        <i class="bi bi-pencil"></i>'.translate('edit').'
    </a>
    <a href="'.route('admin.delete_session', $row->id).'" onclick="return confirm(\''.__('Are You Sure To Delete?').'\')" class="btn btn-sm btn-danger">
        <i class="bi bi-trash"></i>'.translate('delete').'
    </a>
    <a data-bs-toggle="modal" data-bs-target="#myModal_results" onclick="edit_session_results('.$row->id.')" class="btn btn-sm btn-primary">
        <i class="bi bi-info"></i>'.translate('session_results').'
    </a>
</div>';


                })->rawColumns(['image', 'action', 'client_name', 'fees','remain','total_paid'])
                ->make(true);

            return $dataTable->toJson();
        }
    }

    /*******************************************************************/

    public function add_session(Cases $cases, CaseSessions_M $caseSessions_M)
    {
        $data = $this->caseSessionService->getSessions($cases, $caseSessions_M);
        return view('dashbord.admin.sessions.sessions_form', $data);
    }
    /**********************************************************************/
    public function save_session(CaseSessions_R $request, CaseSessions_M $caseSessions_M)
    {
        $success = $this->caseSessionService->addSession($request, $caseSessions_M);
        if ($success) {
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.sessions');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to add session']);
        }
    }
    /**********************************************************************/
    public function edit_session(Cases $cases, CaseSessions_M $caseSessions_M, $session_id)
    {
        $data = $this->caseSessionService->editSessions($cases, $caseSessions_M, $session_id);
        return view('dashbord.admin.sessions.sessions_edit', $data);
    }
    /*********************************************************************/
    public function update_session(CaseSessions_R $request, CaseSessions_M $caseSessions_M, $session_id)
    {
//        dd($request);
        $success = $this->caseSessionService->updateSession($request, $caseSessions_M, $session_id);
        if ($success) {
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.sessions');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to add session']);
        }
    }
    /*********************************************************************/
    public function delete_session(Request $request,$session_id)
    {

        $success = $this->caseSessionService->deletesession($session_id);
        if ($success) {
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.sessions');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to add session']);
        }
    }

    /*****************************************************************/
    public function session_results($session_id)
    {
        $data['session_data'] = $this->caseSessionService->session_results($session_id);
        return view('dashbord.admin.sessions.sessions_results', $data);
    }

    /*****************************************************************/
    public function update_session_results(Request $request,CaseSessions_M $caseSessions_M,$session_id)
    {
        $success = $this->caseSessionService->updateSessionResults($request, $caseSessions_M, $session_id);
        if ($success) {
            $request->session()->flash('toastMessage', translate('added_successfully'));
            return redirect()->route('admin.sessions');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to add session']);
        }
    }




}
