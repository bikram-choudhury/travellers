
<html>

<style type="text/css" media="screen">

    /* Force Hotmail to display emails at full width */
    .ExternalClass {
      display: block !important;
      width: 100%;
    }

    /* Force Hotmail to display normal line spacing */
    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
      line-height: 100%;
    }

    body,
    p,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      margin: 0;
      padding: 0;
    }

    body,
    p,
    td {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 15px;
      color: #333333;
      line-height: 1.5em;
    }

    h1 {
      font-size: 24px;
      font-weight: normal;
      line-height: 24px;
    }

    body,
    p {
      margin-bottom: 0;
      -webkit-text-size-adjust: none;
      -ms-text-size-adjust: none;
    }

    img {
      line-height: 100%;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    a img {
      border: none;
    }

    .background {
      background-color: #333333;
    }

    table.background {
      margin: 0;
      padding: 0;
      width: 100% !important;
    }

    .block-img {
      display: block;
      line-height: 0;
    }

    a {
      color: white;
      text-decoration: none;
    }

    a,
    a:link {
      color: #2A5DB0;
      text-decoration: underline;
    }

    table td {
      border-collapse: collapse;
    }

    td {
      vertical-align: top;
      text-align: left;
      
    }

    .wrap {
      width: 800px;
    }

    .wrap-cell {
      padding-top: 30px;
      padding-bottom: 30px;
    }

    .header-cell,
    .body-cell,
    .footer-cell {
      padding-left: 20px;
      padding-right: 20px;
    }

    .header-cell {
      background-color: #daad0a;
      font-size: 24px;
      color: #ffffff;
    }

    .body-cell {
      background-color: #ffffff;
      padding-top: 70px;
      padding-bottom: 34px;
    }

    .footer-cell {
      background-color: #eeeeee;
      text-align: center;
      font-size: 13px;
      padding-top: 30px;
      padding-bottom: 30px;
    }

    .card {
      width: 600px;
      margin: 0 auto;
    }

    .data-heading {
      text-align: right;
      padding: 10px;
      background-color: #ffffff;
      font-weight: bold;
    }

    .data-value {
      text-align: left;
      padding: 10px;
      background-color: #ffffff;
    }

    .force-full-width {
      
    }

  </style>
  <style type="text/css" media="only screen and (max-width: 600px)">
    @media only screen and (max-width: 600px) {
      body[class*="background"],
      table[class*="background"],
      td[class*="background"] {
        background: #eeeeee !important;
      }

      table[class="card"] {
        width: auto !important;
      }

      td[class="data-heading"],
      td[class="data-value"] {
        display: block !important;
      }

      td[class="data-heading"] {
        text-align: left !important;
        padding: 10px 10px 0;
      }

      table[class="wrap"] {
        width: 100% !important;
      }

      td[class="wrap-cell"] {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
      }
    }
  </style>

<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="background-color: #fff;">
  <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="background-color: #fff;">
    <tr>
      <td align="center" valign="top" width="100%" class="" style="background-color: #fff;">
        <center>
          <table cellpadding="0" cellspacing="0" width="800px" class="" style="width: 800px;">
            <tr>
              <td valign="top" class="" style="padding-top:30px; padding-bottom:30px;">
                <table cellpadding="0" cellspacing="0" class="" style="width: 100% !important;border: 1px solid #daad0a;">
                  <tr>
                   <td height="60" valign="top" class="" style="padding-left: 20px; padding-right: 20px; background-color: #daad0a; font-size: 24px; color: #ffffff;">
                      <img width="196" height="60" src="http://52.76.112.38/travellers/assets/img/logo.png" alt="logo">
                      <!--https://www.filepicker.io/api/file/SU2YFOjPQzahL7orjBgl-->
                      <span style="float: right; color: #FFF;"><?php echo $booking_code; ?></span>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" class="" style="background-color: #ffffff; padding-top: 50px; padding-bottom: 34px; padding-left: 20px; padding-right: 20px;">
                      <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
                        <tr>
                          <td valign="top" style="padding-bottom:20px; background-color:#ffffff;">
                          Hi <?php echo $owner_name; ?>,<br><br>
                          We would like you to know that one of your Room has beed booked by a customer !
                          </td>
                        </tr>
                        <tr>
                        	<td><hr /><center><h1>Booking Id : <?php echo $booking_code; ?></h1></center><hr /></td>
                        </tr>
                        <tr>
                          <td>
                            <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                            <tr>
                              <td align="center" style="padding:20px 0;">
                                <center>
                                  <table cellspacing="0" cellpadding="0" class="" style="width: 600px; margin: 0 auto;">
                                    <tr>
                                      <td style="background-color:green; text-align:center; padding:10px; color:white; ">
                                        Customer Details
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="border:1px solid green;">
                                        <table cellspacing="0" cellpadding="20" width="100%">
                                          <tr>
                                            <td>
                                              <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
                                                <tr>
                                                  <td width="150" class="data-heading">Contact Number</td>
                                                  <td class="data-value"><?php echo $phone_no; ?></td>
                                                </tr>
                                                <tr>
                                                  <td width="150" class="data-heading">Contact Name</td>
                                                  <td class="data-value"><?php echo $person_name; ?></td>
                                                </tr>
                                                <tr>
                                                  <td width="150" class="data-heading">No. of Adults</td>
                                                  <td class="data-value"><?php echo $adult_options; ?></td>
                                                </tr>
                                                <tr>
                                                  <td width="150" class="data-heading">No. of Childs</td>
                                                  <td class="data-value"><?php echo $child_options; ?></td>
                                                </tr>
                                                <tr>
                                                  <td width="150" class="data-heading">Comment</td>
                                                  <td class="data-value"><?php echo $comment; ?></td>
                                                </tr>
                                              </table>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </center>
                              </td>
                            </tr>
                          </table>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff">
                            <tr>
                              <td align="center" style="padding:20px 0;">
                                <center>
                                  <table cellspacing="0" cellpadding="0" class="" style="width: 600px; margin: 0 auto;">
                                    <tr>
                                      <td style="background-color:#804d00; text-align:center; padding:10px; color:white; ">
                                        Room Details
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="border:1px solid #804d00;">
                                        <table cellspacing="0" cellpadding="20" width="100%">
                                          <tr>
                                            <td>
                                              <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
                                                <tr>
                                                  <td width="150" class="data-heading">Room Name</td>
                                                  <td class="data-value"><?php echo $room_name; ?></td>
                                                </tr>
                                                <tr>
                                                  <td width="150" class="data-heading">Room Address</td>
                                                  <td class="data-value"><?php echo $room_address; ?></td>
                                                </tr>
                                                <tr>
                                                  <td width="150" class="data-heading">Owner Contact No.</td>
                                                  <td class="data-value"><?php echo $owner_phone_no; ?></td>
                                                </tr>
                                              </table>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </center>
                              </td>
                            </tr>
                          </table>
                          </td>
                        </tr>
                        <tr>
                          <td style="padding-top:20px;background-color:#ffffff;">
                            Thank you!<br>
                            Your <?php echo $portal_name; ?> Team
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" class="footer-cell" style="padding-left: 20px; padding-right: 20px;">
                      
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </center>
      </td>
    </tr>
  </table>

</body>
</html>