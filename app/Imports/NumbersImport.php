<?php

namespace App\Imports;

use App\Models\DidNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;

class NumbersImport implements ToModel, WithHeadingRow, WithUpsertColumns
{
    /**
     * @param array $row
    
     */
    // public function model(array $row, array $request)
    private $rows = 0;
    
    public function upsertColumns()
    {
        return ['number_did'];
    }
    public function model(array $row)
    {
        $request = request();
        ++$this->rows;           
            return new DidNumber([
                "number_did" => $row['number'],
                "number_service_type" => (isset($request->number_service_type) && !empty($request->number_service_type)) ? $request->number_service_type : '',
                "number_channel_limit" => (isset($request->number_channel_limit) && !empty($request->number_channel_limit)) ? $request->number_channel_limit : '',
                "number_country" => (isset($request->number_country) && !empty($request->number_country)) ? $request->number_country : '',
                "number_state" => (isset($request->number_state) && !empty($request->number_state)) ? $request->number_state : '',
                "number_area" => (isset($request->number_area) && !empty($request->number_area)) ? $request->number_area : '',
                "number_description" => (isset($request->number_description) && !empty($request->number_description)) ? $request->number_description : '',
                "sms_capable" => (isset($request->sms_capable) && !empty($request->sms_capable) && $request->sms_capable == 'YES') ? 'YES' : 'NO'
            ]);
        
    }

    // count imported row
    public function getRowCount(): int
    {
        return $this->rows;
    }    
}
