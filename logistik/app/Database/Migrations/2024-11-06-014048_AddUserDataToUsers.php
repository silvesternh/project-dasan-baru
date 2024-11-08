<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;

class AddUserDataToUsers extends Migration
{
    /**
     * @var string[]
     */
    private array $tables;

    public function __construct(?Forge $forge = null)
    {
        parent::__construct($forge);

        /** @var \Config\Auth $authConfig */
        $authConfig = config('Auth');
        $this->tables = $authConfig->tables;
    }

    public function up()
    {
        $fields = [
            'nama' => ['type' => 'VARCHAR', 'constraint' => '200', 'null' => false],
            'pangkat' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => false],
            'nrp' => ['type' => 'VARCHAR', 'constraint' => '16', 'null' => false],
            'jabatan' => ['type' => 'VARCHAR', 'constraint' => '150', 'null' => false],
        ];
        $this->forge->addColumn($this->tables['users'], $fields);
    }

    public function down()
    {
        $fields = [
            'nama',
            'pangkat',
            'nrp',
            'jabatan',
        ];
        $this->forge->dropColumn($this->tables['users'], $fields);
    }
}
