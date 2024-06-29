<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Library_M extends Model
{
    use HasFactory;

    protected $table = 'tbl_library';
    protected $guarded = [];


    /******************************************/
    public function save_book_data($request,$book)
    {
        $data['fe2a']=$request->fe2a;
        $data['book_name']=$request->book_name;
        $data['book']=$book;
        $data['description']=$request->description;
        $data['author']=$request->author;
        $data['publisher_id']=auth('admin')->user()->id;
        $data['publisher_name']=auth('admin')->user()->name;
        return $data;
    }
    /************************************************/
    public function get_data_table_data($id)
    {
        // Create the base query
        $query = DB::table('tbl_library')
            ->select('tbl_library.*', 'fe2a.title as fe2a_name', 'authors.title as author_name')
            ->leftJoin('general_settings as fe2a', 'tbl_library.fe2a', '=', 'fe2a.id')
            ->leftJoin('general_settings as authors', 'tbl_library.author', '=', 'authors.id');

        //dd($id);
        if ($id !== null) {
            $query->where('tbl_library.fe2a', $id);
        }

        // Execute the query and fetch the results
        $libraryData = $query->get();

        return $libraryData;
    }

}
