<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LibrarySave_R;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Agenda_M;
use App\Models\Admin\Cases;
use App\Models\Admin\GeneralSetting;
use App\Models\Admin\Library_M;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class Library_C extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /***********************************************************/

    protected $LibraryRepository;
    protected $GeneralSettingRepository;


    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->LibraryRepository  = createRepository($basicRepository, new Library_M());
        $this->GeneralSettingRepository  = createRepository($basicRepository, new GeneralSetting());

    }
    /*****************************************************************/
    public function library_data($fe2a_id=null)
    {
        $data['fe2at']=$this->GeneralSettingRepository->getBywhere(array('ttype'=>'book_tasnef'));
        $data['author']=$this->GeneralSettingRepository->getBywhere(array('ttype'=>'book_author'));
        $data['fe2a_id']=$fe2a_id;
        return view('dashbord.admin.library.library_data',$data);
    }
    /*****************************************************************/
    public function get_ajax_books(Request $request,Library_M $library_m,$fe2a_id=null)
    {
        if ($request->ajax()) {
            $data = $library_m->get_data_table_data($fe2a_id);

            $counter = 0;

            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('book_name', function ($row) {

                    return $row->book_name;
                })
                ->addColumn('author', function ($row) {

                    return $row->author_name;
                })
                ->addColumn('description', function ($row) {
                    return $row->description;;
                })
                ->addColumn('read_number', function ($row) {
                    return $row->read_number;
                })

                ->addColumn('size', function ($row) {
                    $ext = pathinfo($row->book, PATHINFO_EXTENSION);
                    $folder = Storage::disk('files');
                    $Destination = $folder->path($row->book);
                    if(file_exists($Destination)) {
                        $size= formatFileSize($Destination);
                    }else{
                        $size =0;
                    }
                    return $size;;
                })

                ->addColumn('type', function ($row) {
                    $ext = pathinfo($row->book, PATHINFO_EXTENSION);
                    $image = ['gif', 'Gif', 'ico', 'ICO', 'jpg', 'JPG', 'jpeg', 'JPEG', 'BNG', 'png', 'PNG', 'bmp', 'BMP'];
                    $file = ['pdf', 'PDF', 'xls', 'xlsx', ',doc', 'docx', 'txt'];
                    if (in_array($ext, $image)){
                        $type='<i class="bi bi-image fs-2" aria-hidden="true" title="'.$row->book_name.'"></i>';
                    }elseif (in_array($ext, $file))
                    {
                        $type=' <i class="bi bi-file-pdf fs-2" aria-hidden="true" title="'.$row->book_name.'"></i>';
                    }

                    return $type;
                })
                ->addColumn('book', function ($row) {
                    $ext = pathinfo($row->book, PATHINFO_EXTENSION);
                    $image = ['gif', 'Gif', 'ico', 'ICO', 'jpg', 'JPG', 'jpeg', 'JPEG', 'BNG', 'png', 'PNG', 'bmp', 'BMP'];
                    $file = ['pdf', 'PDF', 'xls', 'xlsx', ',doc', 'docx', 'txt'];
                    if(in_array($ext, $image))
                        {
                            $book='<a data-bs-toggle="modal" data-bs-target="#myModal-view">
                                <i class="bi bi-eye fs-2" title=""></i>
                            </a>
';
                        }elseif (in_array($ext, $file))
                    {
                        $book = '<a class="btn-open-pdf-modal" onclick="update_seen('.$row->id.')" data-book-url="'. route('admin.view_pdf', $row->book) .'">
            <i class="bi bi-eye fs-2" title=""></i>
        </a>';


                    }


                    return $book;
                })
                ->addColumn('action', function ($row) {
                    return '
    <div class="btn-group">
        <a href="'. route('admin.download_file2',[$row->book,$row->book_name]) .'" class="btn btn-sm btn-primary" title="">
            <i class="bi bi-download"></i>
        </a>
        <a href="'. route('admin.delete_book', $row->id) .'" onclick="return confirm(\'Are You Sure To Delete?\')" class="btn btn-sm btn-danger">
            <i class="bi bi-trash"></i>
        </a>
    </div>
    ';


                })->rawColumns(['type', 'action', 'book', 'fees'])
                ->make(true);

            return $dataTable->toJson();
        }
    }


    /***************************************************************/
    public function add_book()
    {
        $data['fe2at']=$this->GeneralSettingRepository->getBywhere(array('ttype'=>'book_tasnef'));
        $data['author']=$this->GeneralSettingRepository->getBywhere(array('ttype'=>'book_author'));
       // dd('sss');
        return view('dashbord.admin.library.library_form',$data);
    }

    /**************************************************************/
    public function save_book(LibrarySave_R $request,Library_M $library_m)
    {
        try {

            if ($request->hasFile('book')) {
                $file = $request->file('book');
                $dataX = $this->saveFile($file, 'book/' . $request->fe2a);
            }else{
                $dataX =null;
            }
            $data      = $library_m->save_book_data($request,$dataX);
            $this->LibraryRepository->create($data);
            $request->session()->flash('toastMessage', translate('book_added_successfully'));
            return redirect()->route('admin.library_data');
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /*******************************************************/
    public function viewPDF($path)
    {
        $filePath = storage_path('app/files/' . $path);
        if (file_exists($filePath)) {
            // Assuming you have a Book model with a field 'seen_count'
            Library_M::where('book', $path)->update(['read_number' => \DB::raw('read_number + 1')]);
            return response()->file($filePath);
        } else {
            abort(404);
        }
    }

    /**************************************************/
    public function update_seen(Request $request,$id)
    {
        $library=$this->LibraryRepository->getById($id);
        $data['read_number']=$library->read_number+1;
        $this->LibraryRepository->update($id,$data);
    }

    /***************************************************/
    public function delete_book(Request $request,$file_id)
    {
        try {

            $this->LibraryRepository->delete($file_id);

            $request->session()->flash('toastMessage', translate('book_deleted_successfully'));
            return redirect()->route('admin.library_data',$file_id);

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


}
