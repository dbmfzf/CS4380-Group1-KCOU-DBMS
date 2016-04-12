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
        <div class="well well-lg">
            <form role="form" class="form-inline">
                <input type="text" class="form-control" id="genericSearch" placeholder="Enter song name, artist name, or album name here">
                <input type="button" class="btn btn-default" onclick="searchMusic('generic')">
            </form>
            <div id="resultArea">
                
            </div>
        </div>
    </body>
</html>
