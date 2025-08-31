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

            <p>Our privacy policy will help you understand how {{env('APP_NAME')}} Nigeria Limited, owners of LGTI App uses and protects the data you provide to us when you visit and use app.</p>
            <p>We reserve the right to change this policy at any given time, of which you will be promptly updated. If you want to make sure that you are up to date with the latest changes, we advise you to frequently visit this page.</p>
            <h3>What User Data We Collect</h3>
            <p>When you use our app, we may collect the following data:</p>
            <ul>
            <li>Your IP address</li>
            <li>Your contact information and email address</li>
            <li>Other information such as interests and preferences.</li>
            <li>Data profile regarding your online behaviour on our app.</li>
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
            <p>{{env('APP_NAME')}} Nigeria Limited will not lease, sell or distribute your personal information to any third parties, unless we have your permission. We might do so if the law forces us. Your personal information will be used when we need to send you promotional materials if you agree to this privacy policy.</p>

            <p>For more information, you can contact us on support@darllogistics.com</p>


          </div>

        </div>
    </div>
</section>
@endsection
