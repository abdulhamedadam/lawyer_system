<?php

namespace App\Http\Controllers\Admin\Archive;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Archive\ArchiveSave_R;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin;
use App\Models\Admin\Archive\Achive_m;
use App\Models\Admin\Archive\AchiveFiles_m;
use App\Models\Admin\Archive\ArchiveSettings;
use App\Models\Admin\Cases;
use App\Models\Admin\CaseFiles;
use App\Models\Admin\Cleints;
use App\Models\Admin\CleintsFile;
use App\Models\Admin\EmployeeFiles;
use App\Models\Admin\Employees;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class Archive_c extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /***********************************************************/

    protected $ArchiveRepository;
    protected $ArchiveStructureRepository;
    protected $CassesRepository;
    protected $ClientsRepository;
    protected $ArchiveFilesRepository;
    protected $CassesFilesRepository;
    protected $EmployeeRepository;
    protected $ClientsFilesRepository;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->ArchiveRepository  = createRepository($basicRepository, new Achive_m());
        $this->ArchiveFilesRepository  = createRepository($basicRepository, new AchiveFiles_m());
        $this->ArchiveStructureRepository = createRepository($basicRepository, new ArchiveSettings());
        $this->CassesRepository   = createRepository($basicRepository, new Cases());
        $this->CassesFilesRepository   = createRepository($basicRepository, new CaseFiles());
        $this->EmployeeRepository = createRepository($basicRepository, new Employees());
        $this->EmployeeFilesRepository = createRepository($basicRepository, new EmployeeFiles());
        $this->ClientsRepository  = createRepository($basicRepository, new Cleints());
        $this->ClientsFilesRepository  = createRepository($basicRepository, new CleintsFile());

    }

    /*************************************************************/
    public function archive_data()
    {
        return view('dashbord.admin.archive.archive_data');
    }
    /*************************************************************/
    public function get_ajax_archive(Request $request)
    {
        if ($request->ajax()) {
            $archive_model = new Achive_m();
            $data          = $archive_model->get_data_table();



            $counter = 0;
            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('archive_type', function ($row) {
                    return $row->archive_type;
                })
                ->addColumn('related_folders', function ($row) {
                    $folder =[1 => translate('casses'), 2 => translate('employees'), 3 => translate('clients'),4 => translate('not_related')];
                    return $folder[$row->related_folder];
                })
                ->addColumn('related_entity', function ($row) {
                    $folder =[1 =>($row->case_name) , 2 => ($row->employee), 3 => ($row->client_name),4 => translate('not_related')];
                    return $folder[$row->related_entity_id];
                })

                ->addColumn('secret_degree', function ($row) {

                    return '<span style="color:'.$row->secret_color.'">'.$row->secret_degree_name.' : </span>';
                })
                ->addColumn('place', function ($row) {
                    return  '<span style="color:green"><i class="bi bi-archive"></i>'.translate('desk').' : </span><span style="color:red">' . $row->desk . '</span>
          <br/><span style="color:green"><i class="bi bi-bookshelf"></i>'.translate('shelf').' : </span><span style="color:red">' . $row->shelf . '</span>
          <br/><span style="color:green"><i class="bi bi-folder2"></i>'.translate('folder_code').' : </span><span style="color:red">' . $row->folder_code . '</span>';


                })
                ->addColumn('action', function ($row) {
                    return '<a href="'.route('admin.edit_archive',$row->id).'"class="btn btn-sm btn-warning" title="">
                          <i class="bi bi-pencil fs-2"></i>
                        </a>
                        <a onclick="return confirm(\'Are You Sure To Delete?\')" href="'.route('admin.delete_user',$row->id).'"  class="btn btn-sm btn-danger">
                            <i class="bi bi-trash fs-2"></i>
                        </a>
                        <a  href="'.route('admin.archive_files',$row->id).'"  class="btn btn-sm btn-success">
                            <i class="bi bi-files fs-2"></i>
                        </a>
                        ';
                })->rawColumns(['place', 'action','secret_degree','role'])
                ->make(true);

            return $dataTable->toJson();
        }
    }
    /*************************************************************/
    public function add_archive()
    {
        $data['types']=$this->ArchiveStructureRepository->getBywhere(['ttype'=>'archive_type']);
        $data['desk']=$this->ArchiveStructureRepository->getBywhere(['ttype'=>'desk']);
        $data['secret_degree']=$this->ArchiveStructureRepository->getBywhere(['ttype'=>'secret_degree']);
        return view('dashbord.admin.archive.archive_form',$data);
    }
    /************************************************************/
    public function get_shelf($id)
    {
        $data['shelf'] = $this->ArchiveStructureRepository->getBywhere(array('ttype' => 'shelf'));
        return view('dashbord.admin.archive.load_shelf_data', $data);
    }
    /************************************************************/
    public function get_related_data($id)
    {
        if($id == 1)
        {
            $data['id']=$id;
            $case_model = new Cases();
            $data['all_data'] = $case_model->get_data_table_data();
        }elseif ($id == 2)
        {
            $data['id']=$id;
            $data['all_data'] = $this->EmployeeRepository->getAll();
        }elseif ($id == 3)
        {
            $data['id']=$id;
            $data['all_data'] = $this->ClientsRepository->getAll();
        }

        return view('dashbord.admin.archive.load_related_data', $data);
    }
    /************************************************************/
    public function save_archive(ArchiveSave_R $request)
    {
        try {

            $archive_model = new Achive_m();
            $archive_data = $archive_model->save_archive($request);
            $archive = $this->ArchiveRepository->create($archive_data);

            $this->handleRelatedFolder($request, $archive);

            notify()->success(translate('archive_added_successfully'), '');
            return redirect()->route('admin.archive_data');
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function handleRelatedFolder($request, $archive)
    {

        switch ($request->related_folder) {
            case 1:
                $files = $this->CassesFilesRepository->getBywhere(array('case_id_fk'=>$request->related_entity_id));
                break;
            case 2:
                $files = $this->EmployeeFilesRepository->getBywhere(array('emp_id_fk'=>$request->related_entity_id));
                break;
            case 3:
                $files = $this->ClientsFilesRepository->getBywhere(array('client_id_fk'=>$request->related_entity_id));
                break;
            case 4:
                $files = null;
                break;
            default:
                $files = null;
        }
        //dd($archive);
        if ($files != null) {
            $archive_model = new Achive_m();
            //dd('here');
            foreach ($files as $file){
                //dd($file);
                $archive_files_data = $archive_model->save_archive_files($archive,$file);
                $this->ArchiveFilesRepository->create($archive_files_data);
            }

        }
    }
    /************************************************************************/
    public function edit_archive($id)
    {
        $data['types']=$this->ArchiveStructureRepository->getBywhere(['ttype'=>'archive_type']);
        $data['desk']=$this->ArchiveStructureRepository->getBywhere(['ttype'=>'desk']);
        $data['secret_degree']=$this->ArchiveStructureRepository->getBywhere(['ttype'=>'secret_degree']);
        $data['all_data']     =$this->ArchiveRepository->getById($id);
        return view('dashbord.admin.archive.archive_edit',$data);
    }

    /***********************************************************************/
    public function update_archive(ArchiveSave_R $request,$id)
    {
        try {

            $archive_model = new Achive_m();
            $archive_data = $archive_model->save_archive($request);
             $this->ArchiveRepository->update($id,$archive_data);
            $archive=$this->ArchiveRepository->getById($id);
            $this->ArchiveFilesRepository->deleteWhere(array('archive_id'=>$id));
            $this->handleRelatedFolder($request, $archive);

            notify()->success(translate('archive_added_successfully'), '');
            return redirect()->route('admin.archive_data');
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /************************************************************************/
    public function delete_archive(Request $request,$id)
    {
        $archive = $this->ArchiveRepository->delete($id);
        $this->ArchiveFilesRepository->deleteWhere(array('archive_id'=>$id));
        if ($archive) {
            notify()->error(translate('archive_deleted_successfully'), '');
            return redirect()->route('admin.archive_data');
        } else {
            return redirect()->route('admin.archive_data');
        }

    }

    /*************************************************************************/
    public function archive_files($id)
    {
        $archive_model = new Achive_m();
        $data['all_data']     = $archive_model->get_data_table($id)[0];
        //$data['all_data']     =$this->ArchiveRepository->getById($id);
        $data['files_data']        =$this->ArchiveFilesRepository->getBywhere(array('archive_id'=>$id));
        //dd($data['files_data']);
        return view('dashbord.admin.archive.archive_files',$data);
    }

    /***************************************************************************/
    public function add_archive_files(Request $request,$archive_id)
    {
        try {
            $archive = $this->ArchiveRepository->getById($archive_id);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $folder_name=[1=>'case',2=>'employee',3=>'client',4=>''];
                $dataX = $this->saveFile($file, $folder_name[$archive->related_folder].$archive->id);

                $data['file']           = $dataX;
                $data['file_name']      = $request->file_name;
                $data['archive_id']     = $archive->id;
                $data['folder_code']    = $archive->id;
                $data['publisher']      = auth('admin')->user()->id;
                $data['publisher_n']    = auth('admin')->user()->name;

                $file                   = $this->ArchiveFilesRepository->create($data);
               //  dd($file);
            }
            notify()->success(translate('File_added_successfully'), '');
            return redirect()->route('admin.archive_files',$archive_id);


        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /********************************************************/
    public function read_file($file_id)
    {

        try {
            $archive=$this->ArchiveFilesRepository->getById($file_id);
            $file_path  = Storage::disk('files')->path($archive->file);
            $fileContent = Storage::get($file_path);
            return response()->file($file_path);



        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /*******************************************************************/
    public function delete_file(Request $request,$file_id)
    {
        try {
            $archive=$this->ArchiveRepository->getById($file_id);
            $archive_id=$archive->related_entity_id;
            $this->ArchiveFilesRepository->delete($file_id);

            notify()->error(translate('File_deleted_successfully'), '');
            return redirect()->route('admin.case_morfqat',$archive_id);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /****************************************************************************/
    public function download_file($file_id)
    {
        try {
            $archive_file=$this->ArchiveFilesRepository->getById($file_id);
            $file_path = Storage::disk('files')->path($archive_file->file);
            $headers = [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="' . $archive_file->file . '"',
            ];
            return response()->download($file_path);



        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


}
