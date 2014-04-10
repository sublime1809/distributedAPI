<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<h1>Professor View</h1>

			<div class="col-sm-5">
				<h2>Create Class</h2>
				<form class="form-horizontal" roll="form">
				<div class="form-group">
					<label for="class_name" class="col-sm-4 control-label">Class Name</label>
					<div class="col-sm-8">
						<input id="class_name" name="class_name" type="text" placeholder="cs462" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="class_date" class="col-sm-4 control-label">Date</label>
					<div class="col-sm-8">
						<input id="class_date" name="class_date" type="text" placeholder="YYYY/MM/DD" class="form-control">
					</div>
				</div>
				<div class="col-sm-8 col-sm-offset-4">
					<a href="javascript:void(0)" id="start_class" class="btn btn-primary">Start Class</a>
				</div>
				<h3>Class ID: <span id="class_id">not setup</span></h3>
				</form>
			</div>
			<div class="col-sm-7">
				<h2>Student Roll</h2>
				<button id="update_roll" class="btn btn-primary disabled">Check For Students</button>
				<div>
					<table id="students" class="table table-striped">
						
					</table>
				</div>
			</div>
			<div class="col-sm-5">
				<h2>Email Roll</h2>
				<div class="form-group">
					<label for="email" class="col-sm-4 control-label">Email</label>
					<div class="col-sm-8">
						<input id="email" name="email" type="text" placeholder="windley@cs.byu.edu" class="form-control">
					</div>
				</div>
				<button id="email_roll" class="btn btn-primary disabled">Email Me the Roll</button>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript">

		$("#start_class").click(function() {
			//AJAX POST to create new class and display ID
			var name = $("#class_name").val();
			var date = $("#class_date").val();

			if(name == "") {
				alert("Please enter a name for the class.");
				return;
			}
			if(date == "" || ! /^\d{4}\/\d{2}\/\d{2}$/.test(date)) {
				alert("Please enter a valid date of the form YYYY/MM/DD.");
				return;
			}

			$.post("classPeriod",
			{
				"data":'{"name": "' + name + '","date": "' + date + '"}'
			},
			function(data) {
				data = JSON.parse(data);
				$("#class_id").html(data.id);

				$("#update_roll").removeClass("disabled");
				$("#email_roll").removeClass("disabled");

				$("#start_class").addClass("disabled");
			});
		});

		$("#update_roll").click(function() {
			//AJAX GET to download all students and display them. 
			var class_id = $("#class_id").html();
			console.log("update Roll");
			$.ajax({
			  type: "GET",
			  url: "signin/class_id/" + class_id,
			  success: function(data, status) {
			  	data = JSON.parse(data);

			  	var html = "";
			  	for (var i = 0; i < data.length; i++) {
			  		var student = data[i];
			  		html += '<tr><td>' + student.name + '</td><td>' + student.student_id + '</td></tr>';
			  	};
			  	$("#students").html(html);
			  }
			});
		});

		$("#email_roll").click(function() {
			//AJAX GET to download all students and display them. 
			var class_id = $("#class_id").html();
			var email = $("#email").val();

			if(email == '') {
				alert("Please input your email.");
				return;
			}

			$.post("email.php",
			{
				"class_id":class_id,
				"email": email
			},
			function(data) {
				console.log(data);
			});
		});
	</script>
</html>
