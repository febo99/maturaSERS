<html>
<head>
  <title>Registracija</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <link href="//fonts.googleapis.com/css?family=VT323" rel="stylesheet">


</head>
<body style="background-color:#d1eef9">
<h1 class="naslov">Registracija</h1>
<form id="registracija" action="registracijaPHP.php" method="post" accept-charset='UTF-8'>
  <input type="text" class="prijavaForma" id="uprIme" name="uprIme" placeholder="Uporabniško ime"></input>
  <br>
  <input type="password" class="prijavaForma" id="geslo" name="geslo" placeholder="Geslo"></input>
  <br>
  <input type="email" class="prijavaForma" id="email" name="email" placeholder="Elektronski naslov"></input>
  <br>
  <button type="submit" name = "poslji" class="prijavniGumb">Registriraj se!</button>
  <br>
  <div class="g-recaptcha" data-sitekey="6LdcmTYUAAAAAIgySApKDFWbKdd7boIqvQxe3F1o"></div>
</form>

</body>
</html>
