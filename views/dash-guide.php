<?php
session_start();

$user_logged = isset($_SESSION['username']) ? $_SESSION['username'] === '' ? 'hidden' : '' : 'hidden';

if ($user_logged == 'hidden'){
    header('location:../');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member - CUPONTOURS.com</title>
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/dash-guide.css">
    <link rel="stylesheet" href="../css/dash-member.css">

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/dash-guide.js"></script>
    <script src="../js/dash-header.js"></script>
    <script src="../js/dash-sidebar.js"></script>

</head>
<body>
<?php include_once 'dash-header.php' ?>

<div class="main-container">
    <?php include_once 'dash-sidebar.php' ?>

    <div class="main-content" id="main-content">
        <section class="dash-content">
            <div class="working-guide">

                <div class="pitch-menu">
                    <div class="menu-item"><i class="fa fa-clock-o"></i>Pendientes</div>
                    <div class="menu-item"><i class="fa fa-envelope-o"></i>Correos</div>
                    <div class="menu-item"><i class="fa fa-commenting-o"></i>Mensajes</div>
                    <div class="menu-item"><i class="fa fa-question-circle-o"></i>Preguntas Frecuentes</div>
                </div>

                <div class="small-charts">
                    <div class="resume-counter" id="closure-tools">
                        <div class="row-one">
                            <p>Herramientas de Cierre</p>
                            <i class="fa fa-flag-checkered"></i>
                        </div>
                        <div class="row-two">
                            <p>View Details</p>
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </div>
                    <div class="resume-counter" id="selling-pitch">
                        <div class="row-one">
                            <p>Pitch de Ventas</p>
                            <i class="fa fa-crosshairs"></i>
                        </div>
                        <div class="row-two">
                            <p>View Details</p>
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </div>
                    <div class="resume-counter" id="notifications">
                        <div class="row-one">
                            <p>Notificaciones</p>
                            <i class="fa fa-bell"></i>
                        </div>
                        <div class="row-two">
                            <p>View Details</p>
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </div>
                    <div class="resume-counter" id="handling-objections">
                        <div class="row-one">
                            <p>Manejo de Objeciones</p>
                            <i class="fa fa-lightbulb-o"></i>
                        </div>
                        <div class="row-two">
                            <p>View Details</p>
                            <i class="fa fa-chevron-right"></i>
                        </div>
                    </div>
                </div>

                <div class="pop-up" id="pop-closure-tools">
                    <div class="header">
                        <div class="title">Herramientas de Cierre</div>
                        <i class="fa fa-window-close-o"></i>
                    </div>
                    <div class="content">
                        <div class="pitch-container">
                            <p class="pitch-title">Cierre  <i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                (Nombre del cuente) Usted tiene 18 meses a partir de la fecha de hoy para tomar sus vacaciones. Es 100% personalizable que significa que puede acomodarlo como usted quiera de todos modos si quiere separar las estadías. También es 100% extensible. Esto le da tiempo para planear cuando se quiere ir y a quién va traer con usted. (Nombre del cliente) Todas las partes de estas vacaciones son transferibles, si no se puede utilizar por cualquier razón usted puede venderlos o regalarlos a un miembro de la familia o un amigo como un gran regalo. Las vacaciones son de fecha abierta para que pueda viajar siempre cuando desee.
                            </span>
                        </div>
                    </div>
                </div>

                <div class="pop-up" id="pop-selling-pitch">
                    <div class="header">
                        <div class="title">Pitch de Ventas</div>
                        <i class="fa fa-window-close-o"></i>
                    </div>
                    <div class="content">

                        <div class="pitch-container">
                            <p class="pitch-title">Pitch #1  <i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">

                <h4>PARTE 1. SERVICIO AL CLIENTE.</h4>

                Buenos días, hablo con el Sr/Sra_______, le saluda el ingeniero________ desde la ciudad de  Miami, somos la oficina central de Servicio al cliente de Cupon tours Miami, representante de los hoteles  Westgate resorts para el territorio Colombiano. ( o el país donde este ubicado)

                Lo llamo por que a mi sistema me llegaron sus datos para poder contactarlo como ultima referencia, ya que nuestra oficana le envio un sobre hace 20 dias atras a su direccion ___________ que en dicho sobre hace referencia a una bonificacion la cual usted fue acreditado para que usted y toda su familia sean invitados de honor y viajar a Miami Beach, Orlando y un cruecero por las  Bahamas

                Solo faltaba que usted devuelva la documentacion y termine su registro y asi  dejar habilitada su bonificacion, mi llamada es para terminar dicho registro que esta por vencer el dia de hoy.

                En mi sistema sale que dicho sobre fue entregado a la direccion correcta, pero su registracion esta aun pendiente si no lo termino de registrar en esta llamada usted estara perdiendo dicho beneficio.

                <h4>PARTE 2.</h4>

                Permitame explicarte que esta llamada esta  siendo grabada y monitoreada  como lo pide departamento seguridad y ademas con el proposito de  verificar mi trabajo y asi darle toda la informacion posible a este  beneficio y mantendremos una copia de esta grabacion en nuestros archivos si desea una copia solo basta pedirla a servicioalcliente@cupontours.com

                <br>MOTIVACION AL 100%<br>

                El paquete de vacaciones consta de lo  siguiente 4 dias y 3 noches en orlando, Florida. la ciudad mas visitada del Mundo y hogar de los parques de Disney y Universal. usted. se alojara con toda su Familia en nuestro muy galardonado hotel, mas de 20mil habitaciones y si hace una reserva con anticipacion, lo ayudaremos hospedarse en una de habitaciones que da al castillo de la cenicienta y es espectacular para tener una vista prvilegiada de los fuegos artificiales La habitacion consta de terraza, sala, comedor, lavanderia y cocina equipada para poder autosuministrase los desayunos almuerzos y comidas tiene dos Iindas habitaciones beliamente amobladas.  conocera Disney con sus cuatro parques tematicos Magic Kngdom donde se el castillo de la cenicienta  y el mas visitada de todo los  parques Epoot Center usted podra disfrutar de un paseo por las mas bellso paisajes de  mundo como China, Paris Mexico Alemania Austna, Canada Japon, etc. En Holywood studios usted conocera como se  hicieron las peliculas de holywood y entrara a juegos famosos como la torre de terror starwars y ecenas de peliculas famosas. Animal Kingdom, podra disfrutar de un safari en vivo, subir al monte Everest conocer a pie  grande y podra disfrutar de juegos variados de agua asi como la casa de la famlia robinson. conocera también Universal studios con sus espectaculares montanas Rusas island of Adventure (isla de la Aventura), donde disfrutara de la Ciudad de Harry Potter un sueno hecho realidad para usted y sus hijos  No se Preocupe, porque después de la Registracion,le llegaran videos de estos parques y sus atracciones para que se los ensene a sus hijos. El segundo destino es Miami Beach por 3  duas y 2 noches usted se hospedara en un fabuoso hotel con vista al Mar, alli se encuentran nuestras oficinas centrales podra conocer la Collins av. donde se filmaron las escenas de Miami vice y es hogar de los mas altos rascacielos y los mejores restaurantes del Mundo y las mas bellas playas con un color Azul, dificil de lmaginar Podra irse de compras a Sawgrass mall, donde podra adquirir desde ropa, calzado y electrodomesticos hasta oon un 80% Descuerdo al Valor que usted encuentra en su pais el  Tercer destino es un crucero a las Bahamas por 3 dias y 2 noches, en el Bahamas Paradise, un Barco que fue originalmente de la famosisima Naviera Carnival y ahora esta habaitado para nuestra travesia y exclusivo para esta bonificacion Nuestro Barco posee 751 habitaciones y mas del 61% da con vista al Mar, podra de distrutar ilimitadamente de todas las bebidas y comidas en mas de 11 restaurantes todos de categoria superior ya que fuimos premiados como la mejor  cocina del Caribe y ademas le entregaremos 50 dolares para que disfrute del mas grande casino de alta mar.

                Por ser usted un cliente preferente se le entrgara también un auto una semana consecutiva, un auto sedan tipo toyota corolla, con GPS incluido  y todo en espanol, recuerde que en Miami y ortando todos hablan espanol.

                El auto se le entregara en el aeropuerto por el personal de nuestra empresa. los cuales lo estaran esperando a la salida de migracion con un letrero que tendra el apellido de su familia y asi darle las mas cordial bienvenida a la ciudad de Miami Beach.

                Cupon Tours pensando en darle mayores beneficios tiene una alianza estrategica con la Aerolineas  y usted podra acceder a precios preferenciales que no los encontrara en ninguna agencia de viajes de su pais.

                Le explico acerca de la Visa por  si no la tiene aun, no se preocupe, ya que usted califica para recibir una carta de invitacion y legalizasa que certificara al consul de la embajada estados unidos en su pais, que usted viajara solo por vacaciones por un tiempo determinado y lograra asi una visa multiple de hasta 5 anos para usted y toda su familia asi que no se preocupe. verdaderamente una bonificacion dificil de rechazar, verdad? es por esto que todos los bonificados estan ya  registrados y usted es uno de los ultimos que quedan por registrarse.

                <h4>PARTE 3. FUERZA Y NO DEJARSE COLGAR.</h4>

                Recuerde que esta bonificacion es excusiva para usted y no esta abierta para el publico en general, ya que el costo real de un paquete vacacional de este tipo para una familia regular de hasta 4 personas es de US$ 5200 aproximadamente $1,298 por Persona.

                Hoy usted fue bonificado con la oposion paga 1 Persona y viajan 4.si desea incrementar pasajeros adicionales a partir de la quinta persona, usted solo cubrira un minimo valor de $299 adicional por cada uno hasta un total de hasta 7 personas como Maximo.

                Ahora solo basta con terminar la registracion que esta pendiente:
                El paquete lo pondre a su nombre: sr/sra___________
                Permitame el  nombre de su esposo/a para incuirio en el sistema y asi cualquiera podria iniciar la reserva sra/ sr_______Aqui tengo su direccion__________. sus telefonos de contacro  son_______

                ahora vertfiqueme su correo  electronico por tavor__________@________ya  estamos terminando, solo queda un minuto mas en mi sistema me aparece, que usted es cliente preferente del Banco____ con una tarjeta de credito mi sistema me pide solo ultimos  numeros para desencriptar la  informacion y asi terminar su registro, veo también que usted califica para poder pagar estos unicos $399 en comodas cuotas de 3, 6, 9 y hasata 12 meses directamentes con su banco una suerte que pocos tienen en estos casos sr/sra_______
                ya que la cuota la pagara recien a final del  proximo mes y no afectara su economia famliar ya que es de aproximadamente de uss109 dolares mensuales si usted la tiene a 12 Meses. Ahora seria tan amable de veriscarme los utimos 4 numeros por favor ya que la suerte llega pocas veces a nuestras vidas y hoy es uno de ellos 3…….Ahora deme la fecha de expiracion ____

                Le traspaso a la sra brenda smith  la cual veriicara que toda informacion que HAYA INCLUIDO EN EL SISTEMA  SEA LA CORRECTA Y ASI PODERS DARLE SU NUMERO DE APROBACION Y CODIGO DE CLIENTE ESPERO VIAJE MUY  PRONTO Y  FELICIDADES.

                <br>TIPS<br>

                Si los ultimos 4 numeros de la tarjeta que te entrega el cliente, no son los que tienes, no te desesperas por  aqui es donde el cliente podria escaparse solo dile lo siguiente
                SR/SRA______Mi sistema no me permite desencriptar la informacion bancaria qsera que la tarjeta que usted me esta dando, no es la que esta bonificada aqui, posiblemente haya cambiado la taneta por una de chip verdad? o es que cambio la taneta por otro motivo. deme unos segundos que estoy pidiendo autorizacaon para desemcriptar la que tengo aquil (tocas los botones del teclado), Y!   .los numeros que tengo aqui son___________un  momento voy a anular este numero  de tarjeta  y pedir autorizacion para el beneficio com su nueva tarjeta. Deme  por favor los numeros nuevos de su taneta que empieza con 3_______ Ahora la nueva fecha de expracton, ahora si le paso las llamada con departamento de verificacion.

                </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">Pitch #2  <i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">

                <h4>SCRIPT PORTAFOLIO.</h4>

                Muy buenas tardes tengo el gusto de hablar con el Sr ___mucho gusto le
                habla________ del departamento de promociones de la compañía CUPOS
                TOURS como esta? Bien me alegra mucho.
                El motivo de mi llamada es porque en el sistema recibimos un registro de
                parte suya porque se encuentra interesado en nuestro plan vacacional verdad?
                A continuación yo le voy a explicar en qué consiste
                Antes de brindarle toda la información le recuerdo que la llamada es gravada
                y monitoreada y por efectos de calidad en cuanto a nuestros servicios. .
                En el transcurso de la llamada hacer preguntas de sondeo
                Cuantas personas desean viajar?
                Para qué fecha desea viajar?
                Es su primera vez viajando?

                Esta promoción es para usuarios exclusivos con tarjeta de crédito
                Utiliza visa y MasterCard o las dos?
                SR_ le cuento que esta es una promoción en la que usted y su familia van a
                poder disfrutar por un tiempo de permanencia de 7 días y 5 noches en EE.UU.,
                donde podrán conocer MAIMI, Orlando y las Bahamas con variedad hoteles
                con vista al mar con acceso a aéreas exclusivas como piscinas, gimnasio, spa,
                espectáculos diurnos y 3 restaurantes internacionales sin olvidar sus
                alrededores con lugares para compras y diversión.

                La estadía en Orlando es de 4 días y 3 noches donde usted estará muy bien
                ubicado a lado de los parques más soñados por adultos y niños esta Disney
                Word, Universal estudios y sea Word y lo mejor es que para su mayor
                comodidad le incluimos el trasporte a los parques totalmente gratis y con
                deliciosos desayunos continentales para las 4 personas.
                Y para cerrar con broche de oro usted tendrá un exclusivo crucero por las
                Bahamas por un tiempo de permanencia de 3 días y 2 noches con todo
                incluido! Comidas, bebidas no alcohólicas ilimitadas las 24 horas shows
                diurnos y nocturnos, casinos, discotecas, espectáculos en vivo y un día
                completo en la isla y mucho más! Recuerde traer con usted una vestimenta
                apropiada para la de bienvenida con el capitán y su tripulación.
                SR_____ una persona particular que no tiene las referencias que usted tiene
                por su excelente hoja de vida, asume el valor comercial real el cual es de 2000
                dólares que equivalen casi 6.000.000 millones de pesos, es decir lo único
                que usted tiene que pagar son 1,298 dólares equivalen en pesos a trm del dia
                donde usted cubre gastos administrativos y el buen servicio que le vamos a
                brindar en los diferentes lugares donde esté ubicado
                Que le parece nuestra oferta

                Recuerde q los impuestos gubernamentales por cruzar aguas de Bahamas
                según la temporada …están aproximadamente entre $79 y $199 dólares por
                persona (tranquilo que este valor lo cancela hasta el momento de su reserva)
                recuerde que los impuestos por noche en Orlando son de tan solo $18 dólares
                por todo el grupo familiar.

                Y únicamente esta promoción le incluye una semana de auto completamente
                gratis con seguro básico incluido y millaje ilimitado (kilometraje) y como
                usted ya sabe el impuesto básico de la Florida por día es de $10 a 18 dólares
                SR_____ Le aclaro que no a todo el mundo se le entrega este beneficio tan
                amplio solo a muy pocos tarje aviente activos.
                Por seguridad toda la información es protegida por la ley habías data 1581
                protección de datos del consumidor la cual nos permite verificar los datos de
                su tarjeta de crédito en este caso (nombrar si es visa o MasterCard) esta tiene
                una fecha de vencimiento en la
                parte frontal donde dice good thru valid thru o válido hasta que fecha le
                aparece? esta tiene 19 dígitos públicos que lo identifican como el titular 16 en
                la parte frontal y cuatro al respaldo esta por ser( nombrar franquicia) inicia
                con el número __ y al respaldo después de la franja blanca aparecen tres
                numeritos más cuales son correcto
                Sr ____ en este momento lo voy a transferir al departamento de auditoría y
                control allá le van hacer un pequeño resumen de todo lo que le va a llegar
                para que no vaya haber ningún error humano.
                </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">Pitch #3  <i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">

                <h4>SCRIPT MIAMI.</h4>
                Muy buenas tardes tengo el gusto de hablar  con el Sr ___mucho gusto le hablo  del departamento de promociones de la compañía CUPON TOURS
                Mi nombre es _____________ asesora comercial como esta?   Bien  me alegra mucho.
                El motivo de mi llamada es para indicarle que (nuestro) acá en el sistema me registra una promoción gracias a las excelentes referencias que ha tenido en las diferentes entidades por ser cliente titular.
                Le informo que por seguridad esta llamada está siendo gravada y monitoreada para garantizarle una mayor calidad en cuanto a nuestros servicios.
                Esta promoción es para usuarios exclusivos con tarjeta de crédito
                Utiliza visa o MasterCard o las dos?
                SR_ le cuento que esta es una promoción  en la que usted y su familia van a poder disfrutar por un tiempo de permanencia de 7 días y 6 noches en EE.UU., donde podrán conocer MAIMI, Orlando y las Bahamas con variedad  hoteles con vista al mar con acceso a aéreas exclusivas como piscinas, gimnasio, spa, espectáculos diurnos y 3 restaurantes internacionales sin olvidar sus alrededores con lugares para compras y diversión.
                La estadía en Orlando es de 4 días y 3 noches donde usted estará muy bien ubicado a lado de los parques mas soñados por adultos y niños desde Disney Word, Universal estudios y sea Word y lo mejor es que para su mayor comodidad le incluimos el trasporte a los parques totalmente gratis y con deliciosos desayunos continentales para las 4 personas.
                Y para cerrar con broche de oro usted tendrá un exclusivo crucero por las Bahamas por un tiempo de permanencia de 3 días y 2 noches  con todo incluido! Comidas, bebidas no alcohólicas  ilimitadas las 24 horas shows diurnos y nocturnos, casinos, discotecas, espectáculos en vivo y un día completo en la isla y mucho más! Recuerde traer con usted una vestimenta apropiada  para la bienvenida  de gala con el capitán y su tripulación.
                SR_____  una persona particular que no tiene las referencias que usted tiene por su excelente hoja de vida, asume el valor comercial real  de 2000 dólares que equivalen  a casi 6.000.000 millones de  pesos, es decir  lo único que usted tiene que pagar son 1,298 dólares para 4 personas  equivalen en pesos a (trm del día)     donde usted cubre gastos administrativos y el buen servicio que le vamos a brindar en los diferentes lugares donde esté ubicado. Y como si fuera y únicamente por el día de hoy   le incluye un vehículo completamente gratis con seguro básico incluido  y millaje (kilómetros) ilimitado y como y el impuesto básico de la Florida por día es de $10 a 18 dólares.
                Recuerde que los impuestos gubernamentales por cruzar aguas de Bahamas según la temporada están aproximadamente  entre $79 y $199 dólares por persona (tranquilo que este valor lo cancela hasta el momento de su reserva)  recuerde que los impuestos por noche en Orlando  son de tan solo $18 dólares por todo el grupo familiar.
                SR_____ Le aclaro que no a todo el mundo se le entrega este beneficio tan amplio solo a muy pocos tarje aviente activos.
                Por seguridad toda la información es protegida por la ley habías data 1581 protección de datos del consumidor el cual nos autoriza verificar los datos de su tarjeta de crédito en este caso (nombrar si es visa o MasterCard) esta tiene una fecha de vencimiento en la parte frontal donde dice good thru valid thru o válido hasta que fecha le aparece? esta tiene 19 dígitos públicos que lo identifican como el titular 16 en la parte frontal y cuatro al respaldo esta por ser( nombrar franquicia)  inicia con el número __ y al respaldo  después de la franja blanca aparecen tres numeritos más cuales son correcto.

                Sr ____ en este momento lo voy a transferir al departamento de auditoría y control allá le van hacer un pequeño resumen  de todo lo que le va a llegar para que no vaya haber ningún error humano.
                </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">Pitch #4  <i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                Esta información. (Nombre del cliente) así usted puede tomar una decisión durante esta llamada; ¿Verdad?! (Esperar respuesta) (SI no aislar la objeción, si no es la persona que toma decisiones, o no toman decisiones sin su pareja, establecer devolución de llamada en el marcador pan cuando ambos estén disponibles.
                                <br><br>
                                Preguntas de calificación:
                                <br>
                                1) ¿Tiene por lo menos 25 años de edad o más correcto? (Espere la respuesta) ¿Y para comprobar en las estaciones de aquí, usted tiene una tarjeta de crédito válida a su nombre verdad? (Esperar la respuesta).
                                <br>
                                2) (Nombre del cliente) Alguna vez has estado en la Florida? (Esperarla respuesta) Ahora las vacaciones son para hasta 4 viajeros. ¿Normalmente con quién viaja? (Esperar la respuesta) Y que les gusta hacer cuando van de vacaciones? (Esperar la respuesta).
                                <br><br>
                                Para empezar en sus increíbles vacaciones de la Florida, le tendremos un alquiler de automóvil por 7 días esperando en el aeropuerto con kilometraje ilimitado.
                                <br>
                                Sus vacaciones se iniciarán con 4 días y 3 noches en la mágica ciudad de Orlando ... EI hogar de Disney World, Universal Studios, lslands of Adventure y Sea World.
                                <br><br>
                                ¿Alguna vez ha estado en Orlando antes (nombre del cliente)?
                                <br>
                                Si, Si: ¡Ok genial! ¡Entonces usted ya sabe lo divertido y mágico que es!!!
                                <br>
                                Si No: ¡Pues sabemos que absolutamente te va a encantar!!!
                                <br><br>
                                Como ya le expliqué, ¡tendrá 4 días y 3 noches en un complejo de categoría 4 estrellas o más! Y cuando se registra en el resort les permitirá el acceso a todos los servicios de nuestros resorts, tales como:
                                <br>
                                •	El casa club, gimnasio.
                                <br>
                                •	Piscina climatizada y jacuzzi.
                                <br>
                                •	Lagos privados.
                                <br>
                                •	Las clases de esquí acuático y pesca.
                                <br>
                                •	Canchas de tenis y baloncesto.
                                <br>
                                •	Piscina para niños y juegos infantiles.
                                <br>
                                •	Servicio de transporte gratuito.
                                <br><br>
                                También va tener en la capital del sol Miami/Fort Lauderdale otros 4 días y 3 noches, donde usted puede estar justo en la arena con vista al océano en un hermoso complejo como el Wyndham Beach Resort. ¡Usted puede disfrutar y relajarse en las playas tomando sol! O tal vez ser un poco aventurero y realizar deportes acuáticos. Nuestra variedad de Hoteles/Resorts también ofrecen servicios completos de spas para consentirse un poco como el “Seven Seas Spa Resort & Salón”. Y para que se deleite su paladar, tenemos restaurantes famosos como Kitchen 305, Steak 954, Truluck's ... etc. Restaurantes emocionantes y únicos de aquí con buena comida, música en vivo, y diversión durante sus cenas. Sus únicas responsabilidades para sus vacaciones serán para los gastos imprevistos, tales como el transporte aéreo y el impuesto de hotel y los honorarios normales. ¿Suena muy bien hasta ahora verdad? (Esperar la respuesta).
                                <br>
                                Ahora (Nombre del cliente) eso no es todo ... ¿Estás lista/listo para la mejor parte de sus vacaciones? (Espera la respuesta) Ok, como un bono con el registro de hoy, también estamos incluyendo un crucero de 3 días 2 noches a bordo de Bahamas Paradise Cruise Line, que viaja a las Bahamas. Usted simplemente le deja saber al departamento de reservas las fechas en las cual desea tomar su crucero. Usted sólo será responsable de los impuestos de puerto en el momento de la reserva. (SOLO si preguntan, ES ALREDEDOR DE $159 POR PERSONA).
                                <br>
                                Ahora (Nombre del cliente) este paquete ¡tiene un valor que es más de $3,598! ¡Sin embargo, con sus, $2,000 de recompensa de esta promoción de viaje, te puedo dar los 8 días 7 noches de vacaciones por el bajo precio de $ ________, por persona para los primeros 2 viajeros!!! ¡Y la estancia del tercero y el cuarto invitado seria GRATIS!!! Por lo tanto (Nombre del cliente) eso solo es $ _______ total para hasta 4 personas por todo; Alquiler de coche con kilometraje ilimitado durante 7 días consecutivos, 4 días 3 noches en Orlando, 4 días 3 noches and Miami Beach o Fort Lauderdale en la playa, Y como un bono adicional, no nos olvidemos de los 3 días y 2 noches de crucero las Bahamas. ¿No es eso fantástico? (Espere la respuesta).
                                <br>
                                Ahora, algunas personas nos preguntan cómo podemos dar todo eso por un precio tan bajo. Bueno, todo lo que pedimos, es mientras que, en Orlando y Miami, usted nos permita darles una vista previa VIP de 90 minutos de uno de nuestras propiedades de las comunidades de vacaciones privadas. ¿Lo suficientemente justo? (Espera la respuesta).
                                <br><br>
                                Así que déjame ir adelante y recapitular todo lo que va recibir.
                                <br>
                                •	4 días 3 noches en Orlando.
                                <br>
                                •	4 días 3 noches en Miami Beach/Fort Lauderdale.
                                <br>
                                •	3 días 2 noches de Crucero por las Bahamas.
                                <br>
                                •	Alquiler por 7 días con kilometraje ilimitado.


                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">Pitch Informativo  <i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                <b>INBOUND:</b> Buenos días/tardes/noches. mi nombre es _________________, con el departamento de promociones de Turísticos USA. ¡Gracias por llamar hoy para activar su bono de descuento de $2,000 hacia una oportunidad de viaje increíble!!!
                                <br>
                                <b>OUTBOUND:</b> Buenos días/tardes/noches, mi nombre es ___________, con el departamento de promociones de Turísticos USA. Le estamos llamando hoy porque ustedes se registraron por Internet para recibir información sobre paquetes de viaje. ¡El día de hoy hemos seleccionado a 30 personas para recibir un bono vacacional de $2,000 Y ustedes son uno de los ganadores!
                                <br><br>
                                ¿Con quién tengo el placer de hablar hoy? (entrar información en computador)
                                <br>
                                ¿(Nombre del cliente) Como va su día hoy? (ESPERAR RESPUESTA) ¡Estupendo! Para comprobar disponibilidad necesito confirmar su país, ciudad y número de teléfono. (Repetir y confirmar con cliente).
                                <br>
                                Ahora (Nombre del cliente), el objetivo de esta promoción el día de hoy es para traer las familias a la Florida para disfrutar de unas vacaciones fabulosas y nos permitirá tratarlos como ustedes se lo merecen durante el tiempo de su estadía, sabemos que una vez que usted ha experimentado nuestros servicios 5 estrellas, quera volver a viajar con nosotros en el futuro y lo más importante, le dirá a todos sus amigos y familiares las vacaciones estupendas que pasaron usted y su familia, y entonces de esa manera tendremos muchos referidos por su excelente experiencia. ¿Tiene sentido? (ESPERAR RESPUESTA).
                                <br>
                                Ok ¡Genial! Veo que tenemos disponibilidad para su paquete en (País de cual nos llama) por favor comprenda que solo puedo mantener la promoción en esta llamada telefónica, ¡ya que es un precio promociona! del día de hoy. Por favor agarre un lápiz y papel, para poder darle los detalles de su paquete de vacaciones. ¿De acuerdo? Avíseme cuando esté lista/listo para empezar.
                                <br>
                                (Nombre del cliente) Una vez más, mi nombre es ________, y el nombre de nuestra empresa es Turísticos USA. Somos uno de los propietarios y desarrolladores más grandes de resorts en el sur de la Florida.
                                <br>
                                Debido a la gran respuesta y la disponibilidad limitada de esta promoción, nosotros solo permitimos una llamada por hogar. Lo que significa es que yo le voy a dar todos los detalles, le voy a contestar todas sus preguntas, al final simplemente necesito que me haga saber si esto es algo que le gustarla aprovechar, ¿o no? Tenga en cuenta que va tener un total de 18 meses para viajar, así que no se preocupe por las fechas de viaje o con quien usted viaje... En base a cuando nos de un aviso previo de 30 días de las fechas requeridas. Sugerimos un viaje a través de la temporada alta de vacaciones.
                                <br>
                                Ahora (nombre del cliente) el pago de hoy en día solo en lugar de miles de dólares por estas increíbles vacaciones, por su invitación VIP, todo lo que tendría que pagar por hoy es diferencia de su bono vacacional que sería un total de $ _____, pero antes de registrarlo déjeme preguntarle:
                                <br><br>
                                <b>CALIFICACIÓN - PREGUNTAS RÁPIDAS</b>
                                <br><br>
                                <b>(Nombre del cliente) ¿Es usted mayor de 25 años de edad?</b>
                                <br>
                                Si > ¡Es genial!
                                <br>
                                No > Ok, ¿está en buenas posiciones con su compañía de tarjeta de crédito?
                                <br><br>
                                <b>(Nombre del cliente) ¿Está usted casado o soltero?</b>
                                <br>
                                <i><b>Casado(a)</b></i>
                                <br>
                                ¡Genial! ¿viaja con su pareja verdad? (Esperar la respuesta).
                                <br>
                                Si > (Continúe a la siguiente pregunta).
                                <br>
                                No > (Explica que con el fin de tomar ventaja de esta promoción tiene que viajar con su cónyuge).
                                <br><br>
                                <i><b>Mujer Soltera.</b></i>
                                <br>
                                ¡Perfecto eso es genial! (Pasar a la siguiente pregunta).
                                <br><br>
                                <i><b>Soltero</b></i>
                                <br>
                                No hay problema, dígales que tengo un paquete especial para usted… Diles que aguanten un momento que quiero hacer algo especial para ti (Colocar en espera y, obtener al gerente para un paquete de precios FIT).
                                <br>
                                Sin embargo, tenga en cuenta que esta oferta solo es buena para hoy. Y hoy SOLAMENTE. Escriba esta cantidad abajo $ ________ y ponle un círculo. Esto no es por persona, ¡esto es por todo! La totalidad de todo lo que le mencioné.
                                <br>
                                Ahora (Nombre del cliente), otra vez usted ha sido pre-aprobado para el precio de $ ____________, y para asegurar el fantástico precio, nosotros aceptamos Visa, MasterCard, American Express o Discover… ¿Qué tarjeta va a utilizar hoy en día?
                                <br>
                                Tómese su tiempo y yo sostengo mientras la agarras… Déjeme saber cuándo esté listo(a).
                                <br>
                                Si, si a $ _______________.
                                <br>
                                Ok… ¿y la fecha de vencimiento?
                                <br>
                                ¿Y el número de tarjeta? Lentamente por favor.
                                <br>
                                ¿Número CVV en la parte posterior de la tarjeta?
                                <br>
                                Poner en espera y pasar a verificación.

                            </span>
                        </div>
                    </div>
                </div>

                <div class="pop-up" id="pop-notifications">
                    <div class="header">
                        <div class="title">Notificaciones</div>
                        <i class="fa fa-window-close-o"></i>
                    </div>
                    <div class="content"></div>
                </div>

                <div class="pop-up" id="pop-handling-objections">
                    <div class="header">
                        <div class="title">Manejo de Objeciones</div>
                        <i class="fa fa-window-close-o"></i>
                    </div>
                    <div class="content">
                        <div class="pitch-container">
                            <p class="pitch-title">YO NO DOY MI NUMERO DE TARJETA DE CRÉDITO POR TELÉFONO<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                Permítame decirle algo sobre nuestra compañía ___________, es una empresa seria que trabaja hace varios años ofreciendo paquetes vacacionales de calidad y excelencia a nuestros clientes. Contamos con cuentas abiertas con cada una de las tarjetas de crédito como Visa, MasterCard y American Express.
