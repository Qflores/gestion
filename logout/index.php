<?php

	session_start();
	session_destroy();
	session_unset();
	setcookie('token', '', time()-1000, '/');

	header("Location: ../");