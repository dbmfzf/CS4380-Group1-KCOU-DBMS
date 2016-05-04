<script>
$(function () { 
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
    });");
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
   <script>

    function searchMusic(searchType){
        console.dir("searchMusic called");
        switch(searchType){
            case 'generic':
                window.location.href = "<?php echo base_url(); ?>index.php/music/search_music/?searchString=" + $("#genericSearch").val();
                break;
            case 'advanced':
                window.location.href = "<?php echo base_url(); ?>index.php/music/search_music/?songName=" + $("#songSearch").val() + "&artistName=" + $("#artistSearch").val() + "&albumName=" + $("#albumSearch").val() + "&genreName=" + $("#genreSearch").val();
                break;
            default:
                break;
        }
    }
    
    function toggleOptions(){
        var basicSearch = "Basic Search <span class=\"glyphicon glyphicon-triangle-top\"></span>";
        var advancedSearch = "Advanced Search <span class=\"glyphicon glyphicon-triangle-bottom\"></span>";
        if($("#toggleSearch").attr("searchType") == "Advanced"){
            $("#toggleSearch").html(basicSearch);
            $("#toggleSearch").attr("searchType", "Basic");
        }else{
            $("#toggleSearch").html(advancedSearch);
            $("#toggleSearch").attr("searchType", "Advanced");
        }
    }
</script>
<style>
    #searchBar {
        background-color: #AAA;
    }
    #toggleSearch {
        margin: 5px 0;
    }
    #searchMusic {
        height: 450px;
    }
</style>
<div class="well" id="searchMusic">
    <div class="well well-lg" id="searchBar">
        <form role="form" class="form-inline collapse in" id="genericSearchForm">
            <div class="hbox">
                <div class="form-group">
                  <label for="genericSearch">Search for:</label>
                   <input type="text" class="form-control" id="genericSearch" placeholder="Song, album, or artist"> 
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="searchMusic('generic')"><span class="glyphicon glyphicon-search"></span>  Search</button>
                </div>
            </div>
        </form>
        <button type="button" data-toggle="collapse" data-target=".form-inline" class="btn btn-primary" id="toggleSearch" searchType="Advanced" onclick="toggleOptions()">Advanced Search <span class="glyphicon glyphicon-triangle-bottom"></span> </button>
        <form role="form" class="form-inline collapse" id="advancedSearchForm">
                <div class="form-group">
                    <label for="songSearch">Song:</label>
                    <input type="text" class="form-control" id="songSearch" placeholder="Song name">
                </div>
                <div class="form-group">
                    <label for="artistSearch">Artist:</label>
                    <input type="text" class="form-control" id="artistSearch" placeholder="Artist name">
                </div>
                <div class="form-group">
                    <label for="albumSearch">Album:</label>
                    <input type="text" class="form-control" id="albumSearch" placeholder="Album name">
                </div>
                <div class="form-group">
                    <label for="genreSearch">Genre:</label>
                    <input type="text" class="form-control" id="genreSearch" placeholder="Genre">
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="searchMusic('advanced')"><span class="glyphicon glyphicon-search"></span>  Search</button>
                </div>
        </form>
    </div>
    <div id="resultArea">
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Song</th>
                        <th>Artist</th>
                        <th>Album</th>
                        <th>Genre</th>    
                        <th>Location</th>
                        <th>Add to Playlist</th>    
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $arrayOfSongs = json_decode($searchValues);
                        for($i = 0; $i < sizeof($arrayOfSongs); $i++){
                            echo("\t<tr>\n");
                            echo("\t\t<td>" . $arrayOfSongs[$i]->Song_title . "</td>\n");
                            echo("\t\t<td>" . $arrayOfSongs[$i]->Artist . "</td>\n");
                            echo("\t\t<td>" . $arrayOfSongs[$i]->Album . "</td>\n");
                            echo("\t\t<td>" . $arrayOfSongs[$i]->Genre . "</td>\n");
                            echo("\t\t<td>" . $arrayOfSongs[$i]->Location . "</td>\n");
                            echo "<td>";
                            echo '<a class="btn btn-primary" href="'.site_url("playlist/playlist/add_music/".$arrayOfSongs[$i]->sid).'">Add to...</a>';
                            echo "</td>";
                            echo("\t</tr>\n");
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
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
