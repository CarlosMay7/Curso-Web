<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita67897a34e285b54e54664cdd2b0bf7d
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/clases',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita67897a34e285b54e54664cdd2b0bf7d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita67897a34e285b54e54664cdd2b0bf7d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita67897a34e285b54e54664cdd2b0bf7d::$classMap;

        }, null, ClassLoader::class);
    }
}