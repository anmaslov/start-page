/***
 *  update link in blocks
 * @param URL
 */
function updateLinks(URL){
    var blocks=[];
    $('.list-group').each(function(){
        var blockId = $(this).attr('id');
        $('.list-group-item', this).each(function(i){
            var block={
                id: blockId,
                order: i,
                linkId: $(this).attr('id')
            }
            blocks.push(block);
        });
    });
    $.get(URL,{links: blocks},function(data){
    },"json");
}