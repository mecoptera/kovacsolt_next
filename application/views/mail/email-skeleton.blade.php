<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

    <!-- CSS Reset : BEGIN -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
html,
body {
    margin: 0 auto !important;
    padding: 0 !important;
    height: 100% !important;
    width: 100% !important;
    background: #e2e4e8;
}

/* What it does: Stops email clients resizing small text. */
* {
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
}

/* What it does: Centers email on Android 4.4 */
div[style*="margin: 16px 0"] {
    margin: 0 !important;
}

/* What it does: Stops Outlook from adding extra spacing to tables. */
table,
td {
    mso-table-lspace: 0pt !important;
    mso-table-rspace: 0pt !important;
}

/* What it does: Fixes webkit padding issue. */
table {
    border-spacing: 0 !important;
    border-collapse: collapse !important;
    table-layout: fixed !important;
    margin: 0 auto !important;
}

/* What it does: Uses a better rendering method when resizing images in IE. */
img {
    -ms-interpolation-mode:bicubic;
}

/* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
a {
    text-decoration: none;
}

/* What it does: A work-around for email clients meddling in triggered links. */
*[x-apple-data-detectors],  /* iOS */
.unstyle-auto-detected-links *,
.aBn {
    border-bottom: 0 !important;
    cursor: default !important;
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
}

/* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
.a6S {
    display: none !important;
    opacity: 0.01 !important;
}

/* What it does: Prevents Gmail from changing the text color in conversation threads. */
.im {
    color: inherit !important;
}

/* If the above doesn't work, add a .g-img class to any image in question. */
img.g-img + div {
    display: none !important;
}

/* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
/* Create one of these media queries for each additional viewport size you'd like to fix */

/* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
@media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
    u ~ div .email-container {
        min-width: 320px !important;
    }
}
/* iPhone 6, 6S, 7, 8, and X */
@media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
    u ~ div .email-container {
        min-width: 375px !important;
    }
}
/* iPhone 6+, 7+, and 8+ */
@media only screen and (min-device-width: 414px) {
    u ~ div .email-container {
        min-width: 414px !important;
    }
}

    </style>

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

      .primary{
  background: #d53746;
}
.bg_white{
  background: #ffffff;
}
.bg_light{
  background: #f4f4f4;
}
.email-section{
  padding:2.5em;
}

/*BUTTON*/
.btn{
  padding: 5px 15px;
  display: inline-block;
}
.btn.btn-primary{
  background: #d53746;
  color: #ffffff;
}
.btn.btn-black-outline{
  background: transparent;
  border: 2px solid #d53746;
  color: #d53746;
  font-weight: 700;
}

h1,h2,h3,h4,h5,h6{
  font-family: 'Segoe UI', 'Roboto', 'Noto Sans', 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
  color: #000000;
  margin-top: 0;
  font-weight: 400;
}

body{
  font-family: 'Segoe UI', 'Roboto', 'Noto Sans', 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
  font-weight: 400;
  font-size: 15px;
  line-height: 1.8;
  color: #242e42;
}

a{
  color: #d53746;
}

table{
}
/*LOGO*/

.logo h1{
  margin: 1em 0 0;
}

/*HERO*/
.hero{
  position: relative;
  z-index: 0;
}

.hero .text{
  color: rgba(0,0,0,.3);
}
.hero .text h2{
  color: #000;
  font-size: 30px;
  margin-bottom: 0;
  font-weight: 300;
}
.hero .text h2 span{
  font-weight: 600;
  color: #d53746;
}


/*HEADING SECTION*/
.heading-section{
}
.heading-section h2{
  color: #000000;
  font-size: 28px;
  margin-top: 0;
  line-height: 1.4;
  font-weight: 400;
}
.heading-section .subheading{
  margin-bottom: 20px !important;
  display: inline-block;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: rgba(0,0,0,.4);
  position: relative;
}
.heading-section .subheading::after{
  position: absolute;
  left: 0;
  right: 0;
  bottom: -10px;
  content: '';
  width: 100%;
  height: 2px;
  background: #d53746;
  margin: 0 auto;
}

.heading-section-white{
  color: rgba(255,255,255,.8);
}
.heading-section-white h2{
  font-family: 
  line-height: 1;
  padding-bottom: 0;
}
.heading-section-white h2{
  color: #ffffff;
}
.heading-section-white .subheading{
  margin-bottom: 0;
  display: inline-block;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: rgba(255,255,255,.4);
}


ul.social{
  padding: 0;
}
ul.social li{
  display: inline-block;
  margin-right: 10px;
}

/*FOOTER*/

.footer{
  border-top: 1px solid rgba(0,0,0,.05);
  color: rgba(0,0,0,.5);
}
.footer .heading{
  color: #000;
  font-size: 20px;
}
.footer ul{
  margin: 0;
  padding: 0;
}
.footer ul li{
  list-style: none;
  margin-bottom: 10px;
}
.footer ul li a{
  color: rgba(0,0,0,1);
}
    </style>
