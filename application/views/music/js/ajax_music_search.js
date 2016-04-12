$(document).ready(function(){
    var searchWidth = $("#advancedOptions").innerWidth();
    $("#genericSearch").width(searchWidth);
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