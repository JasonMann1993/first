/**
 * Created by ThinkPad User on 2017/4/7.
 */
$(function(){
    var width=$("#index_banner").width();
    $("#index_banner>ol>li").click(function(){
        var index=$(this).index();
        $("#index_banner>ol>li").removeClass("active");
        $(this).addClass("active");
        $("#index_banner>ul").animate({
            left:-index*width+'px'
        })
    })
})