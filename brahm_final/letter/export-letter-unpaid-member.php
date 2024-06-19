<?php
$base_url = "http://" . $_SERVER['SERVER_NAME'] . '/brahm_final/';
include('../common/common.php');
if (isset($_POST['doc_generate'])) {
    $doc = new clsMsDocGenerator($_POST['pageOrientation'], $_POST['pageType'], '', $_POST['top'], $_POST['right'], $_POST['bottom'], $_POST['left']);

    $currentYear = date('Y');
    $list = $reportModel->AllHeadMembersUnPaidNotDeleted($currentYear);
    if ($list['status'] == 'success') {
        $data = $list['data'];
        if (count($data) > 0) {
            foreach ($data as $list) {
                $doc->addParagraph($_POST['date'], array('text-align' => "right", 'font-size' => '12pt', 'font-weight' => 'normal'));
                $doc->addParagraph('To,', array('text-align' => "left", 'font-size' => '12pt', 'font-weight' => 'normal'));
                $doc->addParagraph("<b>" . $list['preFix'] . " " . $list['SurName'] . " " . $list['FirstName'] . " " . $list['MiddleName'] . "</b><br>" . $list['add1'] . " " . $list['add2'] . "<br>" . $list['add3'] . " " . $list['add4'] . "<br>" . $list['city'] . " " . $list['county'] . "<br>" . $list['zipcode'], array('text-align' => 'left', 'font-size' => '12pt', 'font-weight' => 'normal'));
                $doc->addParagraph($_POST['subject'], array('text-align' => "center", 'font-size' => '14pt', 'font-weight' => 'bold'));
                $doc->addParagraph(nl2br($_POST['lettertext']), array('text-align' => "left", 'font-size' => '12pt', 'font-weight' => 'normal'));
                $doc->addParagraph(nl2br($_POST['closetext']), array('text-align' => "left", 'font-size' => '12pt', 'font-weight' => 'normal'));
                $doc->addParagraph($_POST['pstext'], array('text-align' => "left", 'font-size' => '12pt', 'font-weight' => 'normal'));
                $doc->newpage();
            }
            $doc->output("letters-unpaid-members" . date("Ymd") . ".doc");
        } else { ?>
            <script>
                window.location.href = "<?php echo $base_url; ?>" + "letter/letter-unpaid-member.php";
            </script>
        <?php }
    } else { ?>
        <script>
            window.location.href = "<?php echo $base_url; ?>" + "letter/letter-unpaid-member.php";
        </script>
<?php }
}
?>