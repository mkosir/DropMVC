<div id="mainContentWordCloud" class="text-center" style="align-items: center;">
    <div class="text-center">
        <h4>Word cloud</h4>
        <p id="mainContentWordCloudDesc" class="lead">Find out which words were frequently mentioned in drops titles!</p>
        <br />
    </div>

    <script src="http://d3js.org/d3.v3.min.js"></script>
    <script src="js/d3.layout.cloud.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
    <script>
        let wordsCloud;

        // only for testing - echo the data directly to javascript
        // wordsCloud = <?php //echo $data; ?>//;

        // wordsCloud = [
        //     {"text":"First1","size":90},{"text":"Not2","size":80},{"text":"Bird3","size":70},
        //     {"text":"Hello4","size":60},{"text":"Word5","size":50},{"text":"Marketplaces6","size":45},
        //     {"text":"Hello7","size":40},{"text":"Word8","size":35},{"text":"Marketplaces9","size":30},
        //     {"text":"Hello10","size":25},{"text":"Word11","size":20},{"text":"Marketplaces12","size":20},
        //     {"text":"Hello13","size":15},{"text":"Word14","size":15},{"text":"Marketplaces15","size":15}
        // ];


        // var xhttp = new XMLHttpRequest();
        // xhttp.onreadystatechange = function() {
        //     if (this.readyState == 4 && this.status == 200) {
        //         document.getElementById("mainContentWordCloudDesc").innerHTML = this.responseText;
        //         wordsCloud = this.responseText;
        //     }
        // };
        // xhttp.open("GET", "wordcloud/getDataWordCloudTitles", true);
        // xhttp.send();

        $.ajax({
            type: "GET",
            url: "wordcloud/getDataWordCloudTitles",
            dataType: "json",
            success: createWordCloud,
            error: function (jqXHR, exception) {
                let msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                document.getElementById("mainContentWordCloudDesc").innerHTML = msg;
            }
        });

        function createWordCloud(wordsCloud) {
            let fillColor = d3.scale.category20b();
            let w = 600,
                h = 500;

            let layout = d3.layout.cloud()
                .size([w, h])
                .words(wordsCloud)
                // .words([
                //     "Hello", "world", "normally", "you", "want", "more", "words",
                //     "Hello", "world", "normally", "you", "want", "more", "words",
                //     "Hello", "world", "normally", "you", "want", "more", "words",
                //     "Hello", "world", "normally", "you", "want", "more", "words",
                //     "than", "this"].map(function(d) {
                //     return {text: d, size: 10 + Math.random() * 90, test: "test"};
                // }))
                .padding(5)
                // .rotate(function() { return ~~(Math.random() * 2) * 90; }) // 90 degree random rotation
                // function() { return (~~(Math.random() * 6) - 3) * 30; } - default function
                .font("Impact")
                .fontSize(function(d) { return d.size; })
                .on("end", drawCloud);

            layout.start();

            function drawCloud(words) {
                d3.select("#mainContentWordCloud").append("svg")
                    .attr("width", layout.size()[0])
                    .attr("height", layout.size()[1])
                    .append("g")
                    .attr("transform", "translate(" + layout.size()[0] / 2 + "," + layout.size()[1] / 2 + ")")
                    .selectAll("text")
                    .data(words)
                    .enter().append("text")
                    .style("font-size", function(d) { return d.size + "px"; })
                    .style("font-family", "Impact")
                    .style("fill", function(d, i) { return fillColor(i); })
                    // .style("fill", "red" })
                    .attr("text-anchor", "middle")
                    .attr("transform", function(d) {
                        return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
                    })
                    .text(function(d) { return d.text; });
            }
        }
    </script>
</div>