<%@ Page Language="VB" ContentType="text/html" ResponseEncoding="iso-8859-1" Debug="true" %>
<%@ Import Namespace="System.IO" %>
<script language="vb" runat="server">
  sub Page_Load(sender as Object, e as EventArgs)
    Dim FILENAME as String = Server.MapPath(Request.QueryString("abspath"))
    Dim objStreamReader as StreamReader
	Try
	    objStreamReader = File.OpenText(FILENAME)
    	Dim contents as String = objStreamReader.ReadToEnd()
    	txtAbs.Text = contents.Replace(vbCrLf, "<br>")
	Catch
		txtAbs.Text = "No abstract found!"
	Finally
	    Try
			objStreamReader.Close()
		Catch
		End Try
	End Try
  end sub
</script>
<!-- saved from url=(0014)about:internet -->
<!-- Provided by Dee Technologies (http://www.deetechnologies.com) -->
<html>
<head>
<title>View Abstract</title>
<meta http-equiv="content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="-1000">
<meta http-equiv="description" content="Areas of current interest include: Ecology of vegetation and ecosystems; soil ecology; stress ecology; conservation and restoration ecology; evolutionary ecology; ecology of global change and sustainable ecosystems; biological diversity and ecosystem function; Human ecology.">
<meta http-equiv="keywords" content="??Keywords??">
<META name="rating" content="general">
<meta http-equiv="pics-label" content='(pics-1.1 "http://www.icra.org/ratingsv02.html" l gen true for "http://www.tropecol.com" r ( nz 0 vz 0 lz 0 oz 0 ca 1))'>
<meta http-equiv="reply-to" content="webmaster@tropecol.com">
<meta name="identifier" content="http://www.tropecol.com/">
<meta http-equiv="company" content="International Society for Tropical Ecology">
<meta name="copyright" content="copyright 1960-2006 - International Society for Tropical Ecology">
<meta name="organization-Email" content="webmaster@tropecol.com">
<meta name="coverage" content="Worldwide">
<meta http-equiv="author" content="Diptiman Singh (diptiman@deetechnologies.com)">
<meta http-equiv="generator" content="Dee Editor from Dee Technologies">
<META name="language" content="English">
<META name="country" content="india">
<META name="robots" content="index">
<META name="robots" content="follow">
<META name="robots" content="index, follow">
<meta name="creation date" content="Jan2006">
<meta name="revisit_after"  content="30days">
<link rel="stylesheet" href="../../css/styles.css" type="text/css">
<script language="javascript1.2" src="../../js/page.js"></script>
</head>
<body background="../../images/ISTELogoback.gif" link="#747AC6" vlink="#B49BCD" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr>
    <td valign="baseline" height="84" background="../../images/header_fill.gif"><img name="sitename" src="../../images/sitename.gif" width="323" height="84" border="0"></td>
  </tr>
  <tr>
    <td valign="top" height="24" background="../../images/blue_fill.gif" align="right"><table width="220" border="0" cellspacing="0" cellpadding="0" height="22">
        <tr>
          <td width="37"><img name="blue_crn" src="../../images/blue_crn.gif" width="37" height="22" border="0"></td>
          <td background="../../images/lt_blue_fill.gif" class="date" width="200"><script language=JavaScript>
			<!--
			d = new Date();
			document.write(format_time(d));
			// -->
		</script>
          </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
        <tr>
          <td colspan="2" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="30" height="100%">
              <tr>
                <td height="370" valign="top" class="text"><div align="right"><strong><a href="javascript:history.back(1);">Back to previous page</a></strong></div>
                  <span class="title"><strong>Showing Abstract</strong></span>...<br>
                  <br><form runat="server">
                      <asp:Literal ID="txtAbs" runat="server" Text="No abstract!"></asp:Literal></form>
                      <br>
                      <br>
                      <strong><a href="javascript:history.back(1);">Back to previous page</a></strong></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="27" align="center" valign="middle" class="footer">&nbsp;</td>
          <td height="27" align="right" valign="baseline" class="footer"><img src="../../images/footer_right.gif" width="110" height="40"></td>
        </tr>
        <tr>
          <td width="140" background="../../images/footer_fill.gif" height="38">&nbsp;</td>
          <td align="right" height="38" background="../../images/footer_fill.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0" background="../../images/footer_fill.gif">
              <tr>
                <td valign="middle" align="center" class="footer">Copyright &copy;1960-2006 International Society for Tropical Ecology.</td>
                <td align="right" width="110"><img name="footer_right2" src="../../images/footer_right2.gif" width="110" height="38" border="0"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
