<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$arJsConfig = array( 
    'custom_main' => array( 
        'js' => $templateFolder.'/script.js', 
        'rel' => array(
			"ajax",
		), 
    ) 
); 

CUtil::InitJSCore(array('custom_main','jquery'));


foreach ($arJsConfig as $ext => $arExt) { 
    \CJSCore::RegisterExt($ext, $arExt); 
}

$showPartners = isset($arParams['PARTNERS']);

?>

<?if ($arResult["SECTION"]["PATH"]["0"]["PICTURE"]["SRC"]):?>
<img src="<?=$arResult["SECTION"]["PATH"]["0"]["PICTURE"]["SRC"]?>">
<?endif?>

<!-- ---------------------START SHOW PARTNERS INFO -->
<?if($showPartners):?>
	<?
		// get the current partner
		$partnerID = $arParams['PARTNER_ID'];
	?>
	<form class="partners-list">
		<select class="partners-list__select" name="partner">
			<?for($i = 0 ; $i < count($arParams['PARTNERS']) ; $i++):?>
				<?	
					// show menu with partner's names
					$partner = $arParams['PARTNERS'][$i];
					if ($i == $partnerID - 1)
						$partnerName = $partner['NAME'].' (Текущий)';
					else
						$partnerName = $partner['NAME'];
				?>
				<option value=<?=($i+1)?> class="<?=($i == $partnerID - 1)? 'selected':''?>"> <?=$partnerName?> </option>
			<?endfor;?>
			<option value=0 class="<?=($partnerID == 0)? 'selected':''?>">Показать всё</option>		
		</select>
		<button type="submit" class="partners-list__submit btn btn-primary">Выбрать</button>
	</form>
	<!-- show the partners info -->
	<?if($partnerID != 0):?>
		<div>
			<?foreach($arParams['PARTNERS'][$partnerID-1]['INFO'] as $partnerINFO):?>
				<p><?='<h4>'.$partnerINFO['NAME'] . ':</h4> ' . $partnerINFO['VALUE']?></p>
			<?endforeach;?>
		</div>
		<hr>
	<?endif;?>
<?endif;?>

<!-- ---------------------END SHOW PARTNERS INFO -->


<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
		
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
	//var_dump($arItem['DISPLAY_PROPERTIES']);
	
	?>
	<div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<input type="button" class="activation btn <?=(($arItem["ACTIVE"] == "N")? "btn-success" : "btn-danger")?>" data-id=<?=$arItem["ID"]?> value=<?=(($arItem["ACTIVE"] == "N")? "Activate" : "Deactivate")?> >

		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
						class="preview_picture"
						border="0"
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
						/></a>
			<?else:?>
				<img
					class="preview_picture"
					border="0"
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					/>
			<?endif;?>
		<?endif?>
		<div class="news-item__desc">
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		
		
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<small>
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
					</small><br />
			

		<?endforeach;?>
				</div>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
	</div>
	<hr>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
