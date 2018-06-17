$(document).ready(function (){
	window.setInterval(realTime, 1000);

});

function realTime(){
	var realTime = $('#realtime').val();
	var token = $("input[name=_token]").val();
	var data = { a:'a',
				_token:token
	        };  

	$.ajax({
        url: realTime,
        type:'post',
        cache: false,
        data: data,
        dataType: 'json',
        success: function (response) {
            console.log(response);
            $("#realTime").html("<span class='price-new' >"+response.day+" ngày "+ response.hour + " giờ " + response.minute + " phút " + response.second + " giây " +"</span>");
        }
    });
}