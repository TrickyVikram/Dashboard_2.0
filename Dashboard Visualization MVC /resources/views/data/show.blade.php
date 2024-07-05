@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Data Show</h1>

        <table class="table table-bordered">
            <thead class="thead-sticky">
                <tr>
                    <th>End Year</th>
                    <th>City Longitude</th>
                    <th>City Latitude</th>
                    <th>Intensity</th>
                    <th>Sector</th>
                    <th>Topic</th>
                    <th>Insight</th>
                    <th>SWOT</th>
                    <th>URL</th>
                    <th>Region</th>
                    <th>Start Year</th>
                    <th>Impact</th>
                    <th>Added</th>
                    <th>Published</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Relevance</th>
                    <th>PESTLE</th>
                    <th>Source</th>
                    <th>Title</th>
                    <th>Likelihood</th>

                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{{ $datas->end_year }}</td>
                    <td>{{ $datas->citylng }}</td>
                    <td>{{ $datas->citylat }}</td>
                    <td>{{ $datas->intensity }}</td>
                    <td>{{ $datas->sector }}</td>
                    <td>{{ $datas->topic }}</td>
                    <td>{{ $datas->insight }}</td>
                    <td>{{ $datas->swot }}</td>
                    <td>{{ $datas->region }}</td>
                    <td>{{ $datas->start_year }}</td>
                    <td>{{ $datas->impact }}</td>
                    <td>{{ $datas->added }}</td>
                    <td>{{ $datas->published }}</td>
                    <td>{{ $datas->city }}</td>
                    <td>{{ $datas->country }}</td>
                    <td>{{ $datas->relevance }}</td>
                    <td>{{ $datas->pestle }}</td>
                    <td>{{ $datas->source }}</td>
                    <td>{{ $datas->title }}</td>
                    <td>{{ $datas->likelihood }}</td>
                </tr>

            </tbody>
        </table>
    </div>
@endsection
