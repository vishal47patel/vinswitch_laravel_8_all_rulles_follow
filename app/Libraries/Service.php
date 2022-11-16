<?php

namespace App\Libraries;
use App\Models\TenantService;

class Service
{

	public static function service_add($accNum, $referenceno, $name, $desc, $rate=0, $startDate, $order_no, $endDate=NULL) 
	{
		$model = new TenantService;
		$model->account_number = $accNum;
		$model->referenceno = $referenceno;
		$model->name = $name;
		$model->description = $desc;
		$model->start_date = date('Y-m-d',strtotime($startDate));
		$model->order_no = $order_no;
		$model->end_date = $endDate;
		$model->rate = $rate;
	
		if($model->save()){

			return true;
		}	
		
	} 

}

?>