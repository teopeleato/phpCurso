<!-- 02. Curso PHP-MySQL: Acceder a contenidos dinámicos -->

<DOCTYPE! html>
    <html lang="es">
        <head>
            <title>Peticiones clientes</title>
            <meta charset="utf-8">
            <link href="style.css" rel="stylesheet">
        </head>
        <body>
            <header>
                <h1>Librería online</h1>
                <h2>Peticiones clientes</h2>
            </header>
            <section>
                <?php
                    $fp = fopen("pedidos/pedidos.txt","r");
					flock($fp,1);
					
					if(!$fp){
						echo "No hay órdenes pendientes. Prueba más tarde";
					}
					
					while(!feof($fp)){
						$pedido = fgets($fp,100);
						echo $pedido."<br>";
					}
					flock($fp,3);
                ?>
            </section>
            <footer></footer>
        </body>
    </html>