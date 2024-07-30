

    
<?php
$email = $_POST['email'];
$code = $_POST['code'];
$html="
    <h1>Enter Code</h1>
    <p>Sent to $email with $code</p>
    <form id='verifyForm'>
    <div class='input-group mb-3'>
                    <input type='text' id='code' class='form-control' maxlength='6' placeholder='6-digit code'>
                    <input type='hidden' id='generatecode' class='form-control' 
                    maxlength='6' placeholder='6-digit code' value='$code'>
                </div>
      <div class='error' id='codeError'></div>
      <input type='button' class='form-control btn btn-primary' id='verify' value='Submit'/>
    </form>
    ";
    echo $html;


