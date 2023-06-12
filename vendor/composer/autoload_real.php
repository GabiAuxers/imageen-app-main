<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitc4b3cfae345f0e8a7863c0e243f45c11
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitc4b3cfae345f0e8a7863c0e243f45c11', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitc4b3cfae345f0e8a7863c0e243f45c11', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitc4b3cfae345f0e8a7863c0e243f45c11::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
