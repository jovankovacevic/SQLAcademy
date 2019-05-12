<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/main.css?version=<?php echo date('YmdHis');?>">
</head>
<body>
<?php
require_once('configuration.php');
$AttemptNum;
$totalNumOfQuestions = getTotalNumOfQuestions();
$userAllowed = authUser($_POST['uname'], $_POST['psw']);
$userPriv = getUserPriv($_POST['uname']);
$message = null;

if($userAllowed){
    if($userPriv == "regular"){
        if(isset($_POST['uname']) && isset($_POST['psw']) && isset($_POST['remember']) && !isset($_POST['QuestionId'])) {
            $uname = $_POST['uname'];
            $psw = $_POST['psw'];
            $remember = $_POST['remember'];
            $AttemptNum=1;
            $QuestionId=1;
            getDataFromDB($QuestionId);

        }

        if(isset($_POST['UserAnswer']) && isset($_POST['AttemptNum']) && isset($_POST['QuestionId']) 
            && isset($_POST['uname']) && isset($_POST['psw']) && isset($_POST['remember'])) {
            $uname = $_POST['uname'];
            $psw = $_POST['psw'];
            $remember = $_POST['remember'];
            $UserAnswer = $_POST['UserAnswer'];
            $AttemptNum = $_POST['AttemptNum'];
            $QuestionId = $_POST['QuestionId'];
            $maxAttempts = $_POST['maxAttempts'];
            if(checkUserAnswer($uname, $QuestionId, $UserAnswer, $AttemptNum)){
                if($QuestionId == $totalNumOfQuestions ){
                    $finalScore = getFinalScore($uname);
                    echo '<span style="color:blue;">Finished and submitted!</span><br/>';
                    echo '<span style="color:blue;">Your final score is: '.$finalScore.'</span>';
                    exit();
                }
                $QuestionId = $QuestionId + 1;
                $AttemptNum = 1;
                $message = '<span style="color:green;">Correct answer! Take the next question.</span>';
            }
            else {
                $AttemptNum = $AttemptNum + 1;
                $message = '<span style="color:red;">Wrong answer!</span>';
                if($AttemptNum > $maxAttempts) {
                    echo '<script language="javascript">';
                    echo 'alert("Too many attempts! Take the next question.")';
                    echo '</script>';
                    echo "Too many attempts! Take the next question.";
                    $QuestionId = $QuestionId + 1;
                    $AttemptNum = 1;
                }
            }  

            getDataFromDB($QuestionId, $message);
            
        }
    }
    elseif($userPriv == "admin"){
        header("Location:../php/admin.php");
        exit;
    }
}
else{
    echo "Access Denied!";
}

function getFinalScore($uname){
    global $serverName, $connectionOptions;
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if( $conn === false ) {
        die( print_r( sqlsrv_errors(), true));
    }    
    $stmt = "{ CALL SQLAcademy.getFinalScore (?,?)}";
    $OutParam1=-1;
    $params = array( 
        array($uname, SQLSRV_PARAM_IN),
        array(&$OutParam1, SQLSRV_PARAM_OUT)
      );
    $result = sqlsrv_query( $conn, $stmt, $params);
    sqlsrv_close( $conn);
    return $OutParam1;
}

function authUser($uname, $psw){
    global $serverName, $connectionOptions;
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if( $conn === false ) {
        die( print_r( sqlsrv_errors(), true));
    }    
    $stmt = "{ CALL SQLAcademy.authUser (?,?,?)}";
    $OutParam1=999;
    $params = array( 
        array($uname, SQLSRV_PARAM_IN),
        array($psw, SQLSRV_PARAM_IN),
        array(&$OutParam1, SQLSRV_PARAM_OUT)
      );
    $result = sqlsrv_query( $conn, $stmt, $params);
    sqlsrv_close( $conn);
    if($OutParam1 == 1){
        return true;
    }
    elseif($OutParam1 == 0){
        return false;
    }
}

