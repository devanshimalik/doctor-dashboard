function loadSignUp(){
	$('#container').addClass('hidden-content');
	$.ajax({
		url:'signup.php',
		type: 'GET',
		success: function(response){
			$('#signUpModal .modal-body').html(response);
			$('#signupModal').modal('show');
		},
		error: function(xhr, status, error){
			console.error('error loading signup.php', error);
		}
	});
}

$('#loginform').submit(function(e){
	e.preventDefault();
	var formData=$(this).serialize();
	$ajax({
		url: 'login.php',
		type: 'POST',
		data: formData,
		success: function(response){
			if(response.success){
				switch(response.role){
				case 'admin':
					window.location.href='admin/index.php';
					break;
				default:
					console.error('Invalid role:', response.role);
				}
			}
			else{
				alert('Invalid Login Information');
			}
		}, 
		error:function (xhr, status, error){
			console.error('Error', error);
		}
	});
});

function validateLoginForm(){
	var username=document.getElementById("username").value;
	var password=document.getElementById("password").value;

	if(username.trim()===""){
		alert("Please Enter Your Correct Username");
		return;
	}
	if(password.trim()===""){
		alert("Please Enter Your Correct Password");
		return;
	}
	document.getElementById("loginform").submit();
}