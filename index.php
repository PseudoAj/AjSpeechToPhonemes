<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>PseudoAj Speech To Text</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">
	<link href="assets/css/styles.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
		

    <!-- Fonts from Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php"><b>PseudoAj Simple Speech To Text Engine</b></a>
        </div>
      </div>
    </div>

	<div id="headerwrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h1>Click on the speak button and try it out.</h1>
					<form class="form-inline" role="form">
					  <div class="form-group">
					    <!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email address">-->
					  </div>
					  <button id="start_button" onClick="startDictation(event)" class="btn btn-warning btn-lg">Speak</button>
					</form>					
				</div><!-- /col-lg-6 -->
				<!-- /col-lg-6 -->
				  
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /headerwrap -->
    <div class="col-lg-6">
					<h1>Results:</h1>
                    <div id="results">
  <span id="final_span" class="final"></span>
  <span id="interim_span" class="interim"></span>
</div>

                    <div id="renderText"></div>
				</div><!-- /col-lg-6 -->
				
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

 </div>
 
 
<script type="text/javascript">
var final_transcript = '';
var recognizing = false;
 
if ('webkitSpeechRecognition' in window) {
 
  var recognition = new webkitSpeechRecognition();
 
  recognition.continuous = true;
  recognition.interimResults = true;
 
  recognition.onstart = function() {
    recognizing = true;
  };
 
  recognition.onerror = function(event) {
    console.log(event.error);
  };
 
  recognition.onend = function() {
    recognizing = false;
      jQuery.get('getResult.php?text=' + final_transcript, function(data) {
          document.getElementById('renderText').innerHTML = data;
      } )
  };
 
  recognition.onresult = function(event) {
    var interim_transcript = '';
    for (var i = event.resultIndex; i < event.results.length; ++i) {
      if (event.results[i].isFinal) {
        final_transcript += event.results[i][0].transcript;
      } else {
        interim_transcript += event.results[i][0].transcript;
      }
    }
    final_transcript = capitalize(final_transcript);
    final_span.innerHTML = linebreak(final_transcript);
    interim_span.innerHTML = linebreak(interim_transcript);
    
  };
}
 
var two_line = /\n\n/g;
var one_line = /\n/g;
function linebreak(s) {
  return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
}
 
function capitalize(s) {
  return s.replace(s.substr(0,1), function(m) { return m.toUpperCase(); });
}
 
function startDictation(event) {
  if (recognizing) {
    recognition.stop();
    return;
  }
  final_transcript = '';
  recognition.lang = 'en-US';
  recognition.start();
  final_span.innerHTML = '';
  interim_span.innerHTML = '';
}
</script>

	
	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
