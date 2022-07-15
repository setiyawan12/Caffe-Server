var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
    cluster: '{{env("PUSHER_APP_CLUSTER")}}',
    encrypted: true
});
var channel = pusher.subscribe('notify-channel');
channel.bind('App\\Events\\Notify', function (data) {
    console.log(data);
    swal({
        title: data.message,
        text: data.tittle,
        icon: "info",

    }).then(function () {
        location.reload();
    });
});