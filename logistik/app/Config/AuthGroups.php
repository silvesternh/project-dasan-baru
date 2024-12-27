<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'admin';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * An associative array of the available groups in the system, where the keys
     * are the group names and the values are arrays of the group info.
     *
     * Whatever value you assign as the key will be used to refer to the group
     * when using functions such as:
     *      $user->addGroup('superadmin');
     *
     * @var array<string, array<string, string>>
     *
     * @see https://codeigniter4.github.io/shield/quick_start_guide/using_authorization/#change-available-groups for more info
     */
    public array $groups = [
        'admin' => [
            'title' => 'Admin',
            'description' => 'Day to day administrators of the site.',
        ],
        'karolog' => [
            'title' => 'Karolog',
            'description' => 'Kepala Biro Logistik.',
        ],
        'pal' => [
            'title' => 'Bagpal',
            'description' => 'Biro Peralatan.',
        ],
        'renmin' => [
            'title' => 'Subbagrenmin',
            'description' => 'Bagian Perencanaan & Administrasi.',
        ],
        'faskon' => [
            'title' => 'bagfaskon',
            'description' => 'Biro Fasilitas & Konstruksi.',
        ],
        'ada' => [
            'title' => 'Bagada',
            'description' => 'Biro Pengadaan Barang/Jasa.',
        ],
        'bekum' => [
            'title' => 'Bagbekum',
            'description' => 'Biro Perbekalan Umum.',
        ],
        'gudang' => [
            'title' => 'Gudang',
            'description' => 'Gudang.',
        ],
        'infolog' => [
            'title' => 'Infolog',
            'description' => 'infolog.',
        ],
        'sipil' => [
            'title' => 'Sipil',
            'description' => 'Masyarakat Sipil/Kontraktor.',
        ],
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system.
     *
     * If a permission is not listed here it cannot be used.
     */
    public array $permissions = [
        'admin.access' => 'Dapat Mengakses seluruh situs',
        'karolog.access' => 'Dapat mengakses seluruh situs terkecuali bagian admin dan user',
        'pal.access' => 'Dapat mengakses halaman pal',
        'renmin.access' => 'Dapat mengakses halaman renmin',
        'faskon.access' => 'Dapat mengakses halaman faskon',
        'ada.access' => 'Dapat mengakses halaman ada',
        'bekum.access' => 'Dapat mengakses halaman bekum',
        'gudang.access' => 'Dapat mengakses halaman gudang',
        'infolog.access' => 'Dapat mengakses halaman infolog',
        'sipil.access' => 'Dapat mengakses halaman sipil',
        'user.access' => 'Dapat mengakses halaman user',
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     *
     * This defines group-level permissions.
     */
    public array $matrix = [
        'admin' => [
            'admin.access',
            'pal.access',
            'renmin.access',
            'faskon.access',
            'ada.access',
            'bekum.access',
            'gudang.access',
            'infolog.access',
            'sipil.access',
            'user.access',
        ],
        'karolog' => [
            'pal.access',
            'renmin.access',
            'faskon.access',
            'ada.access',
            'bekum.access',
            'gudang.access',
            'infolog.access',
        ],
        'pal' => [
            'pal.access',
        ],
        'renmin' => [
            'renmin.access',
        ],
        'faskon' => [
            'faskon.access',
        ],
        'ada' => [
            'ada.access',
        ],
        'bekum' => [
            'bekum.access',
        ],
        'gudang' => [
            'gudang.access',
        ],
        'infolog' => [
            'infolog.access',
        ],
    ];
}
