<?php use DroplineMVC\Utils\Encode; ?>
<?php if ($data != null) : ?>
<div>
    <div class="card" style="margin-bottom: 30px">
        <div class="card-header">
            <h5>Activity Stats</h5>
        </div>
        <div class="card-body bg-light" style="padding-bottom: 0px">
<!--            <h5 class="card-title">Activity Stats</h5>-->
            <table class="table">
                <tbody>
                <tr>
                    <td>Total number of drops:</td>
                    <td><?php echo Encode::html($data['Drops_GetTotalNumOfDrops']); ?></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td>Total number of users:</td>
                    <td><?php echo Encode::html($data['Users_GetTotalNumOfUsers']); ?></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td>Drops posted per day (average):</td>
                    <td><?php echo Encode::html($data['Drops_GetAvgDropsPostedPerDay']); ?></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td>Last posted drop:</td>
                    <td><?php echo Encode::html($data['Drops_GetLatestDrop']['DropCreateDate']); ?></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td>Last posted drop user:</td>
                    <td><?php echo Encode::html($data['Drops_GetLatestDrop']['UserName']); ?></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td>Drop average length:</td>
                    <td><?php echo number_format(Encode::html($data['Drops_GetDropAvgLength']), 1) . '&nbsp;'; ?>characters</td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td>User with most drops:</td>
                    <td><?php echo Encode::html($data['User_GetUserWithMostNumOfDrops']['UserName']) . '&nbsp;(' . Encode::html($data['User_GetUserWithMostNumOfDrops']['UserNumberOfDrops']) . ')'; ?></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>