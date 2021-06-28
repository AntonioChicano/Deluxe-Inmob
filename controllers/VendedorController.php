<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedores;

class VendedorController
{
    public static function crear(Router $router)
    {
        $errores = Vendedores::getErrores();

        $vendedores = new Vendedores;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Crear una nueva instancia
            $vendedores = new Vendedores($_POST['vendedores']);

            //Validar que no haya campos vacios
            $errores = $vendedores->validar();

            // no hay errores
            if (empty($errores)) {
                $vendedores->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $errores = Vendedores::getErrores();
        $id = validarORedireccionar('/admin');

        //Obtener datos del vendedor a actualizar
        $vendedores = Vendedores::find($id);

        //Ejecutar el codigo despues de que el usuario envie el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Asignar los valores
            $args = $_POST['vendedores'];

            // sincronizar objeto en memoria con lo que el usuario escribio
            $vendedores->sincronizar($args);

            //validacion
            $errores = $vendedores->validar();

            if (empty($errores)) {
                $vendedores->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                //Valida el tipo a eliminar
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $vendedores = Vendedores::find($id);
                    $vendedores->eliminar();
                }
            }
        }
    }
}
