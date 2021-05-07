<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc9cd13098c4ebde3363dbab7f6df24ad
{
    public static $prefixLengthsPsr4 = array (
        'N' => 
        array (
            'Neuffer\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Neuffer\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc9cd13098c4ebde3363dbab7f6df24ad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc9cd13098c4ebde3363dbab7f6df24ad::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
