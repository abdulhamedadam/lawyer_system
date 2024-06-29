<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DailyReports_R;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Cases;
use App\Models\Admin\Daily_Reports_M;
use App\Models\Admin\Employees;
use App\Models\Admin\GeneralSetting;
use App\Models\Admin\Library_M;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;
use Mockery\Exception;

class Daily_Reports_C extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /***********************************************************/

    protected $DailyReportsRepository;
    protected $EmployeeRepository;
    protected $CasesRepository;


    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->DailyReportsRepository  = createRepository($basicRepository, new Daily_Reports_M());
        $this->EmployeeRepository  = createRepository($basicRepository, new Employees());
        $this->CasesRepository  = createRepository($basicRepository, new Cases());

    }

    /***************************************************************/
    public function daily_reports_data()
    {
        return view('dashbord.admin.daily_reports.reports_data');
    }
    /***************************************************************/
    public function get_ajax_reports(Request $request,Daily_Reports_M $daily_Reports_M)
    {
        if ($request->ajax()) {
            $data =$daily_Reports_M->getAll();

            $counter = 0;

            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('related_cases', function ($row) {
                      if($row->related_to_case=='no')
                      {
                          $case=translate('not_related_to_case');
                      }elseif ($row->related_to_case=='yes')
                      {
                          $case=$row->case_name;
                      }
                    return $case;
                })
                ->addColumn('send_from', function ($row) {
                    return $row->from_emp_name;;
                })
                ->addColumn('send_to', function ($row) {
                    return $row->to_emp_name;;
                })

                ->addColumn('details', function ($row) {
                    $details = $row->details;
                    $words = str_word_count($details, 1);

                    if (count($words) > 5) {
                        // If the number of words is greater than 30, truncate the array to the first 30 words
                        $words = array_slice($words, 0, 5);
                        $details = implode(' ', $words) . '...';
                    }

                    return $details;
                })
                ->addColumn('action', function ($row) {
                    return '<a href="'.route('admin.edit_report',$row->id).'"class="btn btn-sm btn-warning" title="">
                          <i class="bi bi-pencil fs-2"></i>
                        </a>
                        <a onclick="return confirm(\'Are You Sure To Delete?\')" href="'.route('admin.delete_report',$row->id).'"  class="btn btn-sm btn-danger">
                            <i class="bi bi-trash fs-2"></i>
                        </a>

                         <a  data-bs-toggle="modal" onclick="get_details('.$row->id.')" data-bs-target="#modaldetails"  class="btn btn-sm btn-success">
                            <i class="bi bi-info fs-2"></i>
                        </a>






                        ';

                })->rawColumns(['action', 'details'])
                ->make(true);

            return $dataTable->toJson();
        }
    }
    /****************************************************************/
    public function add_report()
    {
        $data['employees']=$this->EmployeeRepository->getAll();
        $data['cases']=$this->CasesRepository->getAll();
        return view('dashbord.admin.daily_reports.reports_form',$data);
    }
    /***************************************************************/
    public function save_report(DailyReports_R $request,Daily_Reports_M $report)
    {
        try {
            $data=$report->save_report_data($request);
            $this->DailyReportsRepository->create($data);
            $request->session()->flash('toastMessage', translate('report_added_successfully'));
            return redirect()->route('admin.daily_reports_data');

        }catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /***************************************************************/
    public function edit_report($id)
    {
        $data['employees']=$this->EmployeeRepository->getAll();
        $data['cases']=$this->CasesRepository->getAll();
        $data['all_data']=$this->DailyReportsRepository->getById($id);
        return view('dashbord.admin.daily_reports.reports_edit',$data);
    }

    /****************************************************************/
    public function update_report(DailyReports_R $request,Daily_Reports_M $report,$id)
    {
        try {
            $data=$report->save_report_data($request);
            $this->DailyReportsRepository->update($id,$data);
            $request->session()->flash('toastMessage', translate('report_updated_successfully'));
            return redirect()->route('admin.daily_reports_data');

        }catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**************************************************************/
    public function get_details($id)
    {
        $data['all_data']=$this->DailyReportsRepository->getById($id);
        return view('dashbord.admin.daily_reports.reports_details',$data);
    }

    /*************************************************************/
    public function delete_report(Request $request,$id)
    {
        try {

            $this->DailyReportsRepository->delete($id);
            $request->session()->flash('toastMessage', translate('report_deleted_successfully'));
            return redirect()->route('admin.daily_reports_data');

        }catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
