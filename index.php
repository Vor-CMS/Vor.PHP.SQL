<!DOCTYPE html>
<html>
	<head>
		<title>Application Wizard Bootstrap v3.x</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="bootstrap/bootstrap.min.css" rel="stylesheet" />
		<link href="bootstrap/bootstrap-wizard.css" rel="stylesheet" />
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="js/html5shiv-3.7.0.js"></script>
		<script src="js/respond-1.3.0.min.js"></script>
		<![endif]-->
	</head>
	<body style="padding:30px;">

		<a class="btn" href="https://github.com/amoffat/bootstrap-application-wizard">Back to docs</a>
		<button id="open-wizard" class="btn btn-primary">
			Open wizard
		</button>

		<div class="wizard" id="satellite-wizard" data-title="Vor Setup">
    
			<!-- Step 1 Feature Selection -->
			<div class="wizard-card" data-cardname="name">
				<h3>Feature Selection</h3>

        <div class="col-sm-6">
          <div class="wizard-input-section">
            <div class="form-group">
              <div class="col-sm-12">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="feature_2" id="feature_2">
                    <abbr title="Allows you to have a forums system on your website where users can post threads, reply to threads, etc">Forums</abbr>
                  </label>
                </div>
                <br>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="feature_3" id="feature_3">
                    <abbr title="Allows you to put blog posts on your website">Blog system</abbr>
                  </label>
                </div>
                <div class="col-sm-11 col-sm-offset-1" id="feature_3_expand">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1" name="feature_3_1" id="feature_3_1">
                      <abbr title="Allows users to post comments on your blog">Comments</abbr>
                    </label>
                  </div>
                  <br>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1" name="feature_3_2" id="feature_3_2">
                      <abbr title="Whether or not there will be multiple writers on the blog">Multiple Authors</abbr>
                    </label>
                  </div>
                </div>
                <br><div id="blog_br" style="display:none"><br></div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="feature_4" id="feature_4">
                    <abbr title="Allows you and your users to input links to be shrunken and stored">Link Shrinker</abbr>
                  </label>
                </div>
                <div class="col-sm-11 col-sm-offset-1" id="feature_4_expand">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1" name="feature_4_1" id="feature_4_1">
                      <abbr title="Allows you to delete, view, edit shrunken links">Administration</abbr>
                    </label>
                  </div>
                  <br>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1" name="feature_4_2" id="feature_4_2">
                      <abbr title="Track frequency of visits to links">Tracking</abbr>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="wizard-input-section">
            <div class="form-group">
              <div class="col-sm-12">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="feature_1" id="feature_1" data-placement="right" data-content="Another system needs this">
                    <abbr title="Allows users to create accounts, login, etc">Login System</abbr>
                  </label>
                </div>
                <br>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="feature_6" id="feature_6">
                    <abbr title="Adds AES-compliant encryption to all areas of every selected system">Encryption</abbr>
                  </label>
                </div>
                <br>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="feature_5" id="feature_5">
                    <abbr title="When the system can, it will log all actions to a DB table">Logging</abbr>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
			</div>
    
			<!-- Step 2 Database Connection -->
			<div class="wizard-card" data-cardname="name">
				<h3>Database Connection</h3>

        <div class="col-sm-6">
          <div class="wizard-input-section">
            <p>
              <abbr title="The URL you use to connect to your SQL database (normally 'localhost')">SQL Location</abbr>
            </p>
            
            <div class="form-group">
              <div class="col-sm-12">
                <input type="text" class="form-control" id="db_loc" name="db_loc">
              </div>
            </div>
          </div>

          <br>
          
          <div class="wizard-input-section">
            <p>
              <abbr title="The name of the database you want to use for vor">Database Name</abbr>
            </p>

            <div class="form-group">
              <div class="col-sm-12">
                  <input type="text" class="form-control" id="db_name" name="db_name">
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="wizard-input-section">
            <p>
              <abbr title="The username of your database account">Database Username</abbr>
            </p>

            <div class="form-group">
              <div class="col-sm-12">
                <input type="text" class="form-control" id="db_uname" name="db_uname">
              </div>
            </div>
          </div>

          <br>
          
          <div class="wizard-input-section">
            <p>
              <abbr title="The password of your database account">Database Password</abbr>
            </p>

            <div class="form-group">
              <div class="col-sm-12">
                <input type="password" class="form-control" id="db_pass" name="db_pass">
              </div>
            </div>
          </div>
        </div>
			</div>

			<!-- Step 3 Metadata -->
			<div class="wizard-card" data-cardname="group">
				<h3>Metadata</h3>

        <div class="col-sm-6">
          <div class="wizard-input-section">
            <p>
              <abbr title="The name of your website (example: reddit.com is called 'reddit')">Website Name</abbr>
            </p>
            
            <div class="form-group">
              <div class="col-sm-12">
                <input type="text" class="form-control" id="meta_sitename" name="meta_sitename" placeholder="Website Name">
              </div>
            </div>
          </div>

          <br>
          
          <div class="wizard-input-section">
            <p>
              <abbr title="The simple, base url of your website (you may be setting up vor for 'https://blog.example.com', but the simple domain is 'example.com'">Simple Domain</abbr>
            </p>

            <div class="form-group">
              <div class="col-sm-12">
                  <input type="text" class="form-control" id="meta_simpledomain" name="meta_simpledomain" placeholder="Domain Simple" />
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="wizard-input-section">
            <p>
              <abbr title="The full URL of your domain where vor is being set up (If you're making it on 'https://blog.example.com' put: 'blog.example.com')">Domain Actual</abbr>
            </p>

            <div class="form-group">
              <div class="col-sm-12">
                <input type="text" class="form-control" id="meta_domain" name="meta_domain" placeholder="Domain Actual" />
              </div>
            </div>
          </div>
        </div>
			</div>

			<!-- Step 4 Emails -->
			<div class="wizard-card" data-cardname="services">
				<h3>Email</h3>

        <div class="col-sm-6">
          <div class="wizard-input-section">
            <p>
              <abbr title="The address emails will say they came from (example: 'noreply@example.com')">From Email</abbr>
            </p>
            
            <div class="form-group">
              <div class="col-sm-12">
                <input type="text" class="form-control" id="email_from" name="email_from">
              </div>
            </div>
          </div>
          
          <br>

          <div class="wizard-input-section">
            <p>
              <abbr title="The address you want people to reply to when they reply to your emails (example: 'support@example.com')">Reply Email</abbr>
            </p>

            <div class="form-group">
              <div class="col-sm-12">
                  <input type="text" class="form-control" id="email_reply" name="email_reply">
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="wizard-input-section">
            <p>
              <abbr title="Choose when emails are sent out to users">Email Alerts</abbr>
            </p>

            <div class="form-group">
              <div class="col-sm-12">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="email_checkbox_1" id="email_checkbox_1">
                    When email is updated
                  </label>
                </div>
                <br>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="email_checkbox_2" id="email_checkbox_2">
                    When password is updated
                  </label>
                </div>
                <br>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" name="email_checkbox_3" id="email_checkbox_3">
                    When account is recovered
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>


				<div class="wizard-error">
					<div class="alert alert-error">
						<strong>There was a problem</strong> with your submission.
						Please correct the errors and re-submit.
					</div>
				</div>
	
				<div class="wizard-failure">
					<div class="alert alert-error">
						<strong>There was a problem</strong> submitting the form.
						Please try again in a minute.
					</div>
				</div>
	
				<div class="wizard-success">
					<div class="alert alert-success">
						<span class="create-server-name"></span>Server Created <strong>Successfully.</strong>
					</div>
	
					<a class="btn btn-default create-another-server">Create another server</a>
					<span style="padding:0 10px">or</span>
					<a class="btn btn-success im-done">Done</a>
				</div>
			</div>
		</div>

		<script src="js/jquery-2.0.3.min.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/prettify.js" type="text/javascript"></script>
		<script src="js/bootstrap-wizard.js" type="text/javascript"></script>
    <script src="js/claps.js" type="text/javascript"></script>
    <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/aes.js"></script>
    <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/pbkdf2.js"></script>
		<script type="text/javascript">
      $(document).ready(function() {
        var options = {
          keyboard      : false,
          backdrop      : 'static',
          show          : true,
          showCancel    : false,
          showClose     : false,
          contentHeight : 400,
          contentWidth  : 700
        };
        var wizard = $("#satellite-wizard").wizard(options);
        wizard.show();

        wizard.on('closed', function() {
          wizard.reset();
        });
        
        wizard.on("submit", function(wizard) {
          wizard.submitSuccess();         // displays the success card
          wizard.hideButtons();           // hides the next and back buttons
          
          var form = String(wizard.serialize());
          
          var pattern = "=",
          re = new RegExp(pattern, "g");
          form = form.replace(re, '": "');
          
          var pattern = "&",
          re = new RegExp(pattern, "g");
          form = form.replace(re, '", "');
          
          form = '{"' + form + '"}';
          form = JSON.stringify(form);
          
          var salt = CryptoJS.lib.WordArray.random(128/8); 
          var key  = CryptoJS.PBKDF2(CryptoJS.SHA3("70FC54DD"), salt, { keySize: 256/32, iterations: 500 });
          var iv   = CryptoJS.enc.Hex.parse(CryptoJS.SHA3(form));
          
          var encrypted   = CryptoJS.AES.encrypt(form, key, { iv: iv });  
          var data_base64 = encrypted.ciphertext.toString(CryptoJS.enc.Base64); 
          var iv_base64   = encrypted.iv.toString(CryptoJS.enc.Base64);       
          var key_base64  = encrypted.key.toString(CryptoJS.enc.Base64);
          
          $.ajax({  
            type: "POST",  
            url: "setup.php",  
            data: {cryption:json_string},
            context: document.body,
            async: true,
            success: function(res, stato) {
              try {
                var json_message = CryptoJS.AES.encrypt(res.trim(), key, { iv: iv });
                var jsObject = eval("(" + json_message + ")");
                var msg = jsObject.msg;
              }
              catch(e) {
                console.log(e);
              }
            },
            error : function (richiesta, stato, errori) {  
              var msg = "An error has occured. Call Status: " + stato;  
              console.log(msg);  
            }  
          });
        
        wizard.on("incrementCard", function (wizard) {
          var prevCard = wizard.getActiveCard().prev.title;
          
          if (prevCard == "Feature Selection") {
            //Code here to destroy the setup cards for systems that aren't activated?
          }
        });

				$('#open-wizard').click(function(e) {
					e.preventDefault();
					wizard.show();
				});
        
        var tmp = null;
        var loginChecked = false;
        var forum = false;
        var blog = false;
        var linkShrink = false;
        
        $('#feature_1').popover({
          trigger: 'manual',
          delay: {show:500, hide:300}
        });
        
        $('#feature_1').change(function(){
          if ($('#feature_1').is(':checked')) {
            loginChecked = true;
          }
          else {
            loginChecked = false;
          }
          
          if (forum || blog || linkShrink) { //You have to have the login system if you have some other systems
            $('#feature_1').prop('checked', true);
            
            $('#feature_1').popover('show'); //Notify the user of their mistake
            tmp = setTimeout(function(){$('#feature_1').popover('hide')}, 2500);
          }
        });
        
        $('#feature_2').change(function(){
          if ($('#feature_2').is(':checked')) {
            forum = true;
            $('#feature_1').prop('checked', true);
          } else {
            forum = false;
            
            if (!loginChecked && !blog && !linkShrink) {
              $('#feature_1').prop('checked', false);
            }
          }
        });
        
        claps.hide('#feature_3_expand');//$('#feature_3_expand').toggle();
        $('#feature_3').change(function(){
          if ($('#feature_3').is(':checked')) {
            blog = true;
            $('#feature_1').prop('checked', true);
            claps.show('#feature_3_expand');//$('#feature_3_expand').toggle();
            claps.show("#blog_br");
          } else {
            blog = false;
            claps.hide('#feature_3_expand');//$('#feature_3_expand').toggle();
            claps.hide('#blog_br');
            $('#feature_3_1').prop('checked', false);
            $('#feature_3_2').prop('checked', false);
            
            if (!loginChecked && !forum && !linkShrink) {
              $('#feature_1').prop('checked', false);
            }
          }
        });
        
        $('#feature_4_expand').toggle();
        $('#feature_4').change(function () {
          if ($('#feature_4').is(':checked')) {
            $('#feature_4_expand').toggle();
          } else {
            linkShrink = false;
            $('#feature_4_expand').toggle();
            $('#feature_4_1').prop('checked', false);
            $('#feature_4_2').prop('checked', false);
            
            if (!loginChecked && !forum && !blog && !linkShrink) {
              $('#feature_1').prop('checked', false);
            }
          }
        });
        
        $('#feature_4_1').change(function () {
          if ($('#feature_4_1').is(':checked')) {
            linkShrink = true;
            $('#feature_1').prop('checked', true);
          } else {
            linkShrink = false;
            
            if (!loginChecked && !forum && !blog) {
              $('#feature_1').prop('checked', false);
            }
          }
        });
      });
		</script>
	</body>
</html>
