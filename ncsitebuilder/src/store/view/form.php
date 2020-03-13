<div class="wb-store-form-block"><div class="wb-store-form-buttons"><button type="button" class="wb-store-inquiry-btn btn btn-success"><?php echo $this->noPhp($this->__('Inquire')); ?></button></div><div id="wb_element_instance123" class="wb-store-form" style="display: none;"><form class="wb_form" method="post" enctype="multipart/form-data"><input type="hidden" name="wb_form_id" value="7309a84a"><textarea name="message" rows="3" cols="20" class="hpc" autocomplete="off"></textarea><table><tr><th>Name&nbsp;&nbsp;</th><td><input type="hidden" name="wb_input_0" value="Name"><input class="form-control form-field" type="text" value="" name="wb_input_0" required="required"></td></tr><tr><th>E-mail&nbsp;&nbsp;</th><td><input type="hidden" name="wb_input_1" value="E-mail"><input class="form-control form-field" type="text" value="" name="wb_input_1" required="required"></td></tr><tr><th>Address&nbsp;&nbsp;</th><td><input type="hidden" name="wb_input_2" value="Address"><input class="form-control form-field" type="text" value="" name="wb_input_2" required="required"></td></tr><tr class="area-row"><th>Comments&nbsp;&nbsp;</th><td><input type="hidden" name="wb_input_3" value="Comments"><textarea class="form-control form-field form-area-field" rows="3" cols="20" name="wb_input_3" required="required"></textarea></td></tr><tr class="form-footer"><td colspan="2"><button type="submit" class="btn btn-success">Enquire</button></td></tr></table><input type="hidden" name="object" value="<?php if (isset($formObject)) echo htmlspecialchars($formObject); ?>" /><?php if (isset($wbPopupMode) && $wbPopupMode): ?><input type="hidden" name="wb_popup_mode" value="1" /><?php endif; ?></form><script type="text/javascript">
			<?php $wb_form_id = popSessionOrGlobalVar("wb_form_id"); if ($wb_form_id == "7309a84a") { ?>
				<?php $wb_form_send_success = popSessionOrGlobalVar("wb_form_send_success"); ?>
				var formValues = <?php echo json_encode(popSessionOrGlobalVar("post")); ?>;
				var formErrors = <?php echo json_encode(popSessionOrGlobalVar("formErrors")); ?>;
				wb_form_validateForm("7309a84a", formValues, formErrors);
				<?php if (($wb_form_send_state = popSessionOrGlobalVar("wb_form_send_state"))) { ?>
					<?php if (($wb_form_popup_mode = popSessionOrGlobalVar("wb_form_popup_mode"))) { ?>
					if (window !== window.parent && window.parent.postMessage) {
						var data = {
							event: "wb_contact_form_sent",
							data: {
								state: "<?php echo str_replace('"', '\"', $wb_form_send_state); ?>",
								type: "<?php echo $wb_form_send_success ? "success" : "danger"; ?>"
							}
						};
						window.parent.postMessage(data, "<?php echo str_replace('"', '\"', popSessionOrGlobalVar("wb_target_origin")); ?>");
					}
					<?php } else { ?>
					wb_show_alert("<?php echo str_replace(array('"', "\n"), array('\"', "\\"), $wb_form_send_state); ?>", "<?php echo $wb_form_send_success ? "success" : "danger"; ?>");
					<?php } ?>
					<?php $wb_form_send_success = false; $wb_form_send_state = null; $wb_form_popup_mode = false; ?>
				<?php } ?>
			<?php } ?>
			</script></div></div>
