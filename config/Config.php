<?php

// Define DB Params
define("DB_HOST", getenv('DB_HOST'));
define("DB_PORT", getenv('DB_PORT'));
define("DB_USER", getenv('DB_USERNAME'));
define("DB_PASS", getenv('DB_PASSWORD'));
define("DB_NAME", getenv('DB_DATABASE'));

// Define namespaces
define("NS_MAIN",           "DroplineMVC"); // Top-level/vendor namespace
define("NS_CONTROLLERS",    "Controllers");
define("NS_CORE",           "Core");
define("NS_MODELS",         "Models");
define("NS_UTILS",          "Utils");

// Display errors to a user.
define("ERROR_DISPLAY", true);
// Save errors to a file
define("ERROR_FILE",    true);

/**
 * Class MSG
 *
 * Message enumerations.
 */
class MSG {
    const USER_ERROR        = 'msgUserError';
    const USER_SUCCESS      = 'msgUserSuccess';
    const DEVELOPMENT_ERROR = 'msgDevelopmentError';
};

/**
 * Class ModelReturnStatus
 *
 * Model return statuses enumerations.
 */
class ModelReturnStatus {
    const SUCCESS               = 1;
    const FAILURE_GENERAL       = 2;
    const FAILURE_VALIDATION    = 3;
};

// System salt (just for testing algorithms)
// define("HASH_KEY", "23490wefsds45kfkwse234sdf@ert#142508!");