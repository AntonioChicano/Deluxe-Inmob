<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;


class PaginasControllers
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar('/propiedades');

        //buscar la propiedad por su ID
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router)
    { // Es estatico. Hacerlo dinamico
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router)
    {

        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuesta = $_POST['contacto'];

            //Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'd4fdadcf94c9da';
            $mail->Password = '926cf89df6328d';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar el contenido del email
            $mail->setFrom('admin@deluxeinmob.com');
            $mail->addAddress('admin@deluxeinmob.com', 'DeluxeInmob.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';


            // Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuesta['nombre'] . '</p>';

            //Enviar de forma condicional  algunos campos de email o telefono
            if ($respuesta['contacto'] === 'telefono') {
                $contenido .= '<p>Eligió ser contactado por telefono</p>';
                $contenido .= '<p>Telefono: ' . $respuesta['telefono'] . '</p>';
                $contenido .= '<p>Fecha de contacto: ' . $respuesta['fecha'] . '</p>';
                $contenido .= '<p>Hora: ' . $respuesta['hora'] . '</p>';
            } else {
                //Es email, entonces agregamos el campo de email
                $contenido .= '<p>Eligió ser contactado por email</p>';
                $contenido .= '<p>Email: ' . $respuesta['email'] . '</p>';
            }

            $contenido .= '<p>Vende o Compra: ' . $respuesta['tipo'] . '</p>';
            $contenido .= '<p>Precio o Presupuesto:  €' . $respuesta['precio'] . '</p>';
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuesta['contacto'] . '</p>';
            $contenido .= '</html>';


            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            //Enviar el email
            if ($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar...";
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
