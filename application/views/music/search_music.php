<!DOCTYPE html>
<html>
    <head>
        <title>Search Music</title>
        <?php echo $library_src;?>
        <?php echo $script_head;?>
        <script src="js/ajax_music_search.js"></script>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="well">
            <div class="well well-lg" id="searchBar">
                <form role="form" class="form-inline" id="searchForm">
                     <span class="form-group">
                        <div class="collapse in advancedSearch">
                            <input type="text" class="form-control" id="genericSearch" placeholder="Enter song name, artist name, or album name here">
                        </div>
                        <div class="collapse advancedSearch" id="advancedOptions">
                            <input type="text" class="form-control" id="songSearch" placeholder="Song name">
                            <input type="text" class="form-control" id="artistSearch" placeholder="Artist name">
                            <input type="text" class="form-control" id="albumSearch" placeholder="Album name">
                            <input type="text" class="form-control" id="genreSearch" placeholder="Genre">
                        </div>
                    </span>
                    <span class="form-group btn-group">
                        <button data-toggle="collapse" data-target=".advancedSearch" class="form-control">Advanced Search...</button>
                        <button type="button" class="btn btn-default" onclick="searchMusic('generic')"><span class="glyphicon glyphicon-search"></span>  Search</button>
                    </span>
                </form>
            </div>
            <div id="resultArea">
                <?php
                for($i = 0; $i < 10; $i++){
                    echo "<div class=\"songContent well\"></div>";
                }
            ?>
            </div>
        </div>
    </body>
</html>
