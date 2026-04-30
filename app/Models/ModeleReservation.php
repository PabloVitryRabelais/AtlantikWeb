<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleReservation extends Model
{
    protected $table = 'reservation'; 
    protected $primaryKey = 'noreservation';
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; 
    protected $allowedFields = ['notraversee','noclient', 'dateheure', 'montanttotal', 'paye', 'modereglement'];
}