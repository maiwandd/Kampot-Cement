<?php
function InitDB($host,$uname,$pwd,$database,$tablename)
{
    $this->db_host  = $host;
    $this->username = $uname;
    $this->pwd  = $pwd;
    $this->database  = $database;
    $this->tablename = $tablename;

}
function Login()
{
    if(empty($_POST['Email']))
    {
        $this->HandleError("Emailadres is leeg!");
        return false;
    }

    if(empty($_POST['Wachtwoord']))
    {
        $this->HandleError("Wachtwoord is leeg!");
        return false;
    }

    $username = ($_POST['Email']);
    $Wachtwoord = ($_POST['Wachtwoord']);

    if(!isset($_SESSION)){ session_start(); }
    if(!$this->CheckLoginInDB($username,$Wachtwoord))
    {
        return false;
    }

    return true;
}

function CheckLogin()
{
     if(!isset($_SESSION)){ session_start(); }

     $sessionvar = $this->GetLoginSessionVar();

     if(empty($_SESSION[$sessionvar]))
     {
        return false;
     }
     return true;
}

function CheckLoginInDB($username,$password)
{

    $username = ($_POST['Email']);
    $Wachtwoord = ($_POST['Wachtwoord']);
    $qry = "Select name, email from $this->tablename where username='$username' and password='$pwdmd5' and confirmcode='y'";

    $result = mysql_query($qry,$this->connection);

    if(!$result || mysql_num_rows($result) <= 0)
    {
        $this->HandleError("Error logging in. The username or password does not match");
        return false;
    }

    $row = mysql_fetch_assoc($result);


    $_SESSION['name_of_user']  = $row['name'];
    $_SESSION['email_of_user'] = $row['email'];

    return true;
}
function DBLogin()
{

    $this->connection = mysql_connect($this->db_host,$this->username,$this->pwd);

    if(!$this->connection)
    {
        $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
        return false;
    }
    if(!mysql_select_db($this->database, $this->connection))
    {
        $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
        return false;
    }
    if(!mysql_query("SET NAMES 'UTF8'",$this->connection))
    {
        $this->HandleDBError('Error setting utf8 encoding');
        return false;
    }
    return true;
}




 ?>
