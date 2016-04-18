<script>

    function searchMusic(searchType){
        console.dir("searchMusic called");
        switch(searchType){
            case 'generic':
                $.getJSON("../../../index.php/music/search_music/genericSearchHandler",
                        {"searchString" : $("#genericSearch").val()}, 
                        function ( data ){
                            console.dir("inside of anonymous function");
                            fillResult( data );
                });
                break;
            case 'advanced':
                $.getJSON("../../../index.php/music/search_music/advancedSearchHandler",
                         {
                            "songName" : $("#songSearch").val(),
                            "artistName" : $("#artistSearch").val(),
                            "albumName" : $("#albumSearch").val(),
                            "genreName" : $("#genreSearch").val()
                         }, 
                         function ( data ){
                            console.dir("inside of anonymous function");
                            fillResult( data );
                });
                break;
            default:
                break;
        }
    }
     
    function fillResult(musicArray){
        console.dir("fillResult called");
    }
    
    function toggleOptions(){
        var basicSearch = "Basic Search <span class=\"glyphicon glyphicon-menu-up\"></span>";
        var advancedSearch = "Advanced Search <span class=\"glyphicon glyphicon-menu-down\"></span>";
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
    .songContent {
        margin: 0px;
        height: 150px;
    }
    .songContent:nth-child(even) {
        background: #DDD;
    }
    .songContent:nth-child(odd) {
        background: #FAFAFA;
    }
    #searchBar {
        background-color: #AAA;
    }
    #toggleSearch {
        margin: 5px 0;
    }
    /*
    if I can't fix the position of the search button then this will do it just as well
    works for both search buttons
    {margin-top: 25px}
    */
</style>
<div class="well">
    <div class="well well-lg" id="searchBar">
        <form role="form" class="form-inline collapse in" id="genericSearchForm">
                <div class="form-group">
                  <label for="genericSearch">Search for:</label>
                   <input type="text" class="form-control" id="genericSearch" placeholder="Enter song name, artist name, or album name here"> 
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="searchMusic('generic')"><span class="glyphicon glyphicon-search"></span>  Search</button>
                </div>
        </form>
        <button type="button" data-toggle="collapse" data-target=".form-inline" class="btn btn-primary" id="toggleSearch" searchType="Advanced" onclick="toggleOptions()">Advanced Search<span class="glyphicon glyphicon-menu-down"></span> </button>
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
        <?php
        for($i = 0; $i < 15; $i++){
            echo "<div class=\"songContent well\"></div>\n\t\t";
        }
    ?>
    </div>
</div>

