<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedores;
use Intervention\Image\ImageManagerStatic as Image;


class PropiedadControllers
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();

        $vendedores = Vendedores::all();

        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad;
        $vendedores = Vendedores::all();

        //arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Crea una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);


            /** SUBIDA DE ARCHIVOS */

            //Generar nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            //Setear la imagen
            // realiza un resize a la imagen con intervation
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }


            //Validar
            $errores = $propiedad->validar();

            //revisar que el arreglo de errores este vacio
            if (empty($errores)) {

                //crear la carpeta para subir imagenes
                if (!is_dir(CARPETAS_IMAGENES)) {
                    mkdir(CARPETAS_IMAGENES);
                }

                //guarda la imagen en el servidor
                $image->save(CARPETAS_IMAGENES . $nombreImagen);

                //guardar en la base de datos
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedores::all();

        $errores = Propiedad::getErrores();

        //Metodo POST para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // asignarlos atriutos
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);

            //validacion
            $errores = $propiedad->validar();

            //subida de archivos
            //Generar nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }



            if (empty($errores)) {
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    //Alamacenar la imagen
                    $image->save(CARPETAS_IMAGENES . $nombreImagen);
                }

                $propiedad->guardar();
            }
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
