<script>
    $(function() {
        console.dir("DOM loaded");
    }

    function searchMusic(searchType){
        switch(searchType){
            case 'generic':
                $.getJSON("../../../controllers/music/search_music/genericSearchHandler",
                    $("#genericSearch").val(), function(){
                        //parse the json
                    });
                break;
            case 'advanced':
                break;
            default:
                break;
        }
        
    var toggleSearch = false;
    function toggleOptions(){
        var basicSearch = "Basic Search <span class=\"glyphicon glyphicon-triangle-top\"></span>";
        var advancedSearch = "Advanced Search <span class=\"glyphicon glyphicon-triangle-bottom\"></span>";
        if(!toggleSearch){
            $("#toggleSearch").val(basicSearch);
        }else{
            $("#toggleSearch").val(advancedSearch);
        }
        toggleSearch != toggleSearch;
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
        <form role="form" class="form-horizontal collapse in" id="genericSearchForm">
                <div class="form-group">
                  <label for="genericSearch" class="control-label">Search for:</label>
                   <input type="text" class="form-control" id="genericSearch" placeholder="Enter song name, artist name, or album name here"> 
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="searchMusic('generic')"><span class="glyphicon glyphicon-search"></span>  Search</button>
                </div>
        </form>
        <button type="button" data-toggle="collapse" data-target=".form-inline" class="btn btn-primary" id="toggleSearch" onclick="toggleOptions()">Advanced Search<span class="glyphicon glyphicon-triangle-bottom"></span> </button>
        <form role="form" class="form-horizontal collapse" id="advancedSearchForm">
                <div class="form-group">
                    <label for="songSearch" class="control-label">Song:</label>
                    <input type="text" class="form-control" id="songSearch" placeholder="Song name">
                </div>
                <div class="form-group">
                    <label for="artistSearch" class="control-label">Artist:</label>
                    <input type="text" class="form-control" id="artistSearch" placeholder="Artist name">
                </div>
                <div class="form-group">
                    <label for="albumSearch" class="control-label">Album:</label>
                    <input type="text" class="form-control" id="albumSearch" placeholder="Album name">
                </div>
                <div class="form-group">
                    <label for="genreSearch" class="control-label">Genre:</label>
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

