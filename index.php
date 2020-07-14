<?php 
    	// Connect to database
	$conn = mysqli_connect('localhost', 'Gudy', 'temitopeobi@24', 'email_capture');

	//check connection

	if(!$conn) {
		echo "connection error: " . mysqli_connect_error();
	}

    $email = "";
    $errors = array('email' => '');

    if (isset($_POST['submit'])) {
        	//check email
		if (empty($_POST['email'])) {
			$errors['email'] = "An email is required <br/>";
		} else {
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = "email must be a valid email address";
			}
        }
        
        if (array_filter($errors)) {
			//echo "there are errors in the form";
		} else {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            
            	//create sql
            $sql = "INSERT INTO test_email_capture(email) VALUES('$email')";

            if (mysqli_query($conn, $sql)) {
				//success
				header(('Location: index.php'));
			} else {
				//error
				echo 'query error: ' . mysqli_error($conn);
			}


			// echo "form is valid";
			
		}
    } //end of POST check

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Email Capture</title>
</head>
<body>
    <div class="container border border-warning">
        <div class="jumbotron bg-dark text-muted">
            <h4 class="display-4">Hello</h4>
            <form action="index.php" method="POST" >
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="sr-only" for="inputEmail4">Email</label>
                        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>" class="form-control form-control-lg" id="colFormLabelLg" placeholder="Type in your email">
                        <div class="text-danger"><?php echo $errors['email']; ?></div>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-warning btn-lg">Notify Me!</button>
                    </div>
                </div>
            </form>
        </div>
    </div>








    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>