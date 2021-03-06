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
    $.post(URL, {links: blocks},function(data){
        $.jGrowl(data.msg, { group: 'alert-' + data.type });
    },"json");
}

/***
 * Update info about block
 * @param URL
 */

function updateWidgetData(URL){
    var items=[];
    $('.column').each(function(){
        var columnId=$(this).attr('id');
        $('.panel', this).each(function(i){
            var collapsed=0;
            //if($(this).find('.list-group').css('display')=="none")
            //    collapsed=1;
            var item={
                id: $(this).attr('id'),
                collapsed: collapsed,
                order : i,
                column: columnId
            };
            items.push(item);
        });
    });
    $.post(URL,{items: items},function(data){
        $.jGrowl(data.msg, { group: 'alert-' + data.type });
    },"json");
}