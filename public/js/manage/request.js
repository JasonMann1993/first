$(function () {
    $('.url').click(function () {
        return url(this);
    });
    $('.delete').click(function () {
        return deleteItem(this);
    });
    $('.patch').click(function () {
        return patchItem(this);
    });
});
$.extend({
    startPost: function (url, args, method) {
        var form = $("<form method='post'></form>"),
            input;
        form.attr({"action": url});
        args_default = {
            '_token': $('#token').attr('content'),
            '_method': typeof(method) === 'undefined' ? 'POST' : method
        };
        args = $.extend(args_default, args);
        $.each(args, function (key, value) {
            input = $("<input type='hidden'>");
            input.attr({"name": key});
            input.val(value);
            form.append(input);
        });
        $(document.body).append(form);
        form.submit();
    }
});
function url(e) {
    var item = $(e);
    window.location.href = item.data('url');
    return false;
}
function deleteItem(e) {
    var item = $(e)
    swal({
        title: "确定要删除吗？",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "确认",
        cancelButtonText: "取消",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (isConfirm)
            $.startPost(item.data('url') || item.attr('href'), {}, 'DELETE');
    });
    return false;
}

function patchItem(e) {
    var item = $(e)
    $.startPost(item.data('url') || item.attr('href'), {}, 'patch');
    return false;
}
