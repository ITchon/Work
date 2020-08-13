<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?php echo base_url('') ?>assets/img/logo.jpg" type="image/icon type">
    <title>Drawing Center </title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description" content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta property="og:url" content="http://demo.madebytilde.com/elephant">
    <meta property="og:type" content="website">
    <meta property="og:title" content="The fastest way to build Modern Admin APPS for any platform, browser, or device.">
    <meta property="og:description" content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta property="og:image" content="http://demo.madebytilde.com/elephant.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@madebytilde">
    <meta name="twitter:creator" content="@madebytilde">
    <meta name="twitter:title" content="The fastest way to build Modern Admin APPS for any platform, browser, or device.">
    <meta name="twitter:description" content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta name="twitter:image" content="http://demo.madebytilde.com/elephant.jpg">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">

    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#0288d1">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">

    <link rel="stylesheet" href="<?php echo base_url().'assets/css/vendor.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/elephant.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/login-3.min.css';?>">
  </head>
  <body>
    <div class="login">
      <div class="login-body">
        <a class="login-brand" href="index.html">
         
        </a>
        <h3 class="login-heading">Sign in</h3>
        <div class="login-form">  
        
          <form data-toggle="md-validator" action="<?php echo base_url()?>Login/chklogin" method="post">
          <?php echo $this->session->flashdata("success"); ?>            
            <div class="md-form-group md-label-floating">
              <input class="md-form-control" type="text" name="username" spellcheck="false" autocomplete="off" data-msg-required="Please enter your username." required>
              <label class="md-control-label">Username</label>
            </div>
            <div class="md-form-group md-label-floating">
              <input class="md-form-control" type="password" name="password" autocomplete="off" minlength="4" data-msg-minlength="Password must be 6 characters or more." data-msg-required="Please enter your password." required>
              <label class="md-control-label">Password</label>
            </div>
            <div class="md-form-group md-custom-controls">
            </div>
            <button class="btn btn-primary btn-block" type="submit">Sign in</button>
          </form>
        </div>
      </div>
    </div>
    <script src="<?php echo base_url().'assets/js/vendor.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/elephant.min.js'?>"></script>
    <script>
      console.log("55");
        $(".hide-it").fadeOut(5000);
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-83990101-1', 'auto');
      ga('send', 'pageview');
      
    </script>
  </body>
</html>