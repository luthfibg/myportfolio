<?php
header("Content-type: text/css; charset: UTF-8");

$hsid1;
$hsid2;
$hsid3;
$hsid4;
$hsid5;

$hslevel1;
$hslevel2;
$hslevel3;
$hslevel4;
$hslevel5;

$select_hs_content = $conn->prepare("SELECT * FROM `hardskills`");
$select_hs_content->execute();

if ($select_hs_content->rowCount() > 0) {
    while ($fetch_hs_contents = $select_hs_content->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="progress-x">
            <h3>
                <?= $fetch_hs_contents['hsname']; ?><span>
                    <?= $fetch_hs_contents['hslevel']; ?>%
                </span>
            </h3>
            <div class="bar"><span></span></div>
        </div>
        <?php
    }
} else {
    echo "<p class='mb-3'>Belum ada keterampilan ditambahkan</p>";
}
?>