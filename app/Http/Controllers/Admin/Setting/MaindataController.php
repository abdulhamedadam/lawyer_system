<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Maindata;
use App\Traits\ImageProcessing;
use Illuminate\Http\Request;
use App\Http\Requests\mainrequest;

class MaindataController extends Controller
{
    use ImageProcessing;

    public function index()
    {
        $mdata = Maindata::select('*')->first();

        return view('dashbord.maindata.insert', compact('mdata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(mainrequest $request)
    {
        try {
            //$data = new Maindata();


            $request->validated();
            $data['name'] = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $data['address'] = ['ar' => $request->address_ar, 'en' => $request->address_en];
            $data['description'] = ['ar' => $request->description_ar, 'en' => $request->description_en];
            $data['email'] = $request->email;
            $data['fax'] = $request->fax;
            $data['phone'] = $request->phone;
            $data['maplocation'] = $request->maplocation;
            if ($request->hasFile('image')) {
                $img = $request->file('image');
                $data['image'] = $this->upload_image($img, 'maindata');;
            }

            if ($request->has('id') &&(!empty($request->id))) {
                $mdata = Maindata::find($request->id);                  // another var to avoid conflict
                $mdata->update($data);
            } else {
                Maindata::truncate();
//                dd($data);
                Maindata::create($data);
            }
            // dd($data);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.mdata.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Maindata $maindata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maindata $maindata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maindata $maindata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maindata $maindata)
    {
        //
    }
}
