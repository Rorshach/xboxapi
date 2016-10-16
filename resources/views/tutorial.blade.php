@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Tutorial</div>
                <div class="panel-body">
                    <div class="text-center">
                        <h4><strong>Tutorial</strong></h4>
                        <h4>How to obtain an Xbox API Key</h4>
                        <p>So You're here because you have no idea what's going on, what is an Xbox API Key? How do I get one? Well hopefully this tutorial or guide being accomponies with images will help you get one </p>
                        <hr>
                        <h4>Step 1.</h4>
                        <p>Assuming you're at the <a href='/user'>user page</a> you should first click on the green <a href="http://xboxapi.com/profile" target="_blank">'Get API Key'</a> which will open up the page where you will get your Key</p>
                        <img src="http://i.imgur.com/M3CO2pl.png" alt="Responsive image" class="img-responsive img-thumbnail center-block">
                        <br>
                        <hr>
                        <h4>Step 2.</h4>
                        <p>You will be prompted the Login Page, Click on the <a target="_blank" href="https://xboxapi.com/register">Register</a> blue button</p>
                        <img src="http://i.imgur.com/1pyTdf9.png" alt="Responsive image" class="img-responsive img-thumbnail center-block">
                        <hr>
                        <br>
                        <h4>Step 3.</h4>
                        <p>Fill in the registration form, make sure to set the Subscription plan to Free. Username - whatever you want, Email - Which ever you want</p>
                        <img src="http://i.imgur.com/TfJjSXu.png" alt="Responsive image" class="img-responsive img-thumbnail center-block">
                        <hr>
                        <br>
                        <h4>Step 4.</h4>
                        <p>Once you fill in and submit the registration form properly you will get an email with an activation link. Click on the activation link and you will be redirected to the next step</p>
                        <img src="http://i.imgur.com/Q7fWgCE.png" alt="Responsive image" class="img-responsive img-thumbnail center-block">
                        <hr>
                        <br>
                        <h4>Step 5.</h4>
                        <p>You're almost at the final stage, Click on "sign in to Xbox LIVE" and follow their instructions</p>
                        <img src="http://i.imgur.com/r7qVjEj.png" alt="Responsive image" class="img-responsive img-thumbnail center-block">
                        <hr>
                        <br>
                        <h4>Step 6.</h4>
                        <p>You're almost at the final stage, Click on "sign in to Xbox LIVE" and follow their instructions</p>
                        <img src="http://i.imgur.com/r7qVjEj.png" alt="Responsive image" class="img-responsive img-thumbnail center-block">
                        <hr>
                        <br>
                        <h4>Step 6.5</h4>
                        <p>Login either through filling in the red boxes, or click on the blue box. Either way works</p>
                        <img src="http://i.imgur.com/QChTqz4.png" alt="Responsive image" class="img-responsive img-thumbnail center-block">
                        <hr>
                        <br>
                        <h4>Step 7</h4>
                        <p>You should have obtained the Xbox API key by now, copy the key from http://xboxapi.com into http://xblmessenger.herokuapp.com/user. Then Click Update</p>
                        <img src="http://i.imgur.com/BAOtpOY.png" alt="Responsive image" class="img-responsive img-thumbnail center-block">
                        <br>
                        <h4>Finally</h4>
                        <p>It's done, your Xbox API Key is now filled in. You can now send messages to 60 recent players every 24 hours</p>
                        <img src="http://i.imgur.com/nUe4DK8.png" alt="Responsive image" class="img-responsive img-thumbnail center-block">
                        <br>
                        <h4>Final Few Words</h4>
                        <p>If you encounter any problems, please contact <a target="_blank" href="https://account.xbox.com/en-us/profile?gamerTag=cog%20integrity">COG Integrity</a> on Xbox Live.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
