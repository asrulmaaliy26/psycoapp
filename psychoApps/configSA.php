<?php
// ============================================================
// configSA.php — Konfigurasi Super Admin
// Ganti SA_PASS_HASH dengan: password_hash('PASSWORD_ANDA', PASSWORD_DEFAULT)
// ============================================================

define('SA_USERNAME', 'superadmin');
define('SA_PASS_HASH', '$2y$10$ykeiZypSJntGrged.IZi4O6yj7dMJJzxnzxjRt1dwiJnDRVBKcVaH.'); // password: superadmin123

// Role definitions: key → konfigurasi
function sa_roles(): array
{
    return [
        'admin_bak_s1' => [
            'label'       => 'Admin BAK S1',
            'icon'        => '🏛️',
            'module'      => 'psychoApps',
            'redirect'    => 'dashboardAdmBakS1.php',
            'session_set' => ['username' => '{val}', 'status' => '1'],
            'db_table'    => 'dt_all_adm',
            'db_val'      => 'username',
            'db_label'    => "CONCAT(username, ' — ', nm_person)",
            'db_search'   => ['username', 'nm_person'],
        ],
        'admin_bak_s2' => [
            'label'       => 'Admin BAK S2',
            'icon'        => '🎓',
            'module'      => 'simagis',
            'redirect'    => '../simagis/dashboardAdm.php',
            'session_set' => ['username' => '{val}', 'status' => '1'],
            'db_table'    => 'dt_all_adm',
            'db_val'      => 'username',
            'db_label'    => "CONCAT(username, ' — ', nm_person)",
            'db_search'   => ['username', 'nm_person'],
        ],
        'mahasiswa_s1' => [
            'label'       => 'Mahasiswa S1',
            'icon'        => '🧑‍🎓',
            'module'      => 'psychoApps',
            'redirect'    => 'dashboardUserS1.php',
            'session_set' => ['username' => '{val}', 'status' => '1'],
            'db_table'    => 'dt_mhssw',
            'db_val'      => 'nim',
            'db_label'    => "CONCAT(nim, ' — ', nama)",
            'db_search'   => ['nim', 'nama'],
        ],
        'mahasiswa_s2' => [
            'label'       => 'Mahasiswa S2',
            'icon'        => '🧑‍🎓',
            'module'      => 'simagis',
            'redirect'    => '../simagis/dashboardUser.php',
            'session_set' => ['nim' => '{val}', 'username' => '{val}', 'status' => '1'],
            'db_table'    => 'mag_dt_mhssw_pasca',
            'db_val'      => 'nim',
            'db_label'    => "CONCAT(nim, ' — ', nama)",
            'db_search'   => ['nim', 'nama'],
        ],
        'dosen' => [
            'label'       => 'Dosen',
            'icon'        => '👨‍🏫',
            'module'      => 'psychoApps',
            'redirect'    => 'dashboardBeritaAcaraSempro.php',
            'session_set' => ['username' => '{val}', 'status' => '1'],
            'db_table'    => 'dt_pegawai',
            'db_val'      => 'nip',
            'db_label'    => "CONCAT(nip, ' — ', nama)",
            'db_search'   => ['nip', 'nama'],
        ],
        'admin_kepeg' => [
            'label'       => 'Admin Kepegawaian',
            'icon'        => '👤',
            'module'      => 'psychoApps',
            'redirect'    => 'dashboardAdmKepeg.php',
            'session_set' => ['username' => '{val}', 'status' => '1'],
            'db_table'    => 'dt_all_adm',
            'db_val'      => 'username',
            'db_label'    => "CONCAT(username, ' — ', nm_person)",
            'db_search'   => ['username', 'nm_person'],
        ],
        'admin_bmn' => [
            'label'       => 'Admin BMN',
            'icon'        => '🏢',
            'module'      => 'psychoApps',
            'redirect'    => 'dashboardAdmBmn.php',
            'session_set' => ['username' => '{val}', 'status' => '1'],
            'db_table'    => 'dt_all_adm',
            'db_val'      => 'username',
            'db_label'    => "CONCAT(username, ' — ', nm_person)",
            'db_search'   => ['username', 'nm_person'],
        ],
        'admin_taper' => [
            'label'       => 'Admin Tata Persuratan',
            'icon'        => '📄',
            'module'      => 'psychoApps',
            'redirect'    => 'dashboardAdm.php',
            'session_set' => ['username' => '{val}', 'status' => '1'],
            'db_table'    => 'dt_all_adm',
            'db_val'      => 'username',
            'db_label'    => "CONCAT(username, ' — ', nm_person)",
            'db_search'   => ['username', 'nm_person'],
        ],
    ];
}
