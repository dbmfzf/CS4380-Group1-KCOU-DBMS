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
                            //echo("\t\t<td><form action=\"" . base_url() . "index.php/playlist/playlist/index\" method=\"post\">
                            //<input type=\"hidden\" name=\"sid\" value=\"" . openssl_encrypt($arrayOfSongs[$i]->sid, 'aes128', 'CS4380G1', OPENSSL_RAW_DATA, '6871358468913485') . "\">
                            //<input type=\"submit\" value=\"Add\" class=\"btn btn-primary\"></form></td>\n");
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

