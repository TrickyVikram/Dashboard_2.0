<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{

    public function index(Request $request)
    {
        $query = Data::query();
        $data = $query->get();

        return response()->json(['data' => $data, 'message' => 'Data fetched successfully'], 200); // API request
    }


    public function show($id)
    {
        $data = Data::findOrFail($id);

        return response()->json(['data' => $data, 'message' => 'Data fetched successfully'], 200); // API request
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([

            'topic' => 'required | string',
        ]);


        $data = Data::create($validatedData);



        return response()->json(['data' => $data, 'message' => 'Data created successfully'], 201);
    }



   
    public function filter(Request $request)
    {
        
        $validatedData = $request->validate([
            'end_year' => 'nullable|integer',
            'topic' => 'nullable|string|max:255',
            'sector' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'pestle' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'swot' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
           
        ]);

       
        $query = Data::query();

        
        foreach ($request->all() as $key => $value) {
            if (!empty($value)) {
                
                $key = strtolower($key);

               
                $query->whereRaw("LOWER($key) LIKE ?", ["%" . strtolower($value) . "%"]);
            }
        }

       
        $data = $query->get();

    
        if ($data->isEmpty()) {
            return response()->json(['message' => 'No data found'], 404);
        }

        
        return response()->json(['data' => $data, 'message' => ' Data found'], 200);
    }




}
