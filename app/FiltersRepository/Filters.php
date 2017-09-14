<?php
namespace App\FiltersRepository;
interface Filters{

    public function filter($ans,$degs,$lim=null,$title);
}