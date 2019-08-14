function showDetailsOrder1111(obj) {
    winCompare = new Window(
        {
            className: 'magento',
            title: 'Show Details',
            url: obj.href,
            width: 720,
            height: 500,
            minimizable: false,
            maximizable: false,
            showEffectOptions: {
                duration: 0.4
            },
            hideEffectOptions: {
                duration: 0.4
            }
        });
    winCompare.setZIndex(100);
    winCompare.showCenter(true);
}
function showDetails(obj) {
    new Ajax.Request(obj.href, {
        method: 'get',
        requestHeaders: {Accept: 'text/html'},
        onSuccess: function (datos) {
            $('show-result').update(datos.responseText)
        }
    });
}
function showUrlDetails(url) {
    new Ajax.Request(url, {
        method: 'get',
        requestHeaders: {Accept: 'text/html'},
        onSuccess: function (datos) {
            $('show-result').update(datos.responseText)
        }
    });
}


function changeStatusCustomer(url) {
    new Ajax.Request(url, {
        method: 'get',
        //requestHeaders: {Accept: 'text/html'},
        onSuccess: function (datos) {
            customerGridJsObject.doFilter()
        }
    });
}