@extends('layouts.app')

@section('content')




<style>

    .d1{
    position: absolute;
    margin-left: 775px;
    margin-top: -64px;
    }
    .em{
        margin-left: 350px;
    margin-top: -113px;
    }
    .ex{

    margin-left: 224px;

    margin-top: -119px;
    }


</style>
    <div class="container">
        <h1 class="my-4">Data Dashboard</h1>

        <div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

        </div>





        <div class="fixed-filter-form">
            <form action="{{ route('data.store') }}" method="POST" class="form-inline mb-4">
                @csrf
                <div class="form-group mr-2">
                    <label for="filter_by" class="mr-2">Filter By:</label>
                    <select id="filter_by" name="filter_by" class="form-control" style="cursor: pointer;">
                        <option value="end_year" @if (request('filter_by', 'end_year') == 'end_year') selected @endif>End Year</option>
                        <option value="topic" @if (request('filter_by') == 'topic') selected @endif>Topic</option>
                        <option value="sector" @if (request('filter_by') == 'sector') selected @endif>Sector</option>
                        <option value="region" @if (request('filter_by') == 'region') selected @endif>Region</option>
                        <option value="pestle" @if (request('filter_by') == 'pest') selected @endif>Pestle</option>
                        <option value="source" @if (request('filter_by') == 'source') selected @endif>Source</option>
                        <option value="swot" @if (request('filter_by') == 'swot') selected @endif>Swot</option>
                    </select>
                </div>
                <div class="form-group mr-2">
                    <label for="filter_value" class="mr-2">Filter Value:</label>
                    <input type="text" id="filter_value" name="filter_value" value="{{ request('filter_value') }}"
                        class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>



        <div class="d1"      >
            <a href="{{ route('data.visualization') }}" class="btn btn-info">Visualization Dashboard</a>
             <br><br>
            <a href="{{ route('export') }}" class="btn btn-success ex ">Export Data</a> <br><br>
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group em ">
                 <span><button class="btn btn-primary">Import Data </button></span> <span><input type="file" name="file" class="form-control"  style= " width:150px  ; " ></span>
                </div>

            </form>


        </div>


        <div class="table-container">
            @if ($datas->isEmpty())
                <p>No data found.</p>
            @else
                <table class="table table-bordered">
                    <thead class="thead-sticky">
                        <tr>
                            <th>Id</th>

                            <th>Intensity</th>
                            <th>Likelihood</th>
                            <th>Relevance</th>
                            <th>Country</th>
                            <th>Topics</th>
                            <th>Region</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->intensity }}</td>
                                <td>{{ $data->likelihood }}</td>
                                <td>{{ $data->relevance }}</td>
                                <td>{{ $data->country }}</td>
                                <td>{{ $data->topic }}</td>
                                <td>{{ $data->region }}</td>
                                <td>{{ $data->city }}</td>
                                <td><a href="{{ route('data.show', $data->id) }}" class="btn btn-warning btn-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>



    </div>
@endsection
