<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col">++</th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
</table>
@foreach ($data as $item)
    {{$item['timings']['Fajr']}}
@endforeach


</body>
</html>
