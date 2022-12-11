<html moznomarginboxes mozdisallowselectionprint>
    <head>
        <!--<meta charset="utf-8">-->
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>{{$winTitle}}</title>
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en" />
        <!-- <link type="text/css" rel="stylesheet" href="{!! asset('public/css/bootstrap.css') !!}" />
        <link rel="stylesheet" href="{!! asset('public/css/font-awesome.min.css') !!}"> -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style type="text/css">
            <?php
                $table_font = (isset($pdf)) ? '12px' : '12px';
            ?>
            @page {
                margin: 10%;  
            }
            @media print {
                .print_button {
                    display: none !important;
                }
                .voucher {
                    page-break-after: always;
                }
            }
            .print_button {
                position: relative;
                margin:20px auto;
                text-align: center;
                top: 0px;
                padding-right: 0px;
            }
            .voucher {
                width: 700px;
                position: relative;
                margin: 10px auto;
                padding: 15px;
                /*border: 2px solid #666;*/
                margin-bottom: 50px;
            }
            .header {
                text-align: center;
                margin: 5px;
            }
            /*.header p {
                margin-bottom: 4px;
            }*/
            .company_name {
                font-size: 20px;
                margin-bottom: 0;
            }
            .project_name {
                margin: 0 auto 8px;
                font-size: 14px;
                font-weight: bold;
            }
            .address {
                font-size: 14px;
            }
            .contact {
                font-size: 14px;
            }
            .title {
                margin: 0 auto 12px;
                font-size: 16px;
                font-weight: bold;
            }
            .border-none{
                border: 0px!important;
            }
            table td {
                border: none !important;
                font-size: {{$table_font}}
            }
            tbody,td,th {
                font-size: 12px;
                padding: 1px 2px;
            }
            thead td, tfoot td {
                font-weight: bold;
            }
            .particulars {
                width: 100%;
                border: 1px solid #666 !important;
            }
            .particulars td {
                border: 1px solid #666 !important;
            }
            .voucher_footer td {
                text-decoration: overline;
            }

            .txt-normal{
                font-weight:normal!important;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="print_button">
                <button class="btn btn-default" onclick="printDocument()"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                <!-- <a href="#" class="btn btn-default" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a> -->
            </div>