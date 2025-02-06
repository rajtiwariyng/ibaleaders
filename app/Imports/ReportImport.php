<?php
namespace App\Imports;

use App\Models\Alliance_roster_report;
use Maatwebsite\Excel\Concerns\ToModel;

class ReportImport implements ToModel
{
    public function model(array $row)
    {
        return new Alliance_roster_report([
            'leader_name'  => $row[0],
            'category' => $row[1],
            'company_name' => $row[2],
            'lvp_score' => $row[3],
            'rg' => $row[4],
            'rr' => $row[5],
            'v' => $row[6],
            'gbr' => $row[7],
            'bg' => $row[8],
            'start_date' => $row[9],
        ]);
    }
}
