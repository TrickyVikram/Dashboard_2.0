<?php

namespace App\Http\Controllers;
use App\Imports\DataImport;
use App\Exports\DataExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Data;
use Illuminate\Support\Facades\DB;



class DataController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {

        $query = Data::query();
        $datas = $query->get();




        return view('data.index', compact('datas'));
    }



    public function show(  $id  )
    {


        $datas = Data::findOrFail($id);


        return view('data.show', compact('datas'));


    }



    public function store(Request $request){


        $query = Data::query();


        if ($request->has('filter_by') && $request->has('filter_value')) {
            $filterBy = $request->input('filter_by');
            $filterValue = $request->input('filter_value');


            if ($filterBy == 'end_year') {
                $query->where('end_year', $filterValue);
            } elseif ($filterBy == 'topic') {
                $query->where('topic', 'like', '%' . $filterValue . '%');
            } elseif ($filterBy == 'sector') {
                $query->where('sector', 'like', '%' . $filterValue . '%');
            } elseif ($filterBy == 'region') {
                $query->where('region', 'like', '%' . $filterValue . '%');
            } elseif ($filterBy == 'pest') {
                $query->where('pestle', 'like', '%' . $filterValue . '%');
            } elseif ($filterBy == 'source') {
                $query->where('source', 'like', '%' . $filterValue . '%');
            } elseif ($filterBy == 'swot') {
                $query->where('swot', 'like', '%' . $filterValue . '%');
            }


        }


        $datas = $query->get();


        return view('data.index', compact('datas'));

    }

    public function visualization(Request $request)
    {
        $filterBy = $request->input('filter_by', 'end_year');
        $filterValue = $request->input('filter_value');

        $query = Data::query();

        if ($filterValue) {
            $query->where($filterBy, $filterValue);
        }

        $data = $query->select($filterBy, DB::raw('count(*) as total'))
            ->groupBy($filterBy)
            ->get();



        return view('data.visualization', compact('data', 'filterBy'));
    }




    public function export()
    {
        return Excel::download(new DataExport, 'data.csv');

        return redirect()->back()->with('success', 'Data export Successfully');
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls',
        ]);

        Excel::import(new DataImport, $request->file('file'));

        return redirect()->back();
    }


}



