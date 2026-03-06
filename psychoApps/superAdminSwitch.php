<?php

/**
 * superAdminSwitch.php — AJAX handler ganti role
 * Menerima POST: role, val
 * Return JSON: { redirect } atau { error }
 */
include 'conAdm.php';
require_once 'configSA.php';
header('Content-Type: application/json');

if (empty($_SESSION['is_superadmin'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$role = $_POST['role'] ?? '';
$val  = trim($_POST['val'] ?? '');
$roles = sa_roles();

if (!isset($roles[$role]) || $val === '') {
    echo json_encode(['error' => 'Role atau nilai tidak valid']);
    exit;
}

$cfg = $roles[$role];

// Set session vars yang dipakai target role
foreach ($cfg['session_set'] as $sKey => $sVal) {
    $_SESSION[$sKey] = str_replace('{val}', $val, $sVal);
}

// Handle extra_session_query: ambil field tambahan dari DB (contoh: nama_s2 dari mag_dt_mhssw_pasca)
if (!empty($cfg['extra_session_query'])) {
    $eq      = $cfg['extra_session_query'];
    $eTable  = mysqli_real_escape_string($con, $eq['table']);
    $eValCol = mysqli_real_escape_string($con, $eq['val_col']);
    $eLblCol = mysqli_real_escape_string($con, $eq['label_col']);
    $eVal    = mysqli_real_escape_string($con, $val);
    $eResult = mysqli_query($con, "SELECT `$eLblCol` FROM `$eTable` WHERE `$eValCol` = '$eVal' LIMIT 1");
    if ($eResult && $eRow = mysqli_fetch_assoc($eResult)) {
        $_SESSION[$eq['session_key']] = $eRow[$eq['label_col']];
    }
}

// Simpan info SA (jangan hapus flag SA)
$_SESSION['is_superadmin']  = true;
$_SESSION['sa_role_active'] = $role;
$_SESSION['sa_role_label']  = $cfg['label'];

echo json_encode(['redirect' => $cfg['redirect']]);
