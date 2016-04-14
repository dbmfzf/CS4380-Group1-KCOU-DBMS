<script>
    $(document).ready(function(){
        /*var searchWidth = $("#advancedOptions").innerWidth();
        $("#genericSearch").width(searchWidth);*/
    });



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

</style>
<div class="well">
    <div class="well well-lg" id="searchBar">
        <form role="form" class="form-inline" id="searchForm">
                <input type="text" class="form-control" id="genericSearch" placeholder="Enter song name, artist name, or album name here">
                <div class="form-group">
                    <label for="songSearch">Song: </label>
                    <input type="text" class="form-control" id="songSearch" placeholder="Song name">
                </div>
                <div class="form-group">
                    <label for="artistSearch">Artist: </label>
                    <input type="text" class="form-control" id="artistSearch" placeholder="Artist name">
                </div>
                <div class="form-group">
                    <label for="albumSearch">Album: </label>
                    <input type="text" class="form-control" id="albumSearch" placeholder="Album name">
                </div>
                <div class="form-group">
                    <label for="genreSearch">Genre: </label>
                    <input type="text" class="form-control" id="genreSearch" placeholder="Genre">
                </div>
                
                <button type="button" class="btn btn-primary" onclick="searchMusic('generic')"><span class="glyphicon glyphicon-search"></span>  Search</button>
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

