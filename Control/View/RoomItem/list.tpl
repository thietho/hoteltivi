<table class="table">
    <thead>
    <tr>
        <th>Room Number</th>
        <th>Room</th>
        <th>Area</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($roomItems as $key => $item){ ?>
    <tr>
        <td><?php echo $item['roomnumber']?></td>
        <td><?php echo $item['roomid_text']?></td>
        <td><?php echo $item['area_text']?></td>
        <td><button type="button" class="btn btn-success settingroom" index="<?php echo $key?>" roomitemid="<?php echo $item['id']?>" roomnumber="<?php echo $item['roomnumber']?>"><i class="fa fa-check"></i> Select</button></td>
    </tr>
    <?php } ?>
    </tbody>
</table>