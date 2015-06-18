function validate(pattern, element){
	element.removeClass("bad_data");
	element.next().removeClass("visible");
	if(!pattern.test(element.val())){
		element.next().addClass("visible");
		element.addClass("bad_data");
	}
}


$(function(){
	$("#auth_rbn").keyup(function() {
		validate(/^[0-9]{8}$/,$(this));
	});
	$("#auth_pass").keyup(function() {
		validate(/^.{6,20}$/,$(this));
	});
	$("#auth_send").click(function(){
		if(!$("#auth .bad_data").length) 
			$.ajax({
				url: '/api/auth.php/',
				type: "POST",
				data: {
					rbn : $("#auth_rbn").val(), 
					pass : $("#auth_pass").val()
				},
				success: function(data) {
					console.log(data);
					if(data["status"] == "ok"){
						$("#auth").remove();
						$("body").append(
										  "<h1>"+data.data["l_name"]+" "+
										  data.data["f_name"]+" "+ 
										  data.data["m_name"]+"</h1>"
						)
					}else{
						alert("NIPRAVILNA");
					}
				}
			});
		
	});
});