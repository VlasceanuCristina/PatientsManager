
<span style=" font: italic bold 26px Georgia;">Denumire vaccin:</span>
				<select name="denumire_vaccin">
					
					<?php
					$db = mysqli_connect('localhost', 'root', '', 'patients_manager');
					$query= "SELECT * FROM vaccinuri";
					$results_sel_vaccin = mysqli_query($db, $query);
					while($row = mysqli_fetch_assoc($results_sel_vaccin)){?>
						<option value="<?php echo $row['denumire']; ?>" ><?php echo $row['denumire'];?></option>
						
					<?php
					}
					?>
				</select>