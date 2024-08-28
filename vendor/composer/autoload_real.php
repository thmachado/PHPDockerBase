<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit79cb34a8c94e8aaadf1c9787a8dde4a5
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

        spl_autoload_register(array('ComposerAutoloaderInit79cb34a8c94e8aaadf1c9787a8dde4a5', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit79cb34a8c94e8aaadf1c9787a8dde4a5', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit79cb34a8c94e8aaadf1c9787a8dde4a5::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
