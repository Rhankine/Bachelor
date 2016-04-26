var exclude = ["HR", "Legal"]

var margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = 500 - margin.left - margin.right,
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

createBarChart();

function createBarChart() {


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
					pathcoordinates += ("m"+x(data[key].month)+","+y(data[key].revenue));
					console.log("m"+x(data[key].month)+","+y(data[key].revenue));
				}
				else {
					pathcoordinates += ("L"+x(data[key].month)+","+y(data[key].revenue));
					console.log("L"+x(data[key].month)+","+y(data[key].revenue));
				}
			}
			console.log(pathcoordinates);
			return pathcoordinates;
		});
    });
}
function type(d) {
  d.revenue = +d.revenue;
  return d;
}

function removeBar(id){
	exclude.push(id);
	d3.select("#mainchart").remove();
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
        .attr("stroke-width",2)
        .attr("stroke", "black")
        .attr("stroke-dasharray", "15, 10");
}

function removeBaseline(){
    d3.select("#baseline").remove();
}