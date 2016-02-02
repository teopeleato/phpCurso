<DOCTYPE! html>
    <html lang="es">
        <head>
            <title>resumen del pedido</title>
            <meta charset="utf-8">
            <link href="style.css" rel="stylesheet">
        </head>
        <body>
            <header>
                <h1>Librería online</h1>
                <h2>Resumen del pedido</h2>
            </header>
            <section>
				<?php
				echo 'Pedido procesado el: ';
				$date = date('jS \of F Y h:i:s A');
				echo $date;
				echo '<br><br>-----------------------------------------------------------------------------------';
					
				//Cantidades del pedido
				echo '<br><br>Su pedido es el siguiente: <br><br>';
				$cant_1 = $_POST['cant_1'];
				$cant_2 = $_POST['cant_2'];
				$cant_3 = $_POST['cant_3'];
				$cant_total = $cant_1 + $cant_2 + $cant_3;

				if ($cant_total == 0){
					echo 'No ha introducido ninguna cantidad.';
					exit;
				}
				else{
					//Defino los precios como variables constantes
					define("PRECIO_1", 50);
					define("PRECIO_2", 80);
					define("PRECIO_3", 100);
					//Importe de cada tipo de libro
					$importe_1 = PRECIO_1 * $cant_1;
					$importe_2 = PRECIO_2 * $cant_2;
					$importe_3 = PRECIO_3 * $cant_3;
					
					if ($cant_1 > 0){
						echo '<ul><li><span class="titulo">"El señor de los anillos 1"</span></li><ul><li>'.$cant_1.' Libros</li><li>';
						echo $importe_1.' €</li></ul></ul>'; 
					}
					if ($cant_2 > 0){
						echo '<ul><li><span class="titulo">"El señor de los anillos 2"</span></li><ul><li>'.$cant_2.' Libros</li><li>';
						echo $importe_2.' €</li></ul></ul>'; 
					}
					if ($cant_3 > 0){
						echo '<ul><li><span class="titulo">"El señor de los anillos 3"</span></li><ul><li>'.$cant_3.' Libros</li><li>';
						echo $importe_3.' €</li></ul></ul>'; 
					}  
					
					//Calculo el descuento    
					if ($cant_total < 5){
						$descuento = 0;
					}
					elseif (5<=$cant_total && $cant_total<10){
						$descuento = 20;
					}
					else{
						$descuento = 45;
					}
					
					echo '-----------------------------------------------------------------------------------<br><br>';
					
					//Calculo importe total
					$importe_total_sinIVA = $importe_1 + $importe_2 + $importe_3;
					echo 'Importe total del pedido: '.number_format($importe_total_sinIVA,2).' €<br>';
					
					//Aplico el IVA
					define("IVA", 1.21);
					$importe_total_conIVA = $importe_total_sinIVA * IVA;
					echo 'Importe total del pedido (IVA  21% inc.): <b>'.number_format($importe_total_conIVA,2).' €</b><br>';    
					
					//Calculo importe total con descuento
					if ($descuento>0){
						echo '<br>Descuento de '.$descuento.' € por la compra de '.$cant_total.' libros.<br>';
						$importe_total_con_dto = $importe_total_conIVA - $descuento;
						echo 'Importe total del pedido tras descuento: <b>'.number_format($importe_total_con_dto,2).' €</b><br>';
					}
					
					 echo '<br>-----------------------------------------------------------------------------------<br><br>';
					
					
					$encuesta = $_POST['encuesta'];
					switch ($encuesta){
						case "a":
							echo 'Cliente enviado por internet';
							break;
						case "b":
							echo 'Cliente enviado por un amigo';
							break;
						case "c":
							echo 'Cliente enviado por la TV';
							break;
						default:
							echo 'No sabemos cómo nos ha encontrado';
					}
				}

				//Escibir en un archivo de texto
				//////////////////////////////////////////
				//1º Abrir el archivo (o crearlo si no existe)
				$registro = fopen("pedidos/pedidos.txt","a");
				//2º escribo
				$stringSalida = $date."\t El señor de los anillos I".$cant_1."\tEl señor de los anillos II".$cant_2."\tEl señor de los anillos III".$cant_3."\t Importe total:".number_format($importe_total_con_dto,2)."\r\n";
				fwrite($registro, $stringSalida);
				fclose($registro);



				?>
            </section>
            <footer></footer>
        </body>
    </html>