<?php

namespace Allex;

class Textdomain extends Abstract_Service
{
    /**
     * @var string
     */
    protected $locale;

    /**
     * TextDomain constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);

        $this->locale = get_locale();
    }

    /**
     * Load the framework's text domain.
     */
    public function load()
    {
        $mo_file = __DIR__ . 'languages/allex-' . $this->locale . '.mo';

        if (file_exists($mo_file)) {
            load_textdomain('allex', $mo_file);
        }
    }
}
