<?php



session_start();
if (!isset($_SESSION["USERID"])) {
  header("Location: index.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width-device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Vista/CSS/home.css">
  <link rel="icon" href="https://static.thenounproject.com/png/963312-200.png">
  <title>Guia 2 - HOME</title>
</head>

<body>
  <input type="radio" name="toggle" id="toggleOpen" value="toggleOpen">
  <input type="radio" name="toggle" id="toggleClose" value="toggleClose">
  <figure id="welcomeMessage">
    <figcaption>
      <h1>
        <label for="toggleOpen" title="Click to Open"></label>
        <label for="toggleClose" title="Click to Close">✖</label>
        <b>
          W
          <a href="javascript:void(0);" title="Perfil de Estudiante">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
              <defs>
                <lineargradient id="svgGradient" x1="0" y1="0" x2="20" y2="0" gradientUnits="userSpaceOnUse">
                  <stop offset="0" stop-color="#00ffc3" />
                  <stop offset="0.09090909090909091" stop-color="#00fad9" />
                  <stop offset="0.18181818181818182" stop-color="#00f4f0" />
                  <stop offset="0.2727272727272727" stop-color="#00eeff" />
                  <stop offset="0.36363636363636365" stop-color="#00e6ff" />
                  <stop offset="0.4545454545454546" stop-color="#00dcff" />
                  <stop offset="0.5454545454545454" stop-color="#00d2ff" />
                  <stop offset="0.6363636363636364" stop-color="#00c5ff" />
                  <stop offset="0.7272727272727273" stop-color="#00b8ff" />
                  <stop offset="0.8181818181818182" stop-color="#6da8ff" />
                  <stop offset="0.9090909090909092" stop-color="#9f97ff" />
                  <stop offset="1" stop-color="#c285ff" />
                </lineargradient>
              </defs>
             </svg>
          </a>
        </b>

        <b>
          e
          <a href="Student_form.php" title="Estudiante">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="800px" height="800px" viewBox="0 0 256 256" id="Flat">
              <path d="M225.26514,60.20508l-96-32a4.00487,4.00487,0,0,0-2.53028,0l-96,32c-.05713.019-.10815.04809-.16406.06958-.08545.033-.16821.06811-.251.10644a4.04126,4.04126,0,0,0-.415.22535c-.06714.04174-.13575.08007-.20044.12548a3.99,3.99,0,0,0-.47632.39307c-.02027.01953-.0437.0354-.06348.05542a3.97787,3.97787,0,0,0-.44556.53979c-.04077.0586-.07373.12183-.11132.18262a3.99741,3.99741,0,0,0-.23487.43262c-.03613.07837-.06811.15771-.09912.23852a3.96217,3.96217,0,0,0-.144.46412c-.01929.07714-.04126.15234-.05591.2312A3.98077,3.98077,0,0,0,28,64v80a4,4,0,0,0,8,0V69.55005l43.87524,14.625A59.981,59.981,0,0,0,104.272,175.09814a91.80574,91.80574,0,0,0-53.39062,38.71631,3.99985,3.99985,0,1,0,6.70117,4.36914,84.02266,84.02266,0,0,1,140.83447,0,3.99985,3.99985,0,1,0,6.70117-4.36914A91.80619,91.80619,0,0,0,151.728,175.09814a59.981,59.981,0,0,0,24.39673-90.92309l49.14038-16.38013a4.00037,4.00037,0,0,0,0-7.58984ZM180,120A52,52,0,1,1,87.92993,86.85986l38.80493,12.93506a4.00487,4.00487,0,0,0,2.53028,0l38.80493-12.93506A51.85133,51.85133,0,0,1,180,120ZM168.00659,78.44775l-.01294.0044L128,91.7832,44.64893,64,128,36.2168,211.35107,64Z" />
            </svg>
          </a>
        </b>
        <b>
          l
          </a>
        </b>
        <b>
          c
          <a href="javascript:void(0);" title="Reportes">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" version="1.1" id="Layer_1" viewBox="0 0 490 490" xml:space="preserve">
              <g>
                <g>
                  <g>
                    <path d="M480,325h-5V45c0-5.523-4.477-10-10-10H300V10c0-5.523-4.477-10-10-10h-90c-5.523,0-10,4.477-10,10v25H25     c-5.523,0-10,4.477-10,10v280h-5c-5.523,0-10,4.477-10,10v35c0,5.523,4.477,10,10,10h152.338l-50.913,84.855l17.149,10.29     L185.662,380H235v110h20V380h49.338l57.087,95.145l17.149-10.29L327.662,380H480c5.523,0,10-4.477,10-10v-35     C490,329.477,485.523,325,480,325z M210,20h70v15h-70V20z M35,55h420v270H35V55z M470,360H20v-15h450V360z" />
                    <path d="M170,90c-55.14,0-100,44.86-100,100s44.86,100,100,100s100-44.86,100-100S225.14,90,170,90z M170,270     c-44.112,0-80-35.888-80-80c0-40.724,30.593-74.413,70-79.353V190c0,5.523,4.477,10,10,10h79.353     C244.413,239.407,210.724,270,170,270z M180,180v-69.353c36.128,4.529,64.824,33.225,69.353,69.353H180z" />
                    <rect x="345" y="130" width="70" height="20" />
                    <rect x="345" y="160" width="70" height="20" />
                    <rect x="345" y="190" width="70" height="20" />
                    <rect x="345" y="100" width="45" height="20" />
                    <path d="M324.999,119.999v-20h-45c-2.652,0-5.196,1.054-7.071,2.929l-15,15l14.143,14.143l12.07-12.072H324.999z" />
                    <rect x="310" y="235" width="115" height="20" />
                    <rect x="280" y="270" width="145" height="20" />
                  </g>
                </g>
              </g>
            </svg>
          </a>
        </b>
        <b>
          o
        </b>
        <b>
          m
          <a href="Modelo/desconectar.php" title="Cerrar sesión">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
              <path d="M14.15 1.62c-.386-.389-1.014-.389-1.402 0L8 6.598 3.252 1.85c-.389-.389-1.017-.389-1.406 0-.389.389-.389 1.016 0 1.404L6.598 8l-4.748 4.748c-.389.389-.389 1.016 0 1.404.386.389 1.013.389 1.402 0L8 9.402l4.748 4.748c.389.389 1.016.389 1.402 0 .389-.388.389-1.015 0-1.404L9.402 8l4.748-4.748c.389-.388.389-1.015 0-1.404z" />
            </svg>
          </a>
        </b>
        <b>
          e
        </b>

      </h1>
    </figcaption>
  </figure>
</body>

</html>