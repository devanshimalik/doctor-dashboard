function populateDistrict(){
	var divisionSelect=document.getElementById("division");
	var districtSelect=document.getElementById("district");

	districtSelect.innerHTML='<option value="" disabled selected>Select District</option>';
	var selectDivision=divisionSelect.value;

	if(selectDivision === "meerut"){
		//districtSelect.innerHTML+='<option value="meerut">Meerut</option>';
		districtSelect.innerHTML+='<option value="modipuram">Modipuram</option>';
		districtSelect.innerHTML+='<option value="sadar">Sadar</option>';
	}
	if(selectDivision === "delhi"){
		//districtSelect.innerHTML+='<option value="delhi">Delhi</option>';
		districtSelect.innerHTML+='<option value="dwarka">Dwarka</option>';
		districtSelect.innerHTML+='<option value="nehru vihar">Nehru Vihar</option>';
	}
	if(selectDivision === "noida"){
		//districtSelect.innerHTML+='<option value="noida">Noida</option>';
		districtSelect.innerHTML+='<option value="Sector 18">Sector 18</option>';
		districtSelect.innerHTML+='<option value="Sector 20">Sector 20</option>';
	}
	if(selectDivision === "ghaziabad"){
		//districtSelect.innerHTML+='<option value="ghaziabad">Ghaziabad</option>';
		districtSelect.innerHTML+='<option value="kavi nagar">Kavi Nagar</option>';
		districtSelect.innerHTML+='<option value="vijay nagar">Vijay Nagar</option>';
	}
}

function populateDoctors(){
var departmentSelect=document.getElementById('department');
var doctorSelect=document.getElementById('doctor');
doctorSelect.innerHTML='<option value="" disabled selected>Select Doctor</option>';

if(departmentSelect.value=== "cardiology"){
	addDoctors([

		'Dr. Amit Chaudhary',
		'Dr. Rahul Garg',
		'Dr. Robin Yadav',
		'Dr. Shruti Mehta',
		]);
}

if (departmentSelect.value === "dermatology"){
	addDoctors([
		'Dr. Arif',
		'Dr. Saloni Sharma',
		'Dr. Anushka Singh',
		'Dr. Anish Aggarwal'
		]);
}
}

function addDoctors(doctors){
	var doctorSelect=document.getElementById('doctor');
	doctors.forEach(function(doctor){
		var option=document.createElement('option');
		option.text=doctor;
		option.value=doctor;
		doctorSelect.appendChild(option);
	});
}