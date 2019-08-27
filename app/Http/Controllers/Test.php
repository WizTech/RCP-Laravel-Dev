<?php
/**
 * Created by PhpStorm.
 * User: Arsalan
 * Date: 8/26/2019
 * Time: 12:00 PM
 */

public function store(Requests\UserRequest $request)
{
    $input = $request->all();

    $user = User::create($input);

    if ($user && !empty($input['first_name'])) {

        UserDetails::create([
            'user_id' => $user->id,
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'address' => $input['address'],
            'phone_no' => $input['phone_no']]);
    }

    if ($user && !empty($input['role'] == 3)) {
        LandlordDetails::create([
            'user_id' => $user->id,
            'company' => $input['company'],
            'fax' => $input['fax'],
            'h1' => $input['h1'],

            'h2' => $input['h2'],
            'meta_title' => $input['meta_title'],
            'seo_block' => $input['seo_block'],
            'about_details' => $input['about_details'],
            'meta_description' => $input['meta_description'],
            'email_leads' => $input['email_leads'],
            'landlord_dashboard_status' => $input['landlord_dashboard_status'],
            'website' => $input['website'],
            'free_trial' => $input['free_trial'],
            'free_trial_expiry_date' => $input['free_trial_expiry_date'],
            'type' => $input['type'],
            'activate_twilio' => $input['activate_twilio'],
            'twilio_number' => $input['twilio_number'],
            'is_entrata' => $input['is_entrata'],
            'entrata_client_id' => $input['entrata_client_id'],
            'is_yardi' => $input['is_yardi'],
            'yardi_user_id' => $input['yardi_user_id'],

            'emma_trial_landlord' => $input['emma_trial_landlord'],
            'email_type' => $input['email_type'],
            'rent_style' => $input['rent_style'],
            'lease_singing_options' => $input['lease_singing_options'],
            'landlord_website' => $input['landlord_website']

            ]);

    }

    if ($user && !empty($input['campus_id'])) {

        $campusId = $input['campus_id'];
        UserCampuses::create(['user_id' => $user->id, 'campus_id' => $campusId]);

        /*$campusIds = $input['campus_id'];
        foreach ($campusIds as $campId) {
            if ($campId):
                UserCampuses::create(['user_id' => $user->id, 'campus_id' => $campId]);
            endif;
        }*/

    }

    return redirect('rcpadmin/users');

}