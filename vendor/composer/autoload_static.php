<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitee9d27199c51463f9a43909c8a8eed80
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Fpdf\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Fpdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/fpdf/fpdf/src/Fpdf',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitee9d27199c51463f9a43909c8a8eed80::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitee9d27199c51463f9a43909c8a8eed80::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitee9d27199c51463f9a43909c8a8eed80::$classMap;

        }, null, ClassLoader::class);
    }
}
