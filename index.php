<!DOCTYPE	html>
<html lang="pl-PL">
<head>
        <meta	charset='utf-8' lang='en-EN'>
        <title>Zadanie IKOL</title>
        <meta	name='description'	content='andrzej, kobuszewski, program IKOL'>
        <meta	name='viewport'	content='width=device-width,	initial-scale=1'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="img/logo-ikol1.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/vue@next"></script>
        <link href="https://cdn.jsdelivr.net/npm/animate.css@3.5.1" rel="stylesheet" type="text/css">
        <link href="css/main.css" rel="stylesheet">
</head>
<body>  
<!-- sprawdzam w php czy formularz przysłał zmienne popdczas ładowania strony -->
<?php 
        $PlaceA = $_POST['PlaceA'];
        $PlaceB = $_POST['PlaceB'];
?> 
<main class = "container-fluid">
        <header>
                <div class="naglowek container-fluid">
                        <div class='logo'>
                                <p><img title= "logo IKOL" alt = "logo IKOL" src="img/logo-ikol1.png"></p>
                                <span class="subtitle">MONITORING GPS</span>
                        </div>
                        <p class ="tytul h1">Proste zadanie programistyczne</p>
                </div>
        </header>
        <div class = 'glowny' style='background-image: url("img/main-top.gif");'>
               <div class="introduction"> 
                <section>
                        <div class="Welcome container-fluid text-primary h2">  
                                <?php echo ("Witaj " ); echo ($_SERVER['REMOTE_ADDR']);?>
                                <p > 
                                Miło Cię widzieć.
                                </p>
                                <p class="text-success h4"> Nie krępuj się obliczać odległości pomiędzy współrzędnymi geograficznymi. 
                                        Mam nadzieję, że wywołam u Ciebie pozytywna perspektywę.
                                </p>                        
                        </div>
                </section>
                </div>
                <div class="aplication">
                <section>
                
                        <div id="app" class="container-fluid text-secondary">
                        <div class="message text-primary h3">
<!-- korzystam z danych aplikacji Vue.js -->
                        {{message}}
                        </div>
<!-- Vue.js korzystam ze zdarzenia v-on:submit oraz metody onSubmit do weryfikacji formularza -->
                        <form action="index.php" method="post" v-on:submit="onSubmit"><br>
                                <label class="text-body" for ="TestForm">Aplikacja obliczająca odległość między dwoma punktami 
                                        geograficznymi</label><br>
                                <label for="PlaceA">Podaj szerokość i długość pierwszego punktu geograficznego</label><br>
                                <input type="text" id="PlaceA" placeholder ="+00.000000,-000.000000" name="PlaceA"  
                                v-model.lazy="PlaceA" pattern="[+,-]{1}[0-8]{1}[0-9]{1}.[0-9]{6},[+,-]{1}[0-1]{1}[0-9]{1}[0-9]{1}.[0-9]{6}" 
                                v-bind:title="format" ><br>
                                <label for="PlaceB">Podaj szerokość i długość drugiego punktu geograficznego</label><br>
                                <input type="text" id="PlaceB" placeholder="+00.000000,-000.000000" name="PlaceB"
                                v-model.lazy="PlaceB" pattern="[+,-]{1}[0-8]{1}[0-9]{1}.[0-9]{6},[+,-]{1}[0-1]{1}[0-9]{1}[0-9]{1}.[0-9]{6}" 
                                v-bind:title="format"><br><br>
                                <input class="btn btn-success" type="submit" value="Oblicz odległość" >
                        </form>    
<!-- Vue.js korzystam z dyrektywy warunkowej v-if aby alternatywnie wyświetlać zawartość divów-->
                        <div v-if="PlaceA==0 && PlaceB==0" class="Distance text-body">                        
                                <p >Odległość pomiędzy zadanymi przez Ciebie współrzednymi geograficznymi 
                                <span class="text-primary"><?php if ($_POST['PlaceA']!==null){echo $PlaceA. '<span class="text-body"> oraz </span>'. $PlaceB;}else{echo "";};?></span>  
                                wynosi:<br><br>

                                <span class="text-success"> <?php                              
                                        list($lat1 ,$lon1) = explode(",", $PlaceA);    
                                        list($lat2 ,$lon2) = explode(",", $PlaceB); 
                                        include 'distance.php';         
                                        echo  (distance($lat1, $lon1, $lat2, $lon2));
                                        ?> </span>
                                metrów co daje w zaokrąglęniu <br>
                                <span class="text-success">  <?php 
                                        echo  (round(distance($lat1, $lon1, $lat2, $lon2)/1000,0))
                                        ?></span>
                                kilometrów.
                                </p>                        
                        </div>
<!-- Vue.js korzystam z dyrektywy warunkowej v-if aby alternatywnie wyświetlać zawartość divów-->
                        <div v-else class="Distance text-body">
                                <p>
                                Sprawdzasz współrzędne dla: <br>
                                Punktu A: <span class="text-primary">{{PlaceA}}</span> <br> 
                                Punktu B: <span class="text-primary">{{PlaceB}}</span>

                                </p>
                        </div>              
                </section> 
                </div> 
           </div> 
        </div>                    
        <footer>
        <div class="wpisy">
               <blockquote> Wpis1: Cieszę się, że dostałem to zadanie ponieważ mogłem poznać Vue.js. Vue.js jest w moim odczuciu 
               prostszy od React'a i posiada dużo rozbudowanych zasobów do samodzielnej nauki.
               Niestety dużo czasu spędziłem na usuwaniu przyczyn błędu pojawiającego się na konsoli  <code>"Failed to resolve component: coordinatesform
                If this is a native custom element, make sure to exclude it from component resolution via compilerOptions.isCustomElement. 
                at App."</code> <br>
                To uniemożliwiło mi podział kodu na komponenty. Miały być 2 komponenty: Formularz oraz CalculatingField ze zmniennymi 'PlaceA' i 'PlaceB' 
                przekazywanymi w propsach. Miała być też metoda obliczająca odległość wprost przepisana z kodu PHP. 
                Pomimo tych trudności oddaję działającą w pełni funkcjonalną aplikację.<br><br>

                
                Wpis2: W dalszych próbach komponenty zadziałały, a także przekazywanie danych w propsach i emitownie za pomocą metod i słuchanie listenerami. 
                Niestety jednak vue.js templaty gryzą się ze składnią PHP. Tak naprawdę zostaje 1 komponent, więc nie ma sensu go dzielić i importować.
                </blockquote>
  
       </div> 
        </footer>
</main>
<script src="js/main.js">
</script>
<script>
 const mountedApp = app.mount('#app')
</script>
</body>
