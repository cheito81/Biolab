<?php
	require_once "UserController.php";
	require_once "ApplicationController.php";
	require_once "FileController.php";
	require_once "ReviewController.php";

	function is_session_started()	{
		if ( php_sapi_name() !== 'cli' ) {
			if ( version_compare(phpversion(), '5.4.0', '>=') ) {
				return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
			} else {
				return session_id() === '' ? FALSE : TRUE;
			}
		}
		return FALSE;
	}

	if ( is_session_started() === FALSE) session_start();

	$outPutData = array();

	if ( isset($_REQUEST['controllerType']) )  {
		$action = (int) $_REQUEST['controllerType'];
		switch ( $action )	{
			case 0:
				$userController = new UserController( $_REQUEST['action'], $_REQUEST['jsonData'] );
				$outPutData = $userController->doAction();
				break;
			case 1:
					if (isset($_SESSION['connectedUser']))	{
						$applicationController = new ApplicationController( $_REQUEST['action'], $_REQUEST['jsonData'] );
						$outPutData = $applicationController->doAction();
					}
					break;
			case 2:
					$fileController = new FileController( $_REQUEST['action'], $_REQUEST['jsonData'] );
					$outPutData = $fileController->doAction();
					break;
			case 3:
					if (isset($_SESSION['connectedUser']))	{
							$reviewController = new ReviewController( $_REQUEST['action'], $_REQUEST['jsonData'] );
							$outPutData = $reviewController->doAction();
					}
					break;
<<<<<<< HEAD
=======
			case 4:
					$moleculeController = new MoleculeController( $_REQUEST['action'], $_REQUEST['jsonData'] );
					$outPutData = $moleculeController->doAction();
					break;
>>>>>>> fe66bdb266cf75ed6542ae77ca69e76808e3626f
			default:
				$errors = array();
				$outPutData[0]=false;
				$errors[]="Sorry, there has been an error. Try later";
				$outPutData[]=$errors;
				error_log("MainControllerClass: action not correct, value: ".$_REQUEST['controllerType']);
				break;
		}
	}
	else {
		$errors = array();
		$outPutData[0]=false;
		$errors[]="Sorry, there has been an error. Try later";
		error_log("MainControllerClass: action does not exist");
		$outPutData[]=$errors;
	}

	echo json_encode($outPutData);
?>
