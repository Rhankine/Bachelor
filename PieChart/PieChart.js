var width = 960,
    height = 500,
    radius = Math.min(width, height) / 2;

var color = d3.scale.ordinal()
    .range(["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00", "#ff704d"]);

var arc = d3.svg.arc()
    .outerRadius(radius - 10)
    .innerRadius(0);

var labelArc = d3.svg.arc()
    .outerRadius(radius - 40)
    .innerRadius(radius - 40);

var pie = d3.layout.pie()
    .sort(null)
    .value(function(d) { return d.revenue; });

var svg = d3.select("body").append("svg")
    .attr("width", width)
    .attr("height", height)
  .append("g")
    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

d3.tsv("data.tsv", type, function(error, data) {
  if (error) throw error;

  var g = svg.selectAll(".arc")
      .data(pie(data))
    .enter().append("g")
      .attr("class", "arc");

  g.append("path")
      .attr("d", arc)
      .style("fill", function(d) { return color(d.data.department); });

  g.append("text")
      .attr("transform", function(d) { return "translate(" + labelArc.centroid(d) + ")"; })
      .attr("dy", ".35em")
      .text(function(d) { return d.data.department; });
});

d3.select("body").append("table").append("tr").append("td").append("button");

function type(d) {
  d.revenue = +d.revenue;
  return d;
}

var curAngle = 0;
var interval = null;

svg.on("mousedown", function(d) {
    interval = setInterval(goRotateRight,20);
});

svg.on("mouseup", function(d){
    clearInterval(interval);
})

function goRotateRight() {
    curAngle += 1;
    svg.attr("transform", "translate(" + width / 2 + "," + height / 2 + ") rotate(" + curAngle + "," + 0 + "," + 0 + ")");
  }
  
function goRotateLeft() {
    curAngle -= 1;
    svg.attr("transform", "translate(" + width / 2 + "," + height / 2 + ") rotate(" + curAngle + "," + 0 + "," + 0 + ")");    
}