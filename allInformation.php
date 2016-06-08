// Display all information of the Database.
<div class="panel panel-default">
    <div class="panel-heading">All information</div>
    <div class="panel-body">
        <table style="width:100%">
            <tr>
                <td style="width:20%">Id</td>
                <td style="width:20%">Température</td>
                <td style="width:20%">Humidité</td>
                <td style="width:20%">Plante</td>
                <td style="width:20%">Date</td>
            </tr>
            <?php foreach($allInfo as $row): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["temp"]; ?> °C</td>
                    <td><?php echo $row["humidite"]; ?> %</td>
                    <td><?php echo $row["plante"]; ?></td>
                    <td><?php echo $row["date"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>