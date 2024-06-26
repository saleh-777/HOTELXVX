<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit77501be0a466d35422d6d095f62f5981
{
    public static $files = array (
        '62b15e16680c158ea02516f33e41c943' => __DIR__ . '/..' . '/wpbones/wpbones/src/helpers.php',
        'e9c15a5ace8cafe8839b4a6f138c07f3' => __DIR__ . '/../..' . '/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'e' => 
        array (
            'eftec\\bladeone\\' => 15,
        ),
        'W' => 
        array (
            'WPNCEasyWP\\' => 11,
            'WPNCEasyWP\\WPBones\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'eftec\\bladeone\\' => 
        array (
            0 => __DIR__ . '/..' . '/eftec/bladeone/lib',
        ),
        'WPNCEasyWP\\' => 
        array (
            0 => __DIR__ . '/../..' . '/plugin',
        ),
        'WPNCEasyWP\\WPBones\\' => 
        array (
            0 => __DIR__ . '/..' . '/wpbones/wpbones/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit77501be0a466d35422d6d095f62f5981::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit77501be0a466d35422d6d095f62f5981::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit77501be0a466d35422d6d095f62f5981::$classMap;

        }, null, ClassLoader::class);
    }
}
