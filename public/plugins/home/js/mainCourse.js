(function ($) {
    //获取dom
    //
    //定义参数
    var navList = [
        {name:'学馆',url:'/Public/plugins/home/img/xueguan.png',change:'/Public/plugins/home/img/xueguan1.png',color:'#fff',newColor:'#ffc72c'},
        {name:'测试',url:'/Public/plugins/home/img/ceshi.png',change:'/Public/plugins/home/img/ceshi.png',color:'#fff',newColor:'#ffc72c'},
        {name:'商城',url:'/Public/plugins/home/img/shangcheng.png',change:'/Public/plugins/home/img/shangcheng1.png',color:'#fff',newColor:'#ffc72c'},
        {name:'我的',url:'/Public/plugins/home/img/wode.png',change:'/Public/plugins/home/img/wode1.png',color:'#fff',newColor:'#ffc72c'}

    ]

    var modelViews = function (item) {
        var html = '';
        $.each(item,function (i,v) {
            html += '<li><a href=""><img src="'+v.url+'" alt=""/><p>'+v.name+'</p></a></li>';
            
        })

        return html;
    };

    $('.mainCourse_footer> ul').html(modelViews(navList));

    $('.mainCourse_footer> ul > li').click(function (e) {
        e.stopPropagation();
        $.each(navList,function (i,v) {
            $('.mainCourse_footer> ul > li').eq(i).find('img').attr('src', v.url);
            $('.mainCourse_footer> ul > li').eq(i).find('p').css('color', v.color);
        })
        
        $(this).find('img').attr('src', navList[$(this).index()].change);
        $(this).find('p').css('color', navList[$(this).index()].newColor);
 

    });
})(jQuery)