function getUserPriv($uname){
    global $serverName, $connectionOptions;
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if( $conn === false ) {
        die( print_r( sqlsrv_errors(), true));
    }    
    $stmt = "{ CALL SQLAcademy.getUserPriv (?,?)}";
    $OutParam1=" ";
    $params = array( 
        array($uname, SQLSRV_PARAM_IN),
        array(&$OutParam1, SQLSRV_PARAM_OUT)
      );
    $result = sqlsrv_query( $conn, $stmt, $params);
    sqlsrv_close( $conn);
    return $OutParam1;
}

function checkUserAnswer($uname, $QuestionId, $UserAnswer, $AttemptNum){
    global $serverName, $connectionOptions;
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if( $conn === false ) {
        die( print_r( sqlsrv_errors(), true));
    }    
    $stmt = "{ CALL SQLAcademy.checkUserAnswer (?,?,?,?,?)}";
    $OutParam1=999;
    $params = array( 
        array($uname, SQLSRV_PARAM_IN),
        array($QuestionId, SQLSRV_PARAM_IN),
        array($UserAnswer, SQLSRV_PARAM_IN),
        array($AttemptNum, SQLSRV_PARAM_IN),
        array(&$OutParam1, SQLSRV_PARAM_OUT)
      );
    $result = sqlsrv_query( $conn, $stmt, $params);
    sqlsrv_close( $conn);
    if($OutParam1 == 1){
        return true;
    }
    elseif($OutParam1 == 0){
        return false;
    }
}

function getTotalNumOfQuestions() {
    global $serverName, $connectionOptions;
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if( $conn === false ) {
        die( print_r( sqlsrv_errors(), true));
    }    
    $stmt = "{ CALL SQLAcademy.getTotalNumOfQuestions (?)}";
    $OutParam1=999;
    $params = array( 
                     array(&$OutParam1, SQLSRV_PARAM_OUT)
                   );
    $result = sqlsrv_query( $conn, $stmt, $params);
    sqlsrv_close( $conn);
    return $OutParam1;
}

function getDataFromDB($QuestionId, $message = null) {
    global $serverName, $connectionOptions, $uname, $psw, $remember, $AttemptNum, $totalNumOfQuestions;

    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if( $conn === false ) {
        die( print_r( sqlsrv_errors(), true));
    }    
    $stmt = "{ CALL SQLAcademy.getQuestion (?,?,?,?)}"; //calling stored procedure with single input parameter and 1 output parameter    
    $OutParam1="foo";
    $maxAttempts = 3;
    $params = array( 
                     array($QuestionId, SQLSRV_PARAM_IN),
                     array($AttemptNum, SQLSRV_PARAM_IN),
                     array(&$OutParam1, SQLSRV_PARAM_OUT),
                     array(&$maxAttempts, SQLSRV_PARAM_OUT)
                   );
    $result = sqlsrv_query( $conn, $stmt, $params);
    sqlsrv_close( $conn);

    echo '<form class="modal-content" action="../php/action_page.php" method="post">
    <div class="container">
    <label>
        Total number of questions: '. $totalNumOfQuestions .'<br/>
        Question '.$QuestionId.': '.$OutParam1.'
      </label>
        <textarea id = "UserAnswerId" name = "UserAnswer" rows = "10" cols = "80" required>Your answer goes here</textarea>
      <button type="submit">Submit answer</button>
      <label>
        '.$message.'<br/>
        Attempt '.$AttemptNum.'/'.$maxAttempts.'
      </label>
      <input type="number" value="'. $AttemptNum .'" name="AttemptNum" class="hidden-input"> 
      <input type="number" value="'. $QuestionId .'" name="QuestionId" class="hidden-input"> 
      <input type="text" value="'. $uname .'" name="uname" class="hidden-input"> 
      <input type="text" value="'. $psw .'" name="psw" class="hidden-input"> 
      <input type="text" value="'. $remember .'" name="remember" class="hidden-input"> 
      <input type="text" value="'. $maxAttempts .'" name="maxAttempts" class="hidden-input"> 
    </div>
  </form>
    ';
}

?>

</body>
</html>
