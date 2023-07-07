<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{!! config('app.name') !!}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet" />
</head>
<body>
<table id="main" width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#F9F9F9" style="font-family: 'Open Sans', sans-serif;">
    <tbody>
    <tr>
        <td valign="top">
            <table class="innermain" cellpadding="0" width="620" cellspacing="0" border="0" bgcolor="#F9F9F9" align="center" style="margin:0 auto;table-layout:fixed">
                <tbody>
                <tr>
                    <td colspan="4">

                        <table class="m_logo" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tbody>

                            <tr><td height="50px"></td></tr>

                            </tbody>
                        </table>
                        <table class="m_logo" width="100%" cellpadding="0" cellspacing="0" border="0" background="{!! asset('assets/front/email-images/Ferma-mail_bg.jpg') !!}">
                            <tbody>

                            <tr><td height="170px" align="center"></td></tr>
                            <tr>
                                <td height="45px" align="center">
                                    <table width="90%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-width:1px;border-color:#efefef;border-style:solid;border-bottom-width:0px;"><tbody><tr><td height="45px"></td></tr></tbody></table>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                        @yield('content')

                        <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="" style="background: url({{asset('assets/front/email-images/footer-bg.jpg')}}) no-repeat center bottom;">
                            <tbody>
                            <tr>
                                <td height="50px" align="center">
                                    <table width="90%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-width:1px;border-color:#efefef;border-style:solid;border-top-width:0px;"><tbody><tr><td height="50px"></td></tr></tbody></table>
                                </td>
                            </tr>
                            <tr><td height="50"></td></tr>
                            <tr>
                                {{-- <td valign="middle" align="center" style="padding-left:30px;padding-right:30px">
                                    <a href="{!! Config::get('settings.facebook_url') !!}" style="width:30px;height:26px;margin:0 5px;display:inline-block;"><img src="{{asset('assets/front/email-images/facebook-logo.png')}}" alt="facebook" width="24"></a>
                                    <a href="{!! Config::get('settings.twitter_url') !!}" style="width:30px;height:26px;margin:0 5px;display:inline-block;"><img src="{{asset('assets/front/email-images/twitter-logo.png')}}" alt="Twitter" width="24"></a>
                                    <a href="{!! Config::get('settings.instagram_url') !!}" style="width:30px;height:26px;margin:0 5px;display:inline-block;"><img src="{{asset('assets/front/email-images/instagram.png')}}" alt="Instagram" width="24"></a>
                                </td> --}}
                            </tr>
                            {{-- <tr><td valign="middle" align="center" style="font-size: 14px;line-height: 26px;color: #fff;padding-left:30px;padding-right:30px">{!! Config::get('settings.telephone_number') !!}</td></tr>
                            <tr><td valign="middle" align="center" style="font-size: 14px;line-height: 26px;color: #fff;padding-left:30px;padding-right:30px">{!! Config::get('settings.contact_email') !!}</td></tr>
                            <tr><td height="50"></td></tr> --}}
                            </tbody>
                        </table>

                    </td>
                </tr>

                </tbody>
            </table>


            <table width="100%" cellpadding="0" cellspacing="0" border="0">

                <tbody>

                <tr><td height="10">&nbsp;</td></tr>
                <!--<tr><td valign="top" align="center"><span style="color:#333;font-size:12px">© <a href="#" style="color:#0c8099;font-weight: 500; font-size:12px;text-decoration:none;">Fairmont Marina Project</a> 2017</span></td></tr>-->
                <tr><td height="50">&nbsp;</td></tr>

                </tbody>
            </table>

        </td>

    </tr>

    </tbody>

</table>
</body>
</html>
