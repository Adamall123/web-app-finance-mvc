<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config
{

    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'localhost';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'web_app_finance_mvc';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'root';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = '';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = false;

    const SECRET_KEY = 'RaHAruH7YLdiQVmoHLuRAvosFCCGd2mp';

    //const SENDGRID_API_KEY = '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';
    const SENDGRID_API_KEY = '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';
}
