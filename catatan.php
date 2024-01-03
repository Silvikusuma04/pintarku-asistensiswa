<div class="card">
    <div class="card-header bg-primary text-white">
        AGENDA HARI INI
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="data-table" class="table table-bordered">
                <thead>
                    <th>Tanggal Pengumpulan</th>
                    <th>Waktu</th>
                    <th>Mata Pelajaran</th>
                    <th>Tugas</th>
                    <th>Catatan</th>
                </thead>
                <tbody>
                    <?php
                    $file = "file/" . $nim . "-" . $nama . ".txt";
                    $fh = fopen($file, "r");
                    while (!feof($fh)) {
                        $baris = fgets($fh);
                        if ($baris) {
                            $string_data = explode("|", $baris);
                    ?>
                            <tr>
                                <td><?php echo $string_data['0'] ?></td>
                                <td><?php echo $string_data['1'] ?></td>
                                <td><?php echo $string_data['2'] ?></td>
                                <td><?php echo $string_data['3'] ?></td>
                                <td>
                                    <?php echo $string_data['4'] ?>
                                    <input type="checkbox" class="reminder-checkbox" data-id="<?php echo $string_data['0'] ?>">
                                    <span class="reminder-icon" data-id="<?php echo $string_data['0'] ?>">🔔</span>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    fclose($fh);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Handle checkbox change
        $('.reminder-checkbox').change(function () {
            var dateId = $(this).data('id');
            var isChecked = $(this).prop('checked');

            // TODO: Send an AJAX request to your backend to update the reminder status
            // Example: $.post('update_reminder.php', { dateId: dateId, isChecked: isChecked });
        });

        // Handle bell icon click
        $('.reminder-icon').click(function () {
            var dateId = $(this).data('id');

            // TODO: Show a reminder/alert for the selected date
            alert('Reminder for ' + dateId);
        });
    });
</script>
