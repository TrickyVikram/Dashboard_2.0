@extends('layouts.app')

@section('content')
    <style>

        .chart-container {


           display: flex;
           display:

        }
    </style>

    <div class="container">
        <h1 class="my-4">Data Visualization Dashboard</h1>
        <h2><a href="{{ url('data') }}"><p class="nav-link">Data Dashboard</p></a></h2>

        <form method="GET" action="{{ url('visualization') }}">
            <div class="form-group mr-2" style="width: 100px;">
                <label for="filter_by" class="mr-2">Filter By:</label>
                <select id="filter_by" name="filter_by" class="form-control" style="cursor: pointer;">
                    <option value="end_year" @if (request('filter_by', 'end_year') == 'end_year') selected @endif>End Year</option>
                    <option value="topic" @if (request('filter_by') == 'topic') selected @endif>Topic</option>
                    <option value="sector" @if (request('filter_by') == 'sector') selected @endif>Sector</option>
                    <option value="region" @if (request('filter_by') == 'region') selected @endif>Region</option>
                    <option value="pestle" @if (request('filter_by') == 'pestle') selected @endif>Pestle</option>
                    <option value="source" @if (request('filter_by') == 'source') selected @endif>Source</option>
                    <option value="swot" @if (request('filter_by') == 'swot') selected @endif>Swot</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <div class="chart-container">

            <div class="chart  ">
                <svg id="pie-chart" width="400" height="400"></svg>
            </div>
            <div class="chart  ">
                <svg id="bar-chart" width="400" height="400"></svg>
            </div>

            <div class="chart  ">
                <svg id="line-chart" width="400" height="400"></svg>
            </div>
        </div>
    </div>

    <script src="https://d3js.org/d3.v5.min.js"></script>
    <script>
        const data = @json($data);
        const filterBy = @json($filterBy);

        // Line Chart
        const svgLine = d3.select("#line-chart"),
            widthLine = +svgLine.attr("width"),
            heightLine = +svgLine.attr("height");

        const marginLine = {top: 20, right: 20, bottom: 30, left: 40},
            innerWidthLine = widthLine - marginLine.left - marginLine.right,
            innerHeightLine = heightLine - marginLine.top - marginLine.bottom;

        const gLine = svgLine.append("g")
            .attr("transform", `translate(${marginLine.left},${marginLine.top})`);

        const xLine = d3.scaleBand().rangeRound([0, innerWidthLine]).padding(0.1),
            yLine = d3.scaleLinear().rangeRound([innerHeightLine, 0]);

        xLine.domain(data.map(d => d[filterBy]));
        yLine.domain([0, d3.max(data, d => d.total)]);

        gLine.append("g")
            .attr("class", "axis axis--x")
            .attr("transform", `translate(0,${innerHeightLine})`)
            .call(d3.axisBottom(xLine));

        gLine.append("g")
            .attr("class", "axis axis--y")
            .call(d3.axisLeft(yLine).ticks(10))
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", "0.71em")
            .attr("text-anchor", "end")
            .text("Total Count");

        const line = d3.line()
            .x(d => xLine(d[filterBy]) + xLine.bandwidth() / 2)
            .y(d => yLine(d.total));

        gLine.append("path")
            .datum(data)
            .attr("class", "line")
            .attr("fill", "none")
            .attr("stroke", "steelblue")
            .attr("stroke-width", 1.5)
            .attr("d", line);

        gLine.selectAll(".dot")
            .data(data)
            .enter().append("circle")
            .attr("class", "dot")
            .attr("cx", d => xLine(d[filterBy]) + xLine.bandwidth() / 2)
            .attr("cy", d => yLine(d.total))
            .attr("r", 5)
            .attr("fill", "steelblue");

        // Bar Chart
        const svgBar = d3.select("#bar-chart"),
            widthBar = +svgBar.attr("width"),
            heightBar = +svgBar.attr("height");

        const marginBar = {top: 20, right: 20, bottom: 30, left: 40},
            innerWidthBar = widthBar - marginBar.left - marginBar.right,
            innerHeightBar = heightBar - marginBar.top - marginBar.bottom;

        const gBar = svgBar.append("g")
            .attr("transform", `translate(${marginBar.left},${marginBar.top})`);

        const xBar = d3.scaleBand().rangeRound([0, innerWidthBar]).padding(0.1),
            yBar = d3.scaleLinear().rangeRound([innerHeightBar, 0]);

        xBar.domain(data.map(d => d[filterBy]));
        yBar.domain([0, d3.max(data, d => d.total)]);

        gBar.append("g")
            .attr("class", "axis axis--x")
            .attr("transform", `translate(0,${innerHeightBar})`)
            .call(d3.axisBottom(xBar));

        gBar.append("g")
            .attr("class", "axis axis--y")
            .call(d3.axisLeft(yBar).ticks(10))
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", "0.71em")
            .attr("text-anchor", "end")
            .text("Total Count");

        gBar.selectAll(".bar")
            .data(data)
            .enter().append("rect")
            .attr("class", "bar")
            .attr("x", d => xBar(d[filterBy]))
            .attr("y", d => yBar(d.total))
            .attr("width", xBar.bandwidth())
            .attr("height", d => innerHeightBar - yBar(d.total))
            .style("fill", "GREEN");

        // Pie Chart
        const svgPie = d3.select("#pie-chart"),
            widthPie = +svgPie.attr("width"),
            heightPie = +svgPie.attr("height"),
            radiusPie = Math.min(widthPie, heightPie) / 2;

        const gPie = svgPie.append("g")
            .attr("transform", `translate(${widthPie / 2},${heightPie / 2})`);

        const color = d3.scaleOrdinal(d3.schemeCategory10);

        const pie = d3.pie()
            .sort(null)
            .value(d => d.total);

        const pathPie = d3.arc()
            .outerRadius(radiusPie - 10)
            .innerRadius(0);

        const labelPie = d3.arc()
            .outerRadius(radiusPie - 200)
            .innerRadius(radiusPie -1);

        const arc = gPie.selectAll(".arc")
            .data(pie(data))
            .enter().append("g")
            .attr("class", "arc");

        arc.append("path")
            .attr("d", pathPie)
            .attr("fill", d => color(d.data[filterBy]));

        arc.append("text")
            .attr("transform", d => `translate(${labelPie.centroid(d)})`)
            .attr("dy", "0.35em")
            .attr("dx", "-3em")
            .text(d => `${d.data[filterBy]}: ${d.data.total}`);
    </script>
@endsection
