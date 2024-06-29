<?php

namespace App\Http\Controllers\Admin\HR;

use App\Http\Controllers\Controller;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin;
use App\Models\Admin\AreaSetting;
use App\Models\Admin\HR\HumanResource_M;
use App\Models\Admin\HR\Attendance_M;
use App\Models\Admin\HR\AttendanceDetails_M;
use App\Models\Admin\EmployeeFiles;
use App\Models\Admin\Employees;
use App\Models\Admin\GeneralSetting;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;

class HumanResource_C extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    protected $EmployeeRepository;
    protected $HRAttendanceRepository;
    protected $HRAttendanceDetailsRepository;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {

        $this->EmployeeRepository = createRepository($basicRepository, new Employees());
        $this->HRAttendanceRepository = createRepository($basicRepository, new Attendance_M());
        $this->HRAttendanceDetailsRepository = createRepository($basicRepository, new AttendanceDetails_M());

    }

    /**********************************************************/
    public function add_attendance($id=null)
    {
        $data['employees'] = $this->EmployeeRepository->getAll();
        $data['all_data'] = $this->HRAttendanceDetailsRepository->getByWhere(['attendance_id' => $id]);
      //  dd($data['all_data']);
        return view('dashbord.admin.Hr.attandance.attendance_form', $data);
    }

    /*********************************************************/
    public function save_attendance(Request $request, Attendance_M $attendance_M)
    {
        try {
            $attendanceDate = $request->input('attendance_date');
            $date_exist = $this->HRAttendanceRepository->getByWhere(['attendance_date' => $attendanceDate]);
            $data = $attendance_M->add_data($request);

            $attendance = $date_exist->isEmpty() ?
                $this->HRAttendanceRepository->create($data) :
                $this->HRAttendanceRepository->updateWhere(['attendance_date' => $attendanceDate], $data);

           // dd($date_exist[0]->id);

            foreach ($request->row_id as $row_id) {
                $rowData = [
                    'emp_id' => $request->input("emp_id_$row_id"),
                    'attendance_id' => $date_exist[0]->id,
                    'attendance_status' => $request->input("attendance_$row_id"),
                    'attendance_time' => $request->input("attendance_time_$row_id"),
                    'leave_time' => $request->input("leave_time_$row_id"),
                    'notes' => $request->input("notes_$row_id"),
                ];

                $date_exist->isEmpty() ?
                    $this->HRAttendanceDetailsRepository->create($rowData) :
                    $this->HRAttendanceDetailsRepository->updateWhere(['emp_id' => $row_id, 'attendance_id' => $date_exist[0]->id], $rowData);
            }

            return redirect()->route('admin.attandance')->with('toastMessage', translate('added_successfully'));
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /********************************************************************************/
    public function attendance()
    {
        return view('dashbord.admin.Hr.attandance.attendance_data');
    }
    /*********************************************************************************/
    public function get_ajax_attendance(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->HRAttendanceRepository->getAll();
            $counter = 0;
            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('attendance_date', function ($row) {
                    return $row->attendance_date;
                })
                ->addColumn('month', function ($row) {
                    return getMonthName($row->month);
                })
                ->addColumn('year', function ($row) {
                    return $row->year;
                })
                ->addColumn('action', function ($row) {
                    return '
    <div class="btn-group">
        <a href="" class="btn btn-sm btn-warning" title="">
            <i class="bi bi-pencil"></i>'.translate('edit').'
        </a>
        <a href="'. route('admin.delete_book', $row->id) .'" onclick="return confirm(\'Are You Sure To Delete?\')" class="btn btn-sm btn-danger">
            <i class="bi bi-trash"></i>'.translate('delete').'
        </a>
         <a href="'. route('admin.delete_book', $row->id) .'" onclick="return confirm(\'Are You Sure To Delete?\')" class="btn btn-sm btn-primary">
            <i class="bi bi-info"></i>'.translate('details').'
        </a>
    </div>
    ';

                })->rawColumns(['image', 'action'])
                ->make(true);

            return $dataTable->toJson();
        }
    }
}
