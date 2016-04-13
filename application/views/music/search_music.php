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
    #genericSearch{
        width: 350px;
    }
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
             <span class="form-group">
                <span class="collapse in advancedSearch form-control">
                    <input type="text" class="form-control" id="genericSearch" placeholder="Enter song name, artist name, or album name here">
                </span>
                <span class="collapse advancedSearch form-control" id="advancedOptions">
                    <input type="text" class="form-control" id="songSearch" placeholder="Song name">
                    <input type="text" class="form-control" id="artistSearch" placeholder="Artist name">
                    <input type="text" class="form-control" id="albumSearch" placeholder="Album name">
                    <input type="text" class="form-control" id="genreSearch" placeholder="Genre">
                </span>
            </span>
            <span class="btn-group form-control">
                <button data-toggle="collapse" data-target=".advancedSearch" class="form-control">Advanced Search...</button>
                <button type="button" class="btn btn-default form-control" onclick="searchMusic('generic')"><span class="glyphicon glyphicon-search"></span>  Search</button>
            </span>
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

