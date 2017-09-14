<?php
/**
 * Created by PhpStorm.
 * User: ITC
 * Date: 8/31/2017
 * Time: 2:37 PM
 */

namespace App\FiltersRepository;


class ReportFilters
{
    public function fil(Filters $filter,$ans,$degs,$lim=null,$title){
      return $filter->filter($ans,$degs,$lim,$title);
    }
}