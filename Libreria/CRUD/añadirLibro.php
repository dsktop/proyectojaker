<?php
    require '../cnx.php';

    if($_POST['enviado']) {
        $name_book = $_POST['name_book'];
        $autor_book = $_POST['autor_book'];
        $categoria_book = $_POST['categoria_book'];
        $editorial_book = $_POST['editorial_book'];
        $stock_book = $_POST['stock_book'];

        echo $name_book;
        echo $autor_book;
        echo $categoria_book;   

        $sqlInsert = "INSERT INTO `books`(`id_cat`, `id_user`, `name_book`, `autor_book`, `edit_book`, `stock_book`) VALUES (?,?,?,?,?,?);";
        $psInsert = $cnx->prepare($sqlInsert);
        $psInsert->execute(array($categoria_book, 1, $name_book, $autor_book, $editorial_book, $stock_book));

        if($psInsert->rowCount()){
            echo "insercion correcta";
        }else {
            echo "insercion incorrecta";
        }
    }
    $sqlSelect = "SELECT * FROM `categorias`;";
    $ps = $cnx->prepare($sqlSelect);
    $ps->execute();
    $resCategoria = $ps->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <Link rel="stylesheet" href="style.css"/>
        <title>Sistema de gestion de libros</title>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500&display=swap" rel="stylesheet"> 
        <script src="https://kit.fontawesome.com/62cb099bac.js" crossorigin="anonymous"></script>
    </head>
    <body>
<!--Barra de navegacion-->
        <div id="nav-bar">
            <div id="nav-bar-content" style="margin-left:22rem; display: inline-flex;">
                <div class="pestañas" style="margin-top: 1.3rem; margin-left: 1.5rem;">
                    <a href="#" id="Dashboard-navbar">Dashboard</a>
                    <a href="..\home\index.php" id="Productos-navbar">Productos</a>
                    <a href="#" id="Categorias-navbar">Categorias</a>
                </div>
                <div class="añadirproducto-navbar" style="margin-top: 1rem;">
                    <a href="..\CRUD\añadirLibro.html" id="añadirproducto-btn">+ Añadir Producto</a>
                </div>
                <div class="notificacion" style="margin-top: 0.7rem; margin-left: 34rem;">
                    <img src="..\img\campana.PNG" alt="no se encontro elemento">
                </div>
                <div class="perfil" style="margin-top: 0.7rem; margin-left: 5rem; display: inline-flex;">
                    <a>Perfil</a>
                    <ul class="nav">
                        <li><img src="..\img\perfil.PNG" alt="no se encontro elemento">
                            <ul>
                                <li> <a href="..\login.html">Cerrar Sesión</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
<!--Barra de navegacion end-->

<!--Body Center, Aqui va el contenido-->
        <div id="body-content" style="color: black;">
            <div id="body-center">
                <div id="body-header-static" style=" margin-left: 5rem; margin-top: 2rem; margin-bottom: 3rem;">
                    <p>Añadir Libro</p>
                </div>
                <form action="añadirLibro.php" method="POST">
                    <div id="vista-previa-container" style="display: inline-flex;">
                        <div id="input-añadir-libro">
                            <p>Nombre</p>
                            <input type="text" name="name_book" id="name_book">
                            <p>Autor</p>
                            <input type="text" name="autor_book" id="autor_book">
                            <p>Editorial</p>
                            <input type="text" name="editorial_book" id="editorial_book">
                            <p>Categoria</p>
                            <select id="categoria_book" name="categoria_book">
                                <option class="optionM" value=""selected >Seleccionar Categoria</option>
                                <?php foreach($resCategoria as $cat){?>
                                <option  class="optionM" value="<?php echo $cat['id_cat']?>"><?php echo $cat['name_cat']?></option>
                                <?php } ?>
                            </select>
                            <p>Stock</p>
                            <input type="number" name="stock_book" id="stock_book">
                            <input type="hidden" name="enviado" id="enviado" value="1">
                            <div id="btns-under-input-aña">    
                                <button id="cancelar">CANCELAR</button>
                                <button id="aplicar">APLICAR</button>
                        </div>
                    </div>   
                        <!--ACA CONCHETUMARE!!!!-->
                </form>
                <div id="vista-previa" >
                    <p style="margin-left: 1rem; margin-top: 1rem; position: absolute">VISTA PREVIA</p>
                </div>
            </div>
            <div id="btn-under-vista-previa" style="margin-left: 61rem; display: inline-flex;">
                <p>Portada / Caratula</p>
                <button id="btn-subir-aña">SUBIR</button>
            </div>
        </div>
    </div>

