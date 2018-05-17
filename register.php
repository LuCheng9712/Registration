<?php
	include_once 'header.php';
?>
	<section class="main-container">
		<div class="main-wrapper">
			<h2>Register</h2>
			<form class="register-form" action="includes/register.inc.php" method="POST">
				<input type="text" name="firstName" placeholder="First Name">
				<input type="text" name="lastName" placeholder="Last Name">
				<input type="text" name="userId" placeholder="User ID">
				<input type="text" name="email" placeholder="Email">
				<input type="password" name="password" placeholder="Password">
				<button type="submit" name="submit">Register</button>
			</form>
		</div>
	</section>

<?php
	include_once 'footer.php';
?>