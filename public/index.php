<?php
define('ROOT_DIR', realpath(__DIR__ . '/..'));

$config = json_decode(file_get_contents(ROOT_DIR . '/config.json'), true);

if (!isset($_GET['key']) || $config['key'] !== $key = (string)$_GET['key']) {
    header('HTTP/1.0 403 Forbidden');
    die();
}

header('Content-Type: text/plain; charset=utf-8');

isset($_FILES['war']['error']) && !is_array($_FILES['war']['error']) || die("Invalid parameters.");
switch ($_FILES['war']['error']) {
    case UPLOAD_ERR_OK:
        break;
    case UPLOAD_ERR_NO_FILE:
        die("No file sent.");
    case UPLOAD_ERR_INI_SIZE:
    case UPLOAD_ERR_FORM_SIZE:
        die("Exceeded filesize limit.");
    default:
        die("Weird error.");
}
move_uploaded_file($_FILES['war']['tmp_name'],
        $f = sprintf('%s/wars/aurora_%s.war', ROOT_DIR, sha1_file($_FILES['war']['tmp_name'])))
        || die("Failed to move uploaded file.");

passthru(sprintf('bash %s %s %s 2>&1',
        escapeshellarg(ROOT_DIR . '/unpackr.sh'),
        escapeshellarg($f),
        escapeshellarg($config['target'])));

die("Great success!");