<!--Body Center end-->

<!--Barra Lateral-->
   <div id="barra-lateral-container">
        <div id="side-bar-content">
            <p style="color: #a9b0bb;">FILTRAR PRODUCTOS</p>
            <div id="search" style="margin-top: 1rem;">
                <input id="buscar-inventario" type="text" placeholder="buscar en inventario">
                <button id="btn-search" > <img src="..\img\lupa.PNG" alt=""> </button>
            </div>
            <form action="paginafea.php">
                <div class="desplegables" id="id">
                <p>ID</p>
                <select id="select" name="selectid" disabled>
                    <option class="option" value="value1"selected >Todos</option>
                    <option  class="option" value="value2"> hay que poner cosas aki feos</option>
                    <option class="option" value="value3"> hay que poner cosas aki feos</option>
                </select>
                </div>
                <div class="desplegables" id="nombre">
                <p>Nombre</p>
                <select id="select" name="selectnombre" disabled>
                    <option class="option" value="value1"selected > Todos</option>
                    <option  class="option" value="value2"> hay que poner cosas aki feos</option>
                    <option class="option" value="value3"> hay que poner cosas aki feos</option>
                </select>
                </div>
                <div class="desplegables" id="grupo">
                <p>Grupo</p>
                <select id="select" name="selectgrupo" disabled>
                    <option class="option" value="value1"selected > Todos</option>
                    <option  class="option" value="value2"> hay que poner cosas aki feos</option>
                    <option class="option" value="value3"> hay que poner cosas aki feos</option>
                </select>
                </div>
                <div class="desplegables" id="categoria">
                <p>Categoria</p>
                <select id="select" name="selectcategoria" disabled>
                    <option class="option" value="value1"selected > Todos</option>
                    <option  class="option" value="value2"> hay que poner cosas aki feos</option>
                    <option class="option" value="value3"> hay que poner cosas aki feos</option>
                </select>
                </div>
                <div id="asendente-desendente" style="margin-top: 2rem;">
                    <input type="radio" id="asendente" name="orden" value="AS" disabled>
                    <label for="asendente">Asendente</label><br>
                    <input type="radio" id="desendente" name="orden" value="DE" disabled>
                    <label for="desendente">Desendente</label><br>
                </div>
                <div id="botones-sidebar">
                    <input type="button" id="clean" value="Limpiar Filtros" disabled>
                    <input type="submit" id="apply" value="Aplicar" disabled>
                </div>
                <div id="img-logo">
                    <img style="width: 5rem; margin-top: 11rem;" src="..\img\libronegro.PNG" alt="">
                </div>
            </form>
        </div>
    </div>
<!--Barra Lateral end-->
</body>
</html>
<script>
    window.onload = function(){
        let productos = document.getElementById('Productos-navbar');
        let dash = document.getElementById('Dashboard-navbar');
        let categorias = document.getElementById('Categorias-navbar');

        productos.style.borderBottom = '#ff2163 solid 3px';
        productos.style.fontWeight = 'bold';

        productos.addEventListener('click', function(){
            productos.style.borderBottom = '#ff2163 solid 3px';
        productos.style.fontWeight = 'bold';
            dash.style.borderBottom = 'none';
            dash.style.fontWeight = 'normal';
            categorias.style.borderBottom = 'none';
            categorias.style.fontWeight = 'normal';
        })

        
        dash.addEventListener('click', function(){
            productos.style.borderBottom = 'none';
            productos.style.fontWeight = 'normal';
            dash.style.borderBottom = '#ff2163 solid 3px';
            dash.style.fontWeight = 'bold';
            categorias.style.borderBottom = 'none';
            categorias.style.fontWeight = 'normal';
        })

        categorias.addEventListener('click', function(){
            productos.style.borderBottom = 'none';
            productos.style.fontWeight = 'normal';
            dash.style.borderBottom = 'none';
            dash.style.fontWeight = 'normal';
            categorias.style.borderBottom = '#ff2163 solid 3px';
            categorias.style.fontWeight = 'bold';
        }) 
    }
</script>

<!-- <script>
    window.onload = function(){

        document.getElementById('checkbox0').addEventListener('click', function(){
            document.querySelector("#checkbox1").click();
        })
    }
</script> -->