Para nosotros poder obtener el privilegio de trabajar con ellos fuimos sometidos a investigaciones rigurosas de todas nuestras transacciones que, de no haber sido satisfactorias, hoy no podría estar hablando con usted. ¡Además Sr.(a) _________ recuerde que esa es una forma muy normal de hacer negocios con Tarjeta de Crédito por teléfono, así que por eso no se preocupe, vamos a inscribirle! ¿Dígame prefiere utilizar Visa, MasterCard o American Express?
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">SI AUN NO QUIERE DAR EL NUMERO DE SU TARJETA<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                Permítame explicarle nuestro sistema de inscripción punto por punto. Una vez que yo le inscriba hoy debo transferir su archivo y esta llamada a nuestro Departamento de Verificación, ahí por motivos de seguridad, tanto para usted como para nuestra empresa, la conversación será grabada, donde se le repasaran todos los detalles de sus vacaciones paso a paso lo cual son exigencias de nuestro banco para asegurar un buen servicio a todos nuestros clientes. Así que vamos a inscribirlo, ¿Desea usar Visa, MasterCard o American Express?
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">PUEDO LLAMAR MAS TARDE<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                a) Usted ha tenido suerte Sr.(a) ya que todavía nos quedan algunos paquetes con precio promocional. En estos momentos hay cientos de personas tratando de comunicarse con nosotros para poder reservar a costo promocional. Lamentablemente si usted pierde esta oportunidad el paquete volverá a su costo regular. Y yo me imagino que a usted le gusta ahorrar dinero ¿VERDAD? Magnifico, vamos a inscribirlo.
                                <br>
                                b) Sr.(a) por eso le pregunté si podía tomar una decisión hoy. Debido al limitado cupo de habitaciones a costo promocional y al gran numero de llamadas que hemos recibido, tenemos que limitar la participación a una llamada.
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">SI TODAVIA INSISTE QUE NECESITA TIEMPO PARA PENSARLO<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                a) En verdad hay solo “3” cosas que tiene que pensar para aceptar las vacaciones: son lugares que a usted le gustaría visitar en sus próximas vacaciones, ¿verdad? Usted debe tomar unas vacaciones dentro del próximo año, y estoy seguro que estas vacaciones con descuento representan una gran oferta para usted, verdad que sí? Entonces vamos a inscribirle, ¿desea usar Visa, MasterCard o American Express?
                                <br>
                                b) Yo comprendo eso, usted solo quiere algún tiempo para pensarlo, según ya se le explicó al principio de nuestra conversación, esta es una oferta en promoción y ya he activado su numero de reservación, por favor comprenda que para ser justos con los que están llamando y quieren sus vacaciones, tenemos que manejar el numero de llamadas que recibimos en un día. No solo ofrecemos exclusivamente estas vacaciones de alta calidad, sino que nuestro Departamento de Servicio al Cliente asegura la completa satisfacción del cliente, así es que ¡vamos a proceder a inscribirlo!
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">NO TENGO DINERO<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                a) Sr.(a) esta promoción se ha diseñado para personas con un presupuesto apretado. Esto le permite hacer un viaje que de otra forma sería inalcanzable. Estoy seguro que _____ dólares están dentro de su presupuesto de vacaciones, ¿no es así? Magnifico, vamos a inscribirlo.
                                <br>
                                b) Sr.(a) Usted siempre había querido viajar a estos lugares, aquí tiene la oportunidad de disfrutar de estas fabulosas a un costo mínimo, así que ¡vamos a inscribirlo!
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">¿CUAL ES EL TRUCO?<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                La única razón por la cual podemos ofrecerle estas vacaciones de calidad a un precio tan reducido es sencillamente porque estamos fomentando el turismo en __________. Además, recuerde que somos mayoristas en la industria de viajes con un alto volumen en ventas que nos permite promover el turismo en Hoteles y Lugares de Temporada. Esto nos permite ofrecerle estas vacaciones verdaderamente especiales con la esperanza de que usted continuará viajando con nosotros en el futuro, así es que ¡vamos a inscribirlo!
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">SUENA DEMASIADO BIEN PARA SER VERDAD<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                a) Déjeme explicarle como y porque podemos ofrecerle estas vacaciones a un precio tan accesible; somos mayoristas en la industria de viajes con un alto volumen de ventas que fomenta el turismo en Hoteles y Lugares de Temporada, así que podemos ofrecerle tarifas verdaderamente especiales. Estas vacaciones se han diseñado para que usted pueda disfrutarlas totalmente y a la vez ayudarnos a lograr una buena publicidad, con esperanza de que usted continuará viajando con nosotros en el futuro. ¡Vamos a inscribirlo!
                                <br>
                                b) Sr.(a) ____________, SERÍA CORRECTA LA FRASE… pero nosotros somos una agencia de viajes reconocida y contamos con usted para que nos refiera a sus amistades y miembros de su familia que quisieran disfrutar de este tipo de promociones. ¡Fantástico!!! Finalicemos su registración.
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">MANDAME ALGO POR ESCRITO O FAX<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                a) Nos gustaría hacerlo, pero en lo que usted recibe algo por correo, el numero limitado de vacaciones se habrá agotado. Usted tiene la información general y yo le voy a dar los detalles punto por punto. Usted tendrá todo en sus manos dentro de ____ días hábiles, y nuestro Departamento de Atención al Cliente va a confirmarle todo lo que le he dicho antes de enviarle su paquete. Para su protección, esa llamada será grabada.
                                <br>
                                b) Seguro que podemos enviarle algo por escrito. Solo necesito su correo y le enviare su carta de bienvenida. No solo tendrá acceso a toda la información que le he proporcionado, sino que se asegurará que todo lo que prometimos está incluido. ¿No suena fabuloso? Perfecto... continuemos con la registración. &#60;su número de tarjeta es? ...&#62;
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">ONE LEGGER (CUANDO SE ESTA HABLANDO SOLAMENTE CON UN MIEMBRO FAMILIAR Y HAY OTRA PERSONA QUE TAMBIEN TOMA DECISIONES, PERO ESTA AUSENTE)<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                Sr.(a) ________ no tiene que planear el viaje hoy pues tendrá que planear todo esto con su familia con tiempo para eso son los 18 meses. Lo que si tiene que hacer hoy es asegurar su cupo y participar en la promoción porque esto si se acaba hoy. ¡Esta vacación puede ser un viaje sorpresa para su familia y los sorprenderá cuando les dé la noticia!
                                <br>
                                Pregunte por el número de tarjeta de crédito de nuevo.
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">CREDIBILIDAD Y LEGITIMIDAD<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                Afortunadamente Sr.(a) ______________, la credibilidad de nuestra compañía está más que establecida después de estar en el Mercado de viajes por mas de 20 años. Le mandare por email los documentos de viaje ahora, mire también nuestra pagina en internet con las muchas opciones para que usted mismo(a) decida su destino de acuerdo a los gustos de su familia.
                                <br>
                                Pregunte por el número de tarjeta de crédito de nuevo.
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">NO PUEDO TOMAR LA DECISION HOY<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                Sr.(a) ________, ¿Qué le impide tomar la decisión hoy?
                                <br>
                                Esta promoción le costaría mas de $5000 si usted lo compra todo por separado. ¡Simplemente por tomar un tour se ahorra casi $4000! Este paquete incluye un crucero a las Bahamas, hotelería en Miami y en Orlando y además alquiler de un auto por una semana.
                                <br>
                                ¡Vamos a registrarlo ahora mismo! No tiene que decidir a donde quiere ir en este momento. Solo tenemos que garantizarle el cupo hoy mismo y tiene 18 meses para pensarlo con su familia.
                                <br>
                                Pregunte por el numero de tarjeta de crédito de nuevo.
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">¿Y LA AEROLINEA ESTA INCLUIDA? ¿O TENGO QUE PAGAR POR SEPARADO?<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                Muy buena pregunta. Acuérdese que este paquete es flexible en cuanto a cuando lo puede usar. Las aerolíneas siempre tienen especiales en temporadas bajas así que no se preocupe por eso, seria a costo extra, pero usted tiene mi número de teléfono, extensión y dirección de correo electrónico, ¡así que cuando esté listo(a) para usar el paquete yo le ayudo con eso! La semana pasada hice lo mismo para una familia de Quito y encontramos los tiquetes a un precio super cómodo.
                                <br>
                                Pregunte por el número de tarjeta de crédito de nuevo.
                            </span>
                        </div>
                        <div class="pitch-container">
                            <p class="pitch-title">CREDIT CARD USAGE<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                Sr.(a) nuestra compañía ha tomado muchas medidas de seguridad para proteger la información del consumidor. La información es protegida para terceros. Así es como se compran tiquetes de avión, cruceros, hasta productos de infomerciales… es común comprar y pagar con tarjeta por teléfono. Así que hacemos el 100% de nuestras ventas.
                                <br>
                                Al final, usted hablará con un agente de verificaciones y el agente confirmará con una conversación grabada todo lo que le ofrecí hoy. También recibirá un correo electrónico en menos de 24 horas con todo confirmado por escrito.
                                <br>
                                Pregunte por el número de tarjeta de crédito de nuevo.
                            </span>
                        </div>
                        <div class="pitch-container">
                            <p class="pitch-title">NOT A CALL BACK OFFER<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                Como le expliqué, Sr.(a) _______, para esta oferta solo se califica a cada familia una vez. No hay llamadas repetidas porque las llamadas son muchas y no sería justo poner en espera a otra familia que esta a punto de registrarse.
                                <br>
                                Pregunte por el número de tarjeta de crédito de nuevo.
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">MALA PUBLICIDAD EN INTERNET, MEDIOS DE COMUNICACIÓN O REDES SOCIALES<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                El internet sin duda alguna es una gran invención. Sin embargo, también le da acceso a cualquier persona a decir cualquier cosa con o sin pruebas. Por cada persona con impresión negativa hay una docena de historias increíbles de familias que lograron un viaje inolvidable y que le recomendaron nuestra compañía a sus amigos y familiares.
                                <br>
                                Pregunte por el número de tarjeta de crédito de nuevo.
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">¿POR QUÉ HACERLO HOY?<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                a) Esta promoción es a un precio especial introductorio para los nuevos clientes quienes de otra manera no tendrían la oportunidad de disfrutar de este paquete de vacaciones. Nuestra promoción está diseñada para traer nuevos referidos y seguir generando nuevos clientes. Es una oferta limitada y no estaría disponible por mucho tiempo. Lo mas maravilloso de esta oferta es que usted puede separar sus vacaciones hoy y aprovechar el 75% del precio real, además le da la oportunidad de viajar cuando y con quien quiera en los próximos 18 meses.
                                <br>
                                b) Sr.(a) _______, usted a lo mejor no sepa exactamente cuando va a tomar sus vacaciones en este momento, pero seguramente usted lo hará en el próximo año y medio; yo puedo garantizarle que usted no encontrará otra oferta como esta en ningún otro lugar. Solo necesito para que disfrute de una experiencia maravillosa y gratos recuerdos la fecha de expiración de la tarjeta que desea usar. Aceptamos Visa. MasterCard… Puedo esperar hasta que consiga los datos.
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">URGENCIA<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                Sr.(a)_____, le recuerdo que esta es nuestra promoción mas reciente y tenemos número limitado de llamadas ganadoras. Usted es uno de nuestros felices ganadores. No desaproveche esta oportunidad. Solo aceptamos ____ llamadas el día de hoy.
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">¿PUEDO CANCELAR?<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                Sr.(a) _____________, no queremos registrar esta promoción a alguien que no está planeando en usarla, queremos ofrecerla a nuestra gente que quieren sacar ventaja de esta única promoción.
                                <br>
                                Este paquete es 100% transferible, así es que si usted no puede usarla por cualquier circunstancia usted puede transferirla a un amigo u otro miembro de la familia. ¡solo necesitamos terminar la registración y usted estará listo para disfrutar de las mejores vacaciones!!!
                                <br>
                                &#60;su número de tarjeta es? ...&#62;
                            </span>
                        </div>

                        <div class="pitch-container">
                            <p class="pitch-title">NO ME GUSTAN LOS TIME-SHARES<i class="fa fa-chevron-down"></i></p>
                            <span class="pitch-content">
                                Sr.(a) _______, usted está recibiendo esta promoción con un tremendo descuento y ahorrando mucho dinero. Para nosotros hacer esto posible es requisito asistir a esta presentación. No es un secreto. Usted solo disfrutará de este “tour” y lo que la propiedad le puede ofrecer. No está obligado a comprar nada, pero le comento que muchos viajeros los hacen. Estas magnificas propiedades no existieran si las personas no estuvieran interesadas en ellas. ¿No le gustaría visitar un lugar que nunca ha visto antes? ¡Claro que sí! … además, solo por aceptar esta visita usted estará disfrutando de sus vacaciones y ahorrando el 75% del precio original. ¿Estamos de acuerdo?
                                <br>
                                ¿Que tarjeta queremos usar hoy?
                            </span>
                        </div>









                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

</body>
</html>