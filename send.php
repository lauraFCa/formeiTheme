<html lang="br">

<head>
<title>Centro Academico do Curso de Engenharia Mecatrônica</title>
        
	    <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/fontAwesome.css">
        <link rel="stylesheet" href="css/light-box.css">
        <link rel="stylesheet" href="css/templatemo-style.css">

        <link href="https://fonts.googleapis.com/css?family=Kanit:100,200,300,400,500,600,700,800,900" rel="stylesheet">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

</head>

<body>
<?php

	$name = $_POST[name];
	$email = $_POST[email];
	$assunto = $_POST[assunto];
	$message = $_POST[message];
	 
	mail("cacemifsemg@gmail.com",
	"$assunto","
	Nome: $name
	Email: $email
	Assunto: $assunto
	Mensagem: $message","FROM:$name<$email>");

    echo "
    	<script>window.location='index.html'; 
    		alert('$name, sua mensagem foi enviada com sucesso! Retornaremos o mais rápido possível!');
    	</script>";

?>
        
 </body>
</html>