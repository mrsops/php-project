<?php
/**
 * Created by PhpStorm.
 * User: mrsops
 * Date: 4/12/18
 * Time: 8:23
 */
require_once __DIR__ . '/utils/utils.php';
require __DIR__ . '/utils/File.php';
require_once __DIR__ . '/entity/ImagenGaleria.php';
require_once __DIR__ . '/database/QueryBuilder.php';
require_once __DIR__ . '/database/Connection.php';
require_once __DIR__ . '/exception/QueryException.php';
require_once __DIR__. '/core/App.php';
require_once __DIR__. '/repository/ImagenGaleriaRepository.php';

$errores=[];
$descripcion='';
$mensaje='';


$connection=App::getConnection();

    try{
        $config=require_once 'app/config.php';
        App::bind('config', $config);
        $imagenGaleriaRepository = new ImagenGaleriaRepository();
        if($_SERVER['REQUEST_METHOD' ]==='POST'){

            $descripcion=trim(htmlspecialchars($_POST['descripcion']));

            $tiposAceptados=['image/jpeg', 'image/png', 'image/gif'];
            $imagen=new File('imagen', $tiposAceptados);
            $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);
            $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY, ImagenGaleria::RUTA_IMAGENES_PORTFOLIO);
            $imagenGaleria = new ImagenGaleria($imagen->getFileName(), $descripcion);
            $imagenGaleriaRepository->save($imagenGaleria);
            $mensaje='Se ha guardado la imagen en la BDA';
            $descripcion='';
        }
        $imagenGaleriaRepository = new ImagenGaleriaRepository();
        $imagenes = $imagenGaleriaRepository->findAll();

    }catch (FileException $fileException){
        $errores[]=$fileException->getMessage();
    }catch (QueryException $exception){
        $errores[]=$exception->getMessage();
    }

require  __DIR__. '/../views/galeria.view.php';