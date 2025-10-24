@extends('layout.landing')
@section('title', 'Home | '.env('APP_NAME'))
@section('content')
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
          <div class="col-md-8 m-auto order-md-1" data-aos="fade">
            <div class="text-left pb-1 border-success mb-4">
              <h2 class="text-info">Our Privacy Policy</h2>
            </div>

            <p>Our privacy policy will help you understand how {{env('APP_NAME')}}, uses and protects the data you provide to us when you visit and use app.</p>
            <p>We reserve the right to change this policy at any given time, of which you will be promptly updated. If you want to make sure that you are up to date with the latest changes, we advise you to frequently visit this page.</p>
            <h3>What User Data We Collect</h3>
            <p>When you use our app, we may collect the following data:</p>
            <ul>
            <li><b>A. LOCATION DATA (Crucial for Service Functionality)</b></li>
            <p>To provide our core logistics services—including tracking loads, assigning drivers, and confirming delivery—we collect precise or approximate location data from your device.</p>
          
            <p><b>Driver Roles:</b> If you are using the app as a driver, we collect your location data continuously while the app is in use and in the background when you are actively assigned to a load, to ensure real-time tracking, safety, and service fulfillment.</p>
            <p><b>Dispatch/Admin Roles</b>: Location data may be collected at the time of login or when using specific features that require geographical context.</p>
            
            <p><b>If you do not consent to the collection and use of your location data, you will be unable to use the core logistics functions of the App.</b></p>
          
            <li><b>B. PERSONAL AND CONTACT DATA</b></li>
            <li>Your name, phone number, and email address.</li>
            <li>Login credentials (encrypted).</li> <br>
            <li><b>C. TECHNICAL AND BEHAVIOURAL DATA</b></li>
            <li>Your device's IP address, operating system information, and device model.</li>
            <li>Data profile regarding your in-app behavior, preferences, and feature usage</li>
            </ul>

            <h3>Why We Collect Your Data</h3>
            We are collecting your data for several reasons:
            <ul>
                <li>To better understand your needs.</li>
                <li>o improve our services and products</li>
                <li>To send you promotional emails containing the information we think you will find interesting.</li>
                <li>To contact you to fill out surveys and participate in other types of market research.</li>
                <li>To customize our app according to your online behaviour and personal preferences.</li>
            </ul>
            <h3>Safeguarding and Securing the Data</h3>
            <p>{{env('APP_NAME')}} is committed to securing your data and keeping it confidential. {{env('APP_NAME')}} Nigeria Limited has done all in its power to prevent data theft, unauthorized access, and disclosure by implementing the latest technologies and software, which help us safeguard all the information we collect online.</p>
            <h3>Restricting the Collection of your Personal Data</h3>
            <p>At some point, you might wish to restrict the use and collection of your personal data. You can achieve this by doing the following:</p>
            <ol>
                <li>When you are filling the forms on our appe, make sure to check if there is a box which you can leave unchecked, if you don't want to disclose your personal information.</li>
                <li>If you have already agreed to share your information with us, feel free to contact us via email and we will be more than happy to change this for you.</li>
            </ol>
            <h3>DISCLOSURE TO THIRD PARTIES</h3>
            <p>{{env('APP_NAME')}} Nigeria Limited will not lease, sell or distribute your personal information to any third parties, unless we have your permission. We might do so if the law forces us. Your personal information will be used when we need to send you promotional materials if you agree to this privacy policy.</p>

            <h3>YOUR DATA CONTROL RIGHT</h3>
            <p>You have the right to control the collection and use of your personal data:</p>
            <ul>
                <li><b>Location Permissions:</b> You can manage or revoke the app's access to your location at any time through your device's operating system settings. (Note: This will disable core app functions.)</li>
                <li><b>Opt-Out:</b> If you have agreed to receive promotional communications from us, you can contact us to opt out, and we will update your preferences.</li>
        
            </ul>

            <p>For more information, you can contact us on support@darllogistics.com</p>


          </div>

        </div>
    </div>
</section>
@endsection
