<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContractForms_R;
use App\Models\Admin\ContractForms_M;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Interfaces\BasicRepositoryInterface;
//use Knp\Snappy\Pdf;
//use SnappyPDF;
use Dompdf\Options;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


class ContractForms_C extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    protected $ContractsFormRepository;


    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->ContractsFormRepository  = createRepository($basicRepository, new ContractForms_M());
    }

    /******************************************************************/
   public function contract_forms_data($id=null)
   {
       $data['contract_id']=$id;
       $data['contracts']=$this->ContractsFormRepository->getAll();

       if($id != null)
       {
           $data['contract_body']=$this->ContractsFormRepository->getById($id)->contract_body;
       }else{
           $data['contract_body']=null;
       }
       //dd($data);
       return view('dashbord.admin.contract_forms.all_contract_forms',$data);
   }
    /********************************************************************/
    public function add_contract_form()
    {
        return view('dashbord.admin.contract_forms.create_contract_form');
    }
    /********************************************************************/
    public function save_contract(ContractForms_R $request,ContractForms_M $contractForms_M)
    {
        try {
            $data=$contractForms_M->save_contract_data($request);
            $this->ContractsFormRepository->create($data);
            $request->session()->flash('toastMessage', translate('contract_added_successfully'));
            return redirect()->route('admin.contract_forms_data');

        }catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /****************************************************************/
    public function get_contract_body($id)
    {
        $contract = $this->ContractsFormRepository->getById($id);
        $response = [
            'contract_body' => $contract->contract_body
        ];
        return response()->json($response);
    }
    /************************************************************/
    public function generate_pdf(Request $request)
    {
//        $html = $request->input('contract_body');
//        $contractBodyWithoutTags = strip_tags($html);
//        $pdf = Pdf::loadView('dashbord.admin.pdf.contract', [
//            'content' => $contractBodyWithoutTags,
//        ], [], [
//            'title' => 'Certificate',
//            'format' => 'A4-P',
//            'orientation' => 'L'
//        ]);
//
//        return $pdf->stream('document.pdf');
        $data['content']=$request->input('contract_body');
//        $html = $request->input('contract_body');
//        $content = strip_tags($html);
//        $data['content'] = $content;
        return view('dashbord.admin.pdf.contract', $data);

    }



}
