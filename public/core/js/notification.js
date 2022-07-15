function response(location) {
    swal({
        title: data.message,
        text: data.tittle,
        icon: "info"
    }).then(function(){
        Window.location.assign(location)
    })
    
}