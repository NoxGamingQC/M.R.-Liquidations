@extends('layouts.app')
@section('title', trans('general.privacy_policy'))
@section('content')

<div class="col-md-12">
    <h3>{{trans('privacy_policy.introduction')}}</h3>
    <p>{{trans('privacy_policy.introduction_text')}}</p>
</div>
<div class="col-md-12">
    <h3>{{trans('privacy_policy.collection_personal_info')}}</h3>
    <ul>
        <li>{{trans('privacy_policy.firstname')}}</li>
        <li>{{trans('privacy_policy.postal_address')}}</li>
        <li>{{trans('privacy_policy.postal_code')}}</li>
        <li>{{trans('privacy_policy.email')}}</li>
        <li>{{trans('privacy_policy.phone_fax_number')}}</li>
    </ul>
    <p>{{trans('privacy_policy.collection_personal_info_text')}}</p>
</div>
<div class="col-md-12">
    <h3>{{trans('privacy_policy.form_interactivity')}}</h3>
    <p>{{trans('privacy_policy.form_interactivity_text_01')}}</p>
    <ul>
        <li>{{trans('privacy_policy.register_form')}}</li>
        <li>{{trans('privacy_policy.order_form')}}</li>
    </ul>
    <p>{{trans('privacy_policy.form_interactivity_text_02')}}</p>
    <ul>
        <li>{{trans('privacy_policy.order_tracking')}}</li>
        <li>{{trans('privacy_policy.information_ads_offer')}}</li>
        <li>{{trans('privacy_policy.statistics')}}</li>
        <li>{{trans('privacy_policy.contact')}}</li>
    </ul>
    <p>{{trans('privacy_policy.form_interactivity_text_03')}}</p>
    <ul>
        <li>{{trans('privacy_policy.contact')}}</li>
    </ul>
</div>
<div class="col-md-12">
    <h3>{{trans('privacy_policy.right_opposition_withdrawal')}}</h3>
    <p>{{trans('privacy_policy.right_opposition_withdrawal_text_01')}}</p>
    <p>{{trans('privacy_policy.right_opposition_withdrawal_text_02')}}</p>
    <p>{{trans('privacy_policy.right_opposition_withdrawal_text_03')}}</p>
    <p>{{trans('privacy_policy.right_opposition_withdrawal_text_04')}}</p>
    <hr />
    <p>{{trans('privacy_policy.company_postal_code_text')}} :  {{trans('privacy_policy.company_postal_code')}} </p>

    <p>{{trans('privacy_policy.company_email_text')}} :  {{trans('privacy_policy.company_email')}} </p>

    <p>{{trans('privacy_policy.company_phone_text')}} :  {{trans('privacy_policy.company_phone')}} </p>

    <p>{{trans('privacy_policy.company_website_text')}} :   {{trans('privacy_policy.company_website_link')}} </p>
    <hr />
</div>
<div class="col-md-12">
    <h3>{{trans('privacy_policy.access_rights')}}</h3>
    <p>{{trans('privacy_policy.access_rights_text_01')}}</p>
    <p>{{trans('privacy_policy.access_rights_text_02')}}</p>
    <hr />
    <p>{{trans('privacy_policy.company_postal_code_text')}} :  {{trans('privacy_policy.company_postal_code')}} </p>

    <p>{{trans('privacy_policy.company_email_text')}} :  {{trans('privacy_policy.company_email')}} </p>

    <p>{{trans('privacy_policy.company_phone_text')}} :  {{trans('privacy_policy.company_phone')}} </p>

    <p>{{trans('privacy_policy.company_website_text')}} :   {{trans('privacy_policy.company_website_link')}} </p>
    <hr />
</div>
<div class="col-md-12">
    <h3>{{trans('privacy_policy.security')}}</h3>
    <p>{{trans('privacy_policy.security_text_01')}}</p>
    <p>{{trans('privacy_policy.security_text_02')}}</p>
    <ul>
        <li>{{trans('privacy_policy.access_management')}}</li>
        <li>{{trans('privacy_policy.username_password')}}</li>
    </ul>
    <p>{{trans('privacy_policy.security_text_03')}}</p>
</div>
@stop