</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
  <center style="width: 100%; background-color: #e2e4e8;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
      <!-- BEGIN BODY -->
      <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
        <tr>
          <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td align="center">
                  <h1><a href="{{ base_url() }}"><img src="{{ asset('images/logo-full.svg') }}" alt="Kovácsolt póló" style="text-decoration: none;"></a></h1>
                </td>
              </tr>
            </table>
          </td>
        </tr><!-- end tr -->
        <tr>
          <td valign="middle" class="hero hero-2 bg_white" style="padding: 2em 0 2em 0;">
            <table width="100%">
              <tr>
                <td align="center">
                  <div class="text" style="padding: 0 2.5em;">
                    <h2><b>
                      @yield('title')
                    </b></h2>
                  </div>
                </td>
              </tr>
            </table>
          </td>
        </tr><!-- end tr -->
        <tr>
          <td valign="middle" class="bg_white" style="padding: 0 0 4em 0;">
            <table width="100%">
              <tr>
                <td>
                  <div class="text" style="padding: 0 2.5em;">
                    @yield('body')
                  </div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      <!-- 1 Column Text + Button : END -->
      </table>
      <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
        <tr>
          <td style="padding: 0 2.5em; text-align: center; background-color: #f4f4f4;">
            <p>Szeretnél leiratkozni hírlevelünkről és nem értesülni a jobbnál jobb akciókról? Amennyiben igen, akkor <a href="#" style="text-decoration: none; color: #941f2a;">ezen a linken leiratkozhatsz</a>.</p>
          </td>
        </tr>
      </table>

    </div>
  </center>
</body>
</html>

@section('promo')
        <tr>
          <td class="bg_white">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
              <tr>
                <td class="email-section" style="padding: 0; width: 100%; background-color: #f4f4f4;">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <td valign="middle" width="50%">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                          <tr>
                            <td class="text-services" style="text-align: left; padding: 20px 30px;">
                              <div class="heading-section">
                                <h2 style="font-size: 22px;">Pólók tervezése</h2>
                                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                                <p><a href="#" class="btn btn-primary">Tervezz velünk</a></p>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td valign="middle" width="50%">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                          <tr>
                            <td>
                              <img src="https://images.unsplash.com/photo-1503342452485-86b7f54527ef?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="" style="width: 100%; max-width: 600px; height: auto; margin: auto; display: block;">
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr><!-- end: tr -->
              <tr>
                <td class="email-section" style="padding: 0; width: 100%; background-color: #f4f4f4;">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                      <td valign="middle" width="50%">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                          <tr>
                            <td>
                              <img src="https://images.unsplash.com/photo-1580828343064-fde4fc206bc6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1351&q=80" alt="" style="width: 100%; max-width: 600px; height: auto; margin: auto; display: block;">
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td valign="middle" width="50%">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                          <tr>
                            <td class="text-services" style="text-align: left; padding: 20px 30px;">
                              <div class="heading-section">
                                <h2 style="font-size: 22px;">Állandó akciók</h2>
                                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                                <p><a href="#" class="btn btn-primary">Akciók megtekintése</a></p>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr><!-- end: tr -->
            </table>
          </td>
        </tr><!-- end:tr -->
@endsection

@section('social')
        <tr>
          <td valign="middle" class="bg_white footer">
            <table>
              <tr style="text-align: left;">
                <td valign="middle" style="padding-top: 20px; text-align: center;">
                  <h3 class="heading" style="margin: 0;">Kövess minket social media platformokon is!</h3>
                </td>
              </tr>
              <tr>
                <td valign="middle" style="padding-top: 20px; text-align: center;">
                  <ul class="social">
                    <li>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32" fill="none"><path fill="#d53746" d="M30 7.68c-1.03.47-2.14.77-3.3.92a5.75 5.75 0 0 0 2.52-3.19 11.56 11.56 0 0 1-3.64 1.41 5.74 5.74 0 0 0-9.8 5.23c-4.76-.24-9-2.53-11.83-6-.5.85-.77 1.84-.77 2.88 0 2 1 3.77 2.55 4.77-.95 0-1.83-.27-2.6-.67v.04a5.75 5.75 0 0 0 4.6 5.64 5.65 5.65 0 0 1-2.58.09 5.73 5.73 0 0 0 5.35 3.99A11.4 11.4 0 0 1 2 25.17a16.25 16.25 0 0 0 8.8 2.58c10.55 0 16.35-8.75 16.35-16.34l-.01-.75c1.12-.8 2.08-1.82 2.86-2.98z"></path></svg>
                    </li>
                    <li>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32" fill="none"><path fill="#d53746" d="M23 2v5.6h-2.8c-.97 0-1.4 1.13-1.4 2.1v3.5H23v5.6h-4.2V30h-5.6V18.8H9v-5.6h4.2V7.6A5.6 5.6 0 0 1 18.8 2H23z"></path></svg>
                    </li>
                    <li>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32" fill="none" ><path fill="#d53746" d="M10.12 2h11.76A8.13 8.13 0 0 1 30 10.12v11.76A8.12 8.12 0 0 1 21.88 30H10.12A8.13 8.13 0 0 1 2 21.88V10.12A8.12 8.12 0 0 1 10.12 2zm-.28 2.8A5.04 5.04 0 0 0 4.8 9.84v12.32a5.04 5.04 0 0 0 5.04 5.04h12.32a5.04 5.04 0 0 0 5.04-5.04V9.84a5.04 5.04 0 0 0-5.04-5.04H9.84zm13.51 2.1a1.75 1.75 0 1 1 0 3.5 1.75 1.75 0 0 1 0-3.5zM16 9a7 7 0 1 1 0 14 7 7 0 0 1 0-14zm0 2.8a4.2 4.2 0 1 0 0 8.4 4.2 4.2 0 0 0 0-8.4z"></path></svg>
                    </li>
                  </ul>
                </td>
              </tr>
            </table>
          </td>
        </tr><!-- end: tr -->
@endsection