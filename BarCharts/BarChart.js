var order = ["PAX", "Com", "Group", "HR", "Procurement", "Legal", "Shipping", "Sales"];

var margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = 500 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

createBarChart();

function createBarChart() {
	d3.select("#mainchart").remove();
    d3.select("#resetbutton").remove();

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
        .ticks(10);

    var svg = d3.select("body").append("svg")
        .attr("id", "mainchart")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    d3.tsv("data.tsv", type, function(error, data) {
    if (error) throw error;
    
    for(var key in data) {
        var val = data[key].department;
        
        if(order.indexOf(val)!=-1){
            data[order.indexOf(val)+10] = data[key];
            delete data[key];
        }
    }
    for(var key in data) {
        data[key-10] = data[key];
        delete data[key];
    }
    
    x.domain(data.map(function(d) { if(d==null){return} return d.department; }));
    y.domain([0, d3.max(data, function(d) { if(d==null){return} return d.revenue; })]);

    svg.append("g")
        .attr("class", "x axis")
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

    svg.selectAll(".bar")
        .data(data)
        .enter().append("rect")
        .attr("class", "bar")
        .attr("id", function(d) {if(d==null){return} return d.department; })
        /*.on("click", function(d) {
            console.log(d.department);
            removeBar(d.department);
            })*/
        .on("mouseover", function(d) {
            createBaseline(d.department);
        })
        .on("mouseout", function(d) {
            removeBaseline();
        })
        .on("drag", function(d){ 
            d3.select("#"+d.department).attr("x", event.clientX-margin.left-30); 
        })
        .on("dragend", function(d){ 
            d3.select("#"+d.department).attr("x", event.clientX-margin.left-30);
            sort();
            createBarChart();
        })
        .attr("x", function(d) {if(d==null){return} return x(d.department); })
        .attr("width", x.rangeBand())
        .attr("y", function(d) {if(d==null){return} return y(d.revenue); })
        .attr("height", function(d) {if(d==null){return} return height - y(d.revenue); });
        
        sort();
    });
    
    d3.select("body").append("button")
        .attr("id", "resetbutton")
        .text("Reset")
        .on("click", function(){resetChart(); });
}
function type(d) {
  d.revenue = +d.revenue;
  return d;
}

function resetChart() {
    order = ["PAX", "Com", "Group", "HR", "Procurement", "Legal", "Shipping", "Sales"];
    createBarChart();
}

function removeBar(id){
	var oId = order.indexOf(oId,1);
    order.splice(oId);
    createBarChart();
}

function createBaseline(id){
    var yValue = Number(d3.select("#"+id).attr("y")) + Number(margin.top);
    d3.select("svg").append("line")
        .attr("id", "baseline")
        .attr("x1", margin.left)
        .attr("y1", yValue)
        .attr("x2", width+margin.left)
        .attr("y2", yValue)
        .attr("stroke-width",1)
        .attr("stroke", "black")
        .attr("stroke-dasharray", "15, 10");
}

function removeBaseline(){
    d3.select("#baseline").remove();
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
    console.log(sortArraySorted);
    console.log(order);
}