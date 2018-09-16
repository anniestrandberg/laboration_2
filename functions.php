<?php 
// här skapar jag en class-komponent med mina felmedelanden. 
class ErrorMessages {
    public static $wrong_information = '<h2 class="error_code">Lösenordet eller användarnamnet stämmer inte</h2>';
    public static $user_already_exists = '<h2 class="error_code">Användaren finns redan registrerad</h2>';
}
// Här gör jag min funktion för att kunna registrera ny användare.
function register_user(){
    $user_exists = false;
// här skapar jag nya variblar för att hämta det den nya användaren skriver i input-fälten.
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //här anvvänder jag mig utav scandir som är en färdig funktion som kollar igenom users som sluetr på .csv
    $all_users = scandir('../users');
    $user_file_name = $username . '.csv';

//och OM den hittar en fil i mappen users och det slutar på .csv sätt $user_exists på true.
    if(in_array($user_file_name, $all_users)){
        $user_exists = true;
    }
//annars hämta klass-object med felmedelande.
    if($user_exists == true){
        print ErrorMessages::$user_already_exists;
    } else {
        //annars skapa ny array Med rybriker och sedan hämta informations-datan. 
        //password_hash() = för att salta lösenordet.

        $newly_registred = array(
            ['användarnamn', 'förnamn', 'email', 'lösenord'], 
            [$username, $name, $email, password_hash($password, PASSWORD_DEFAULT)]
        );

        //här placerar jag filerna, och döper dem till användarnamnet som angetts (.csv).
        $file_name = '../users/' . $username . '.csv';
        $csv_file = fopen($file_name, 'w');
        foreach($newly_registred as $reg_info){
            fputcsv($csv_file, $reg_info);
        }
        fclose($csv_file);

//eEfter registering skick användaren till login-page.
        header("location: login.php");
        die();

    }

}

//funktionen för login. hämta det som skrivs i input-fälten. Och lägg user_check som standardvärde false.
function login_user(){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_check = false;

    //scanna igenom csv filerna i mappen users.
    $user_file_name = $username . '.csv';
    $all_users = scandir('../users');

    //om den hittar en match sätt user_check som true.
    if(in_array($user_file_name, $all_users)){
        $user_check = true;
    }

    //och om det är true hämta cvs-filen.
    if($user_check == true){
        $user_filename = "../users/$user_file_name";
    
        //hämtar den funna användaren och gör om csv filen till en array. 
            $rows = array_map('str_getcsv', file($user_filename));
            $header = array_shift($rows);
            foreach ($rows as $row) {
                $user_information = array_combine($header, $row);
            }
        //om det du skrev i inputfältet matchar med någon csv fil och lösenordet matchar, börja session.
            if($username == $user_information['användarnamn'] && password_verify($password, $user_information['lösenord'])){
                session_start();
                
//jag skickar med två värden in i sessionen.
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $user_information['email'];
            //skicka använadren till welcome-site.
                header("location: welcome.php");
                die();
            }
//annars så skrivs ett felmeddelande ut.
    } else {
        print ErrorMessages::$wrong_information;
    }
}

// Register-funtionen körs bara om en användare trycker på submit-knappen i reg.formuläret.
if(isset($_POST['register'])){
    register_user();
}
// Login-funtionen körs bara om en användare trycker på submit-knappen i login.formuläret.
if(isset($_POST['login'])){
    login_user();
}

//En klass med två funtioner is som validerar användaren.
class CheckSession {

    //En funktion som kollar om användaren är utloggad. Är användaren utloggad så skickas anv. till index.
    function check_if_logged_out(){
        session_start();
        if(!isset($_SESSION['username'])){
            header("Location: index.php");
            die();
        }
    }

    //En funktion som kollar om användaren är inloggad. Är användaren inloggad så skickas man till welcome-page.
    function check_if_logged_in(){
        session_start();
        if(isset($_SESSION['username'])){
            header("Location: welcome.php");
            die();
        }
    }
}

?>