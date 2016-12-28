var raiseInfo = function (title, content, type, buttons) {
    buttons = buttons || {};
    type = type || '';
    content = content || '';
    title = title || '';
    $.confirm({
        title: title,
        content: content,
        type: type,
        typeAnimated: true,
        buttons: buttons
    });
}