<?php
// app/AppKernel.php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
        );

        // ...
    }

    // ...
}