function callService(route, parameters){
    jQuery.ajax({
        'url' : 'http://localhost:52567/SGRT/public/' + route,
        'async' : false,
        'data' : parameters,
        'dataType' : 'json',
        'success' : function(data) {
            serviceData = data;
        }
    });
}