<head>
<meta charset="UTF-8">
<title>FC - @yield('htmlheader_title', 'Your title here')</title>
<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<!-- Font Awesome -->
<link rel="stylesheet"
	href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet"
	href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<!-- iCheck -->
<link rel="stylesheet"
	href="{{ asset('plugins/iCheck/flat/blue.css') }}">
<!-- Morris chart -->
<link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
<!-- jvectormap -->
<link rel="stylesheet"
	href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
<!-- Date Picker -->
<link rel="stylesheet"
	href="{{ asset('plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet"
	href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet"
	href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
<!-- Google Font: Source Sans Pro -->
<link
	href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"
	rel="stylesheet">
<!-- DataTables -->
<link
	href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"
	rel="stylesheet">
<link
	href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"
	rel="stylesheet">

<!-- Bootstrap Select -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button {
	padding: 0em 0em;
}

.funkyradio div {
	clear: both;
	overflow: hidden;
}

.funkyradio label {
	width: 100%;
	border-radius: 3px;
	border: 1px solid #D1D3D4;
	font-weight: normal;
}

.funkyradio input[type="radio"]:empty, .funkyradio input[type="checkbox"]:empty
	{
	display: none;
}

.funkyradio input[type="radio"]:empty ~ label, .funkyradio input[type="checkbox"]:empty 
	~ label {
	position: relative;
	line-height: 2.5em;
	text-indent: 3.25em;
	margin-top: 0em;
	cursor: pointer;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}

.funkyradio input[type="radio"]:empty ~ label:before, .funkyradio input[type="checkbox"]:empty 
	~ label:before {
	position: absolute;
	display: block;
	top: 0;
	bottom: 0;
	left: 0;
	content: '';
	width: 2.5em;
	background: #D1D3D4;
	border-radius: 3px 0 0 3px;
}

.funkyradio input[type="radio"]:hover:not (:checked ) ~ label,
	.funkyradio input[type="checkbox"]:hover:not (:checked ) ~ label {
	color: #888;
}

.funkyradio input[type="radio"]:hover:not (:checked ) ~ label:before,
	.funkyradio input[type="checkbox"]:hover:not (:checked ) ~ label:before
	{
	content: '\2714';
	text-indent: .9em;
	color: #C2C2C2;
}

.funkyradio input[type="radio"]:checked ~ label, .funkyradio input[type="checkbox"]:checked 
	~ label {
	color: #777;
}

.funkyradio input[type="radio"]:checked ~ label:before, .funkyradio input[type="checkbox"]:checked 
	~ label:before {
	content: '\2714';
	text-indent: .9em;
	color: #333;
	background-color: #ccc;
}

.funkyradio input[type="radio"]:focus ~ label:before, .funkyradio input[type="checkbox"]:focus 
	~ label:before {
	box-shadow: 0 0 0 3px #999;
}

.funkyradio-default input[type="radio"]:checked ~ label:before,
	.funkyradio-default input[type="checkbox"]:checked ~ label:before {
	color: #333;
	background-color: #ccc;
}

.funkyradio-primary input[type="radio"]:checked ~ label:before,
	.funkyradio-primary input[type="checkbox"]:checked ~ label:before {
	color: #fff;
	background-color: #337ab7;
}

.funkyradio-success input[type="radio"]:checked ~ label:before,
	.funkyradio-success input[type="checkbox"]:checked ~ label:before {
	color: #fff;
	background-color: #5cb85c;
}

.funkyradio-danger input[type="radio"]:checked ~ label:before,
	.funkyradio-danger input[type="checkbox"]:checked ~ label:before {
	color: #fff;
	background-color: #d9534f;
}

.funkyradio-warning input[type="radio"]:checked ~ label:before,
	.funkyradio-warning input[type="checkbox"]:checked ~ label:before {
	color: #fff;
	background-color: #f0ad4e;
}

.funkyradio-info input[type="radio"]:checked ~ label:before,
	.funkyradio-info input[type="checkbox"]:checked ~ label:before {
	color: #fff;
	background-color: #5bc0de;
}
</style>

</head>