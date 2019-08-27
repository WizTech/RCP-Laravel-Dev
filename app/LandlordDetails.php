<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class LandlordDetails extends Model
{
    protected $table = 'landlord_details';
    protected $fillable = [
        'user_id', 'is_yardi', 'is_entrata', 'h1', 'h2', 'fax', 'company',
        'free_trial', 'type', 'website', 'meta_title', 'about_details',
        'meta_details', 'domain_name', 'meta_description', 'seo_block',
        'email_leads', 'landlord_dashboard_status', 'activate_twilio',
        'twilio_number', 'free_trial_expiry_date', 'emma_trial_landlord',
        'email_type', 'rent_style', 'lease_singing_options', 'landlord_website', 'landlord_website_link'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
