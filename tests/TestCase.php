<?php

    class TestCase extends Orchestra\Testbench\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
        protected $baseUrl = 'http://localhost:8000';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

        protected function configureDatabase() {

            $db = new DBM;
            $db->addConnection(['driver' => 'sqlite', 'database' => ':memory:', 'charset' => 'utf8', 'collation' => 'utf8_unicode_ci', 'prefix' => '',]);
            $db->bootEloquent();
            $db->setAsGlobal();
        }
}
