var order = ["Group", "HR", "Procurement", "Legal", "Shipping", "Sales"];
var original = ["Group", "HR", "Procurement", "Legal", "Shipping", "Sales"];

var margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = order.length * 80 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;
    
var x = d3.scale.ordinal()
    .rangeRoundBands([0, width], .1);

var y = d3.scale.linear()
    .range([height, 0]);

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left")
    .ticks(1);

var svg = d3.select("body").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
.append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

var did = d3.select("#h_v").attr("value");

d3.tsv("../DataDep/data"+did+".tsv", type, function(error, data) {
    if (error) throw error;

    x.domain(order);
    y.domain([0, d3.max(data, function(d) { if(d==null){return} return d.revenue; })]);

    svg.append("g")
        .attr("class", "x axis")
        .attr("id", "xaxis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);

    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis)
        .append("text")
        .attr("transform", "rotate(-90)")
        .attr("y", 6)
        .attr("dy", ".71em")
        .style("text-anchor", "end")
        .text("Revenue");

    var drag = d3.behavior.drag();

    svg.selectAll(".bar")
        .data(data)
        .enter().append("rect")
        .attr("class", "bar drag")
        .attr("id", function(d) {if(d==null){return} return d.department; })
        .attr("x", function(d) {if(d==null){return} return x(d.department); })
        .attr("width", x.rangeBand())
        .attr("y", function(d) {if(d==null){return} return y(d.revenue); })
        .attr("height", function(d) {if(d==null){return} return height - y(d.revenue); })
        .call(drag);

    drag.on("drag", function(d) {
        d3.select("#"+d.department).attr("x", d3.event.x-30);
        });
        
    drag.on("dragend", function() { sort(); });
});



d3.select("body").append("button")
    .attr("id", "resetbutton")
    .text("Reset")
    .on("click", function(){ reset(); });

function type(d) {
  d.revenue = +d.revenue;
  return d;
}

function sort(){
    sortArray = [];
    order.forEach(function(dep) {
        sortArray[d3.select("#" + dep).attr("x")] = dep;
        sortArraySorted = Object.keys(sortArray).sort(function(a,b){return sortArray[a]-sortArray[b]})
    });
    order = [];
    sortArraySorted.forEach(function(d) {
        order.push(sortArray[d]);
    })
    
    x.domain(order);
    svg.select("#xaxis").call(xAxis);
    
    for (i = 0; i < order.length; i++){
        d3.select("#"+order[i]).attr("x", function() {return x(order[i])})
    .attr("width", x.rangeBand())
    }
}

function reset(){
    order = original;
    
    x.domain(order);
    svg.select("#xaxis").call(xAxis);
    
    for (i = 0; i < order.length; i++){
        d3.select("#"+order[i]).attr("x", function() {return x(order[i])})
    .attr("width", x.rangeBand())
    }
}