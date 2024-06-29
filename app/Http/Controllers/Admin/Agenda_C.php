<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Agenda\AgendaSave_R;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Agenda_M;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;

class Agenda_C extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /***********************************************************/

    protected $AgendaRepository;


    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->AgendaRepository  = createRepository($basicRepository, new Agenda_M());


    }
    /***************************************************/
    public function agenda_data()
    {
        $data['all_data'] =$this->AgendaRepository->getAll();
        return view('dashbord.admin.agenda.agenda_data',$data);
    }
    /***************************************************/
    public function save_agenda(AgendaSave_R $request,Agenda_M $agenda_m)
    {
        try {

            $data      = $agenda_m->save_agenda_data($request);
            $this->AgendaRepository->create($data);
            $request->session()->flash('toastMessage', translate('agenda_added_successfully'));
            return redirect()->route('admin.agenda_data');
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**************************************************/
    public function delete_event(Request $request,$id)
    {

            $this->AgendaRepository->delete($id);


    }

    /**************************************************/
    public function edit_event(Request $request,Agenda_M $agenda_M,$id)
    {

            $data      = $agenda_M->update_agenda_data($request);
            $this->AgendaRepository->update($id,$data);


    }
}
