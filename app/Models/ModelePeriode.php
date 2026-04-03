<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelePeriode extends Model
{
    protected $table = 'periode'; 
    protected $primaryKey = 'noperiode';
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; 
    protected $allowedFields = ['datedebut','datefin'];
}