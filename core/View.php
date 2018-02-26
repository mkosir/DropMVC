<?php

namespace DroplineMVC\Core;

/**
 * Class View
 */
class View
{
    /**
     * @param string $viewFolderName
     * @param string $viewFileName
     * @param $data - Pass data into the view
     * @param bool $fullView - include header
     * @throws \Exception
     */
    public static function render(string $viewFolderName, string $viewFileName, $data, bool $fullView)
    {
        $viewFolderName = strtolower($viewFolderName);
        $viewFileName = strtolower($viewFileName);

        $pageTitle = View::getPageTitle($viewFolderName, $viewFileName);

        $viewFile = '../app/views/' . $viewFolderName . '/' . $viewFileName . '.php';
        if (is_readable($viewFile)) {
            if (is_readable('../app/views/_main/main.php')) {
                require('../app/views/_main/main.php');
            } else {
                // File doesn't exists or not readable
                throw new \Exception('File: "/app/views/_main/main.php" does not exists or not readable.', 404);
            }
        } else {
            // File doesn't exists or not readable
            throw new \Exception('File: "' . $viewFile . '" does not exists or not readable.', 404);
        }
    }

    private static function getPageTitle(string $pageFolderName, string $pageFileName)
    {
        $reqPage = $pageFolderName . '/' . $pageFileName;

        switch ($reqPage) {
            // activities
            case 'activities/index':
                return 'DropLine - Activities';
            // drops
            case 'drops/add':
                return 'DropLine - Add new drop';
            case 'drops/index':
                return 'DropLine - Drops';
            // activities
            case 'wordcloud/index':
                return 'DropLine - Word Cloud';
            // error
            case 'error/error404':
                return 'DropLine - Error';
            case 'error/error500':
                return 'DropLine - Error';
            // home
            case 'home/index':
                return 'DropLine';
            // users
            case 'users/login':
                return 'DropLine - Login';
            case 'users/register':
                return 'DropLine - Register';

            default:
                return 'DropLine';
        }
    }
}