<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleAdministrateur extends Model
{
    protected $table = 'administrateur'; 
    protected $primaryKey = 'identifiant';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $allowedFields = ['identifiant', 'motdepasse', 'profil'];
}