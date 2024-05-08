<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_csv'])) {
	if (isset($_FILES['df']['name'])) {
		$df_name = explode(".", $_FILES['df']['name']);

		if ($df_name[1] == 'csv') {
			$handler = fopen($_FILES['df']['tmp_name'], "r");
			
			while ($df = fgetcsv($handler)) {	
				$specific_gravity		= isset( $df[0] ) ? $df[0] :"";
				$ph						= isset( $df[1] ) ? $df[1] :"";
				$osmolarity				= isset( $df[2] ) ? $df[2] :"";
				$conductivity			= isset( $df[3] ) ? $df[3] :"";
				$urea_concentration		= isset( $df[4] ) ? $df[4] :"";
				$calcium_concentration	= isset( $df[5] ) ? $df[5] :"";
				$target 				= isset( $df[6] ) ? $df[6] :"";

				$upload = new Upload();

				$result = $upload->save($specific_gravity, $ph, $osmolarity, $conductivity, $urea_concentration, $calcium_concentration, $target);
			}
		}
	}
}

?>

<div id="upload_csv_div" class="popup-form">
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
        <div class="form-header">
            <h2>Upload CSV file</h2>

            <div class="material-symbols-rounded btn-close" onclick="hideUploadCSV()">close</div>
        </div>

		<label class="btn btn-secondary" for="df">Choose a csv file</label>
		<input type="file" name="df" id="df" accept=".csv" hidden required>

        <input class="btn btn-secondary" type="submit" name="upload_csv" value="Create account">
    </form>
</div>