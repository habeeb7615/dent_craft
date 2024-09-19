<?php

namespace Database\Seeders;

use App\Models\CompanyDetail;
use App\Models\CustomerDetail;
use App\Models\DamagedArea;
use App\Models\Part;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create();

        $daData = [
            ['panel_area_name' => 'Bonnet', 'position' => 'left', 'added_by' => 1],
            ['panel_area_name' => 'Left Front Guard', 'position' => 'left', 'added_by' => 1],
            ['panel_area_name' => 'Left Front Door', 'position' => 'left', 'added_by' => 1],
            ['panel_area_name' => 'Left Rear Door', 'position' => 'left', 'added_by' => 1],
            ['panel_area_name' => 'L.H.R QTR Panel', 'position' => 'left', 'added_by' => 1],
            ['panel_area_name' => 'Left Front Pillar', 'position' => 'left', 'added_by' => 1],
            ['panel_area_name' => 'Left Cant Rail', 'position' => 'left', 'added_by' => 1],
            ['panel_area_name' => 'Left Rear Pillar', 'position' => 'left', 'added_by' => 1],
            ['panel_area_name' => 'Boot/Hatch', 'position' => 'right', 'added_by' => 1],

            ['panel_area_name' => 'R.H.R QTR Panel', 'position' => 'right', 'added_by' => 1],
            ['panel_area_name' => 'Right Rear Door', 'position' => 'right', 'added_by' => 1],
            ['panel_area_name' => 'Right Front Door', 'position' => 'right', 'added_by' => 1],
            ['panel_area_name' => 'Right Front Guard', 'position' => 'right', 'added_by' => 1],
            ['panel_area_name' => 'Right Front Pillar', 'position' => 'right', 'added_by' => 1],
            ['panel_area_name' => 'Right Cant Rail', 'position' => 'right', 'added_by' => 1],
            ['panel_area_name' => 'Right Rear Pillar', 'position' => 'right', 'added_by' => 1],
            ['panel_area_name' => 'Turret', 'position' => 'left', 'added_by' => 1],
        ];

        $paData = [
            ['part_name' => 'Left turret mould', 'position' => 'left', 'unit_price' => random_int(100, 500), 'added_by' => 1],
            ['part_name' => ' Left front door upper mould', 'position' => 'left', 'unit_price' => random_int(100, 500), 'added_by' => 1],
            ['part_name' => 'Left front door belt mould', 'position' => 'left', 'unit_price' => random_int(100, 500), 'added_by' => 1],
            ['part_name' => 'Left rear door upper mould', 'position' => 'left', 'unit_price' => random_int(100, 500), 'added_by' => 1],
            ['part_name' => 'Left rear door belt mould', 'position' => 'left', 'unit_price' => random_int(100, 500), 'added_by' => 1],
            ['part_name' => 'Left rear quarter glass mould', 'position' => 'left', 'unit_price' => random_int(100, 500), 'added_by' => 1],
            ['part_name' => 'Right turret mould', 'position' => 'right', 'unit_price' => random_int(100, 500), 'added_by' => 1],
            ['part_name' => 'Right front door upper mould', 'position' => 'right', 'unit_price' => random_int(100, 500), 'added_by' => 1],
            ['part_name' => 'Right front door belt mould', 'position' => 'right', 'unit_price' => random_int(100, 500), 'added_by' => 1],
            ['part_name' => 'Right rear door upper mould', 'position' => 'right', 'unit_price' => random_int(100, 500), 'added_by' => 1],
            ['part_name' => 'Right rear door belt mould', 'position' => 'right', 'unit_price' => random_int(100, 500), 'added_by' => 1],
            ['part_name' => 'Right rear quarter glass mould', 'position' => 'right', 'unit_price' => random_int(100, 500), 'added_by' => 1],
            ['part_name' => 'Bonnet pad clips', 'position' => 'none', 'unit_price' => random_int(100, 500), 'added_by' => 1],
            ['part_name' => 'Front windscreen mould', 'position' => 'none', 'unit_price' => random_int(100, 500), 'added_by' => 1],
            ['part_name' => 'Rear windscreen mould', 'position' => 'none', 'unit_price' => random_int(100, 500), 'added_by' => 1],
        ];

        foreach ($daData as $datum) {
            $damagedArea = DamagedArea::create($datum);
            // $damagedArea->guards()->attach(random_int(1, 4), [
            //     'panel_cost' => random_int(5, 2000)
            // ]);
        }

        foreach ($paData as $datum) {
            $part = Part::create($datum);
            // $part->quotes()->attach(random_int(1, 12));
        }

        $companyDetail = new CompanyDetail();

        $companyDetail->user_id = 1;
        $companyDetail->company_name = 'Microlent Systems Pvt. Ltd.';
        $companyDetail->abn = '65488879544';
        $companyDetail->mobile_number = '7739947829';
        $companyDetail->email = 'admin@microlent.com';
        $companyDetail->po_box = '98362';
        $companyDetail->gst = 15;
        $companyDetail->check_gst = 1;
        $companyDetail->email_template = '<p>Hello {NAME},</p>

        <p>( {REGISTRATION}) for ({YEAR}/ {MAKE}/{MODEL}) that was assessed on ({DATATIME}). I have included photos of assessed damage and pre-existing condition.<br />
        <br />
        <a href="{ADMIN_URL}/admin/quotations/quotation-summary/{QUOTEID}?email={EMAIL}">Quote Summary</a></p>

        <p><br />
        Regards,<br />
        Dentcraft NSW Pty Ltd</p>';
        $companyDetail->timezone = 'Asia/Kolkata';

        $companyDetail->save();

        if (env('APP_ENV') === 'local') {
            Quote::factory(20)->create();

            foreach ($paData as $datum) {
                // $part = Part::create($datum);
                $part->quotes()->attach(random_int(1, 20));
            }
        }
    }
}
