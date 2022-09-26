@extends('admin.index')
@section('content')


@endsection
<div id="reader" width="6px"></div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        console.log(`Code matched = ${decodedText}`, decodedResult);
        alert(decodedText)
        // $('#result').val(decodedText)
        // window.location.href = decodedText
        // const id = decodedText;
        // console.log(id);
        // html5QrcodeScanner.clear().then(_ => {
        //             var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //             $.ajax({
        //                 url: "/generator/"+id,
        //                 type: 'GET',            
        //                 data: {
        //                     _methode : "GET",
        //                     _token: CSRF_TOKEN, 
        //                     qr_code : id
        //                 },            
        //                 success: function (response) { 
        //                     console.log(response);
        //                     // if(response.status == 200){
        //                     //     alert('berhasil');
        //                     // }else{
        //                     //     alert('gagal');
        //                     // }
        //                     // alert(response.id)
        //                 }
        //             });   
        //         }).catch(error => {
        //             alert('something wrong');
        //         });
    }

    function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        // console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        },
        /* verbose= */
        false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);

</script>