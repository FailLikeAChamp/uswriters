<?php 
    require_once('../app/start.php');

    use \UsWriters\Models\Letter;

    isAdminLoggedOut();

    $letter_id = filter_input(INPUT_GET, 'letter_id', FILTER_SANITIZE_NUMBER_INT);

    if ($letter_id == "") {
        $letters = Letter::find('all', array('conditions' => array('status = ?', 'submitted')));
        echo $twig->render("@admin/print.html.twig", array(
                                                        'flash' => $flash, 
                                                        'username' => $_SESSION['admin_username'],
                                                        'letters' => $letters));
        exit();
    }

    try {
        $letter = Letter::find($letter_id);
        $document = $letter->getPrintVersion();
        echo $twig->render("@admin/print-letter.html.twig", array('letter' => $letter)); 
    } catch (ActiveRecord\RecordNotFound $e) {
        $flash->error("The letter could not be found", "/uswriters/admin/print");
        exit();
    }  
?>

<!-- <!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>



  <div id="divToPrint" style="display:none;">
    <div style="width:200px;height:300px;background-color:teal;">


             
    </div>
  </div>
  <div>
    <input type="button" value="print" onclick="PrintDiv();" />
  </div>

   <script type="text/javascript">     
      // function PrintDiv() {    
      //    var divToPrint = document.getElementById('divToPrint');
      //   var popupWin = window.open('', '_blank', 'width=600,height=600');
      //   popupWin.document.open();
      //   popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
      //   popupWin.document.close();
      // }
   </script>
</body>
</html> -->






