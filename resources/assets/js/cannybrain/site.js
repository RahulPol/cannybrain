var info = function (title, content, type, closeFunction) {
    closeFunction = closeFunction || function () {};
    type = type || '';
    content = content || '';
    title = title || '';
    $.confirm({
        title: 'Encountered error(s)!',
        content: content,
        type: type,
        typeAnimated: true,
        buttons: {
            close: closeFunction
        }
    });
}