<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2d7a7cd2e20c50f105c7d77d707b1ab6
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Ctype\\' => 23,
        ),
        'P' => 
        array (
            'Psr\\Container\\' => 14,
        ),
        'A' => 
        array (
            'Allex\\' => 6,
            'Alledia\\Builder\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Allex\\' => 
        array (
            0 => __DIR__ . '/..' . '/alledia/wordpress-plugin-framework/src/library',
        ),
        'Alledia\\Builder\\' => 
        array (
            0 => __DIR__ . '/..' . '/alledia/wordpress-plugin-builder/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
        'P' => 
        array (
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/src',
            ),
        ),
    );

    public static $classMap = array (
        'UpStream_Admin_Reviews' => __DIR__ . '/../..' . '/includes/admin/class-up-admin-reviews.php',
        'UpStream_Metaboxes_Clients' => __DIR__ . '/../..' . '/includes/admin/metaboxes/class-up-metaboxes-clients.php',
        'UpStream_Metaboxes_Projects' => __DIR__ . '/../..' . '/includes/admin/metaboxes/class-up-metaboxes-projects.php',
        'UpStream_Options_Bugs' => __DIR__ . '/../..' . '/includes/admin/options/class-up-options-bugs.php',
        'UpStream_Options_Extensions' => __DIR__ . '/../..' . '/includes/admin/options/class-up-options-extensions.php',
        'UpStream_Options_General' => __DIR__ . '/../..' . '/includes/admin/options/class-up-options-general.php',
        'UpStream_Options_Milestones' => __DIR__ . '/../..' . '/includes/admin/options/class-up-options-milestones.php',
        'UpStream_Options_Projects' => __DIR__ . '/../..' . '/includes/admin/options/class-up-options-projects.php',
        'UpStream_Options_Tasks' => __DIR__ . '/../..' . '/includes/admin/options/class-up-options-tasks.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2d7a7cd2e20c50f105c7d77d707b1ab6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2d7a7cd2e20c50f105c7d77d707b1ab6::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit2d7a7cd2e20c50f105c7d77d707b1ab6::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit2d7a7cd2e20c50f105c7d77d707b1ab6::$classMap;

        }, null, ClassLoader::class);
    }
}
