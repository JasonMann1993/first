$(function () {

    // Img
    if($('#images').length > 0)
        var viewer = new Viewer(document.getElementById('images'),{});
    $('.images').each(function (i) {
        var tmp = $(this).get(0)
        new Viewer(tmp, {});
    })
})