<script>
$(function () { 
    //get rid of the search area
    $('#songTab, #artistTab, #albumTab, #searchUsage').click(function(){
        $('#searchMusic').hide();
    });
    
    //show the search area again
    $('#searchTab').click(function(){
        $('#searchMusic').show();
    });
    <?php
    if($clearance < 3){
    echo("$('#searchUsageGraph').highcharts({
        title: {
            text: 'Search Frequency',
            x: -20 //center
        },
        xAxis: {
            categories: ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri','Sat']
        },
        yAxis: {
            title: {
                text: 'Searches'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'Searches'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: '1 Week',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2]
        }]
    }).click(function(){
        $('#searchMusic').hide();
    };");
    }
    ?>
});
</script>
<h1>Search for Music</h1>
<ul id="myTab" class="nav nav-tabs">
   <li class="active"><a href="#search" id="searchTab" data-toggle="tab">Search</a>
   </li>
   <li><a href="#song" id="songTab" data-toggle="tab">Popular Songs</a></li>
   <li><a href="#album" id="albumTab" data-toggle="tab">Popular Albums</a></li>
   <li><a href="#artist" id="artistTab" data-toggle="tab">Popular Artists</a></li>
   <?php echo $clearance < 3 ? "<li><a href=\"#searchUsage\" id=\"searchUsageTab\" data-toggle=\"tab\">Search Usage</a></li>" : ""; ?>
</ul>
<div id="myTabContent" class="tab-content">
   <div class="tab-pane fade in active" id="search">
   </div>
   <div class="tab-pane fade well" id="song">
      <table class="table table-striped">
          <thead>
              <th>Popularity</th>
              <th>Song</th>
              <th>Artist</th>
              <th>Album</th>
              <th>Genre</th>
              <th>Location</th>
          </thead>
            <tbody>
            <?php
                for($i = 0; $i < sizeof($songs); $i++){
                    echo("\t<tr>\n");
                    echo("\t\t<td>#" . ($i+1) . "</td>\n");
                    echo("\t\t<td>" . $songs[$i]->Song . "</td>\n");
                    echo("\t\t<td>" . $songs[$i]->Artist . "</td>\n");
                    echo("\t\t<td>" . $songs[$i]->Album . "</td>\n");
                    echo("\t\t<td>" . $songs[$i]->Genre . "</td>\n");
                    echo("\t\t<td>" . $songs[$i]->Location . "</td>\n");
                    echo("\t</tr>\n");
                    
                }
            ?>
            </tbody>
        </table>
      
    </div>
    <div  class="tab-pane fade well" id="album">
    <table class="table table-striped">
        <thead>
            <th>Popularity</th>
            <th>Album</th>
            <th>Artist</th>
            <th>Location</th>
        </thead>
        <tbody>
            <?php
                for($i = 0; $i < sizeof($albums); $i++){
                    echo("\t<tr>\n");
                    echo("\t\t<td>#" . ($i+1) . "</td>\n");
                    echo("\t\t<td>" . $albums[$i]->Album . "</td>\n");
                    echo("\t\t<td>" . $albums[$i]->Artist . "</td>\n");
                    echo("\t\t<td>" . $albums[$i]->Location . "</td>\n");
                    echo("\t</tr>\n");
                }
            ?>
        </tbody>
    </table>
      
   </div>
   <div  class="tab-pane fade well" id="artist">
     <table class="table table-striped">
        <thead>
            <th>Popularity</th>
            <th>Artist Name</th>
        </thead>
        <tbody>
            <?php
                for($i = 0; $i < sizeof($artists); $i++){
                    echo("\t<tr>\n");
                    echo("\t\t<td>#" . ($i+1) . "</td>\n");
                    echo("\t\t<td>" . $artists[$i]->Artist . "</td>\n");
                    echo("\t</tr>\n");
                }
            ?>
        </tbody>
    </table>
      
   </div>
   <?php 
    echo $clearance < 3 ?
   "<div class=\"tab-pane fade\" id=\"searchUsage\">
       <div id=\"searchUsageGraph\" align=\"center\" style=\"min-width: 600px; height: 450px; max-width: 800px; margin: 0 auto; padding-top:5%\"></div>
   </div>" : "";
    ?>
   
</div>
