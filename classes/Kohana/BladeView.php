<?php defined('SYSPATH') or die('No direct script access.');

use Philo\Blade\Blade;

class Kohana_BladeView extends View
{
    /**
     * @var Blade
     */
    public static $blade = null;

    public static function instance()
    {
        if (!(self::$blade instanceof Blade))
        {
            $views = APPPATH.'views';
            $cache =  Kohana::$cache_dir.DIRECTORY_SEPARATOR.'blade';

            self::$blade = new Blade($views, $cache);
        }
        return self::$blade;
    }

    /**
     * @inheritdoc
     */
    public static function factory($file = NULL, array $data = NULL)
    {
        return new self($file, $data);
    }

    /**
     * @inheritdoc
     */
    public function set_filename($file)
    {
        $this->_file = $file;
        return $file;
    }

    /**
     * @inheritdoc
     */
    protected static function capture($kohana_view_filename, array $kohana_view_data)
    {
        ob_start();

        try
        {
            // Load the view within the current scope
            echo self::instance()->view()
                ->make($kohana_view_filename)
                ->with($kohana_view_data)
                ->with(View::$_global_data)
                ->render();
        }
        catch (Exception $e)
        {
            // Delete the output buffer
            ob_end_clean();

            // Re-throw the exception
            throw $e;
        }

        // Get the captured output and close the buffer
        return ob_get_clean();
    }

    /**
     * @inheritdoc
     */
    public function render($file = NULL)
    {
        if ($file !== NULL)
        {
            $this->set_filename($file);
        }

        if (empty($this->_file))
        {
            throw new View_Exception('You must set the file to use within your view before rendering');
        }

        // Combine local and global data and capture the output
        return self::capture($this->_file, $this->_data);
    }
}