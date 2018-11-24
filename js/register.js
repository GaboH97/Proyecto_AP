$(function() {
	$('#regForm').on('submit',function(e){
		e.preventDefault();

		if(validateFields()){

			var uname = document.getElementById('uname').value;
			var upass = document.getElementById('upass').value;
			var ubirthdate = document.getElementById('ubirthdate').value;
			var uemail = document.getElementById('uemail').value;
			var ugen = $("input[name='ugen']:checked").val();
		
			var sec_ids_Array = [];

			$(".sec_ids:checked").each(function() {
				sec_ids_Array.push($(this).val());
			});

			var chkd_sec_id;
			chkd_sec_id = sec_ids_Array.join(',') ;


			var method = $(this).attr('method');
			var action = $(this).attr('action');
			$.ajax({
				type : method,
				url : action,
				data : {
					uname:uname,
					upass:upass,
					ubirthdate:ubirthdate,
					uemail:uemail,
					ugen:ugen,
					sec_ids:chkd_sec_id
				},
				success : function (data){
					if(data =="OK"){
						window.location.href ="../index.html";
					}else{
						$('body').html(data);
					}
				}
			});
		}
	});

	function validateFields() {

		var uname = document.getElementById('uname').value;
		var upass = document.getElementById('upass').value;
		var ubirthdate = document.getElementById('ubirthdate').value;
		var uemail = document.getElementById('uemail').value;

		const emailRegexp = new RegExp("^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@(([0-9a-zA-Z])+([-\w]*[0-9a-zA-Z])*\.)+[a-zA-Z]{2,9})$");
		const userRegexp = new RegExp("^[a-zA-Z]+[a-zA-Z0-9]*$");

	//console.log("hay "+sec_ids.length+" elems");

	if(uemail==""){
		alert("Campo email no debe estar vacío");
		return false;
	}else if(upass==""){
		alert("Campo contraseña no debe estar vacío");
		return false;
	}else if(ubirthdate==""){
		alert("Campo fecha de nacimiento no debe estar vacío");
		return false;
	}else if(uemail==""){
		alert("Campo email no debe estar vacío");
		return false;
	}else if (!emailRegexp.test(uemail)) {
		alert("Email no tiene el formato adecuado");
		return false;
	}else if (!userRegexp.test(uname)) {
		alert("Nombre de usuario no debe contener caracteres especiales");
		return false;
	}else{
		return true;
	}
}

});