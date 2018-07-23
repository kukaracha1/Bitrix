<?

/* 	save points to the infoblock
	PROP['POINTS']['2122/-NEW']['COORD-X/Y']
	
	I SHOULD WRITE IT DIRECTLY TO THE $POST, 
		INSTEAD OF $POST['PROP'] (WILL BE CHANGED)
*/

if (isset($PROP['POINTS'])) {
	
	$el = new CIBlockElement;

	// we have new or changed points
	foreach($PROP['POINTS'] as $key => $point) {
		if (isset($point['IS_NEW']) && $point['IS_NEW']) {
			
			// ADD NEW RECORD TO IB
			$arFields = array(
				'COORD_X' => $point['COORD-X'],
				'COORD_Y' => $point['COORD-Y'],
				'SET_ID' => $ID,
				'PROPERTY_ID' => $key,
			);	

			$arLoadProductArray = Array(
					"MODIFIED_BY" => $USER->GetID(), 
					"IBLOCK_ID"      => 6,  
					"PROPERTY_VALUES"=> $arFields,  
					"NAME"           => $ID,  // don't add without name & text :(
					"PREVIEW_TEXT"   => "1",  
					"DETAIL_TEXT"    => "1",  
				  );

				 if(!($PRODUCT_ID = $el->Add($arLoadProductArray)))
				 {
					 // SOMETHING WENT WRONG
				 }
			}
			elseif (isset($point['DEL']) && $point['DEL']) {
				
				// DELETE RECORD
				if(!$el->Delete($point['ID']))	
				{		
					// SOMETHING WENT WRONG							
				}
			}
			else {
				
				// UPDATE EXISTING RECORD

				$point_id = $point['ID']; // ID of SET_GOOD relation's record in the IB

				$res = $el->SetPropertyValuesEx($point_id, 6, array(
					'COORD_X' => $point['COORD-X'],
					'COORD_Y' => $point['COORD-Y'],
				));

				if (!$res) {
					// SOMETHING WENT WRONG

				}
			}
		}
	}