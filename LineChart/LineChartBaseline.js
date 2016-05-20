var exclude = [];

var margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = 800 - margin.left - margin.right,
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
	.ticks(10);

createLineChart();

function createLineChart() {    
    var svg = d3.select("body").append("svg")
        .attr("id", "mainchart")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    d3.tsv("data.tsv", type, function(error, data) {
    if (error) throw error;
    
    for(var key in data) {
        var val = data[key].month;
        
        if(exclude.indexOf(val)!=-1){
            delete data[key];
        }
    }
    
    var i = 0;
    
    for(var key in data) {
        if(key != i){
            data[i] = data[key];
            delete data[key];
        }
        i++;
    }
    
    x.domain(data.map(function(d) { if(d==null){return} return d.month; }));
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
		
    svg.append("path")
		.attr("class", "line")
		.attr("d", function() {
			var pathcoordinates = "";
			for(var key in data){
				if(pathcoordinates==""){
					pathcoordinates += ("m"+(Number(x(data[key].month))+Number(35))+","+(y(data[key].revenue)));
				}
				else {
					pathcoordinates += ("L"+(Number(x(data[key].month))+Number(35))+","+y(data[key].revenue));
				}
			}
			return pathcoordinates;
		});
        
    svg.selectAll(".bar")
        .data(data)
        .enter().append("rect")
        .attr("class", "bar")
        .attr("id", function(d) {if(d==null){return} return d.month} )
        .on("mouseover", function(d) {
            if(d==null){return} createBaseline(x(d.month), y(d.revenue));
        })
        .on("mouseout", function(d) {
            removeBaseline();
        })
        .attr("x", function(d) {if(d==null){return} return x(d.month); })
        .attr("width", function(d) {if(d==null){return} return x.rangeBand(); })
        .attr("y", 0)
        .attr("height", function(d) {if(d==null){return} return Number(height); })
        .attr("opacity", "0")
    });
}

function type(d) {
  d.revenue = +d.revenue;
  return d;
}

function createBaseline(baseX, baseY){
    var yValue = Number(baseY+margin.top);
    d3.select("svg").append("line")
        .attr("id", "baselineY")
        .attr("x1", margin.left)
        .attr("y1", yValue)
        .attr("x2", width+margin.left)
        .attr("y2", yValue)
        .attr("stroke-width",1)
        .attr("stroke", "black")
        .attr("stroke-dasharray", "15, 10");
}

function removeBaseline(){
    d3.select("#baselineY").remove();
}