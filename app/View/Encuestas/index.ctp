
<?php $this->Html->script('encuesta', array('inline' => false)) ?>

<script>
	// wait for the DOM to be loaded
	$(document).ready(function() {
		var options = {
			success:       showResponse  // post-submit callback

			// other available options:
			//beforeSubmit:          // pre-submit callback
			//url:       url         // override for form's 'action' attribute
			//type:      type        // 'get' or 'post', override for form's 'method' attribute
			//dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
			//clearForm: true        // clear all form fields after successful submit
			//resetForm: true        // reset the form after successful submit

			// $.ajax options can be used here too, for example:
			//timeout:   3000
		};
		$('form').ajaxForm(options);
	});

	function showResponse(responseText, statusText, xhr, $form)  {
		id = $form.attr("id").slice(5);

		if (responseText === "success") {
			$form.attr({
				class: "form-group has-success has-feedback"
			});

			$("#span-".concat(id)).attr({
				class: "glyphicon glyphicon-ok form-control-feedback"
			});
		} else {
			$form.attr({
				class: "form-group has-error has-feedback"
			});

			$("#span-".concat(id)).attr({
				class: "glyphicon glyphicon-remove form-control-feedback"
			});
		}
	}
</script>

<?php if($authUser['role'] === 'admin'): ?>
	<div class="col-lg-12">
		<div class="text-right">
			<?php
			echo $this->Form->postLink(__('Regenerar encuesta'), array('action' => 'regenerate', $estudiante['id']), array('class' => 'btn btn-default'));
			?>
		</div>
	</div>
<?php endif; ?>

<div class="encuestas">
	<h2>
		<?php echo __('Encuesta de '); ?>
			<a href="/tutorias/estudiantes/edit/<?php echo $estudiante['id']; ?>">
				<?php echo ($estudiante['nombre']); ?>
			</a>
	</h2>

	<div>
		<?php foreach ($encuestas as $encuesta): ?>
			<form
				id="form-<?php echo $encuesta['Pregunta']['id'] ?>"
				action="/tutorias/encuestas/save/"
				method='post'
			>
				<fieldset>
					<div class="form-group">
						<legend>
							<?php echo h($encuesta['Pregunta']['pregunta']); ?>
						</legend>

						<input
							type='hidden'
							name='encuestaId'
							id='encuestaId'
							value='<?php echo h($encuesta['Encuesta']['id']); ?>'
						/>

						<?php if($encuesta['Pregunta']['ayuda']) { ?>
							<div class="alert alert-warning" role="alert">
								<?php echo h($encuesta['Pregunta']['ayuda']); ?>
							</div>

						<?php
						}
						
						$tipo = h($encuesta['Pregunta']['tipo']);
						$valores = explode(',', h($encuesta['Pregunta']['valores']));

						switch ($tipo) {
							case 'select':
								echo $this->Form->select('respuesta', $valores, array(
									'class'   => 'form-control',
									'label'   => false,
									'legend'  => false,
									'empty'   => false,
									'value'   => h($encuesta['Encuesta']['respuesta'])
								));
								break;
							case 'radio':
								echo $this->Form->input('respuesta', array(
									'type'      => $tipo,
									'label'     => false,
									'legend'    => false,
									'before'    => '<label>',
									'after'     => '</label>',
									'separator' => '</label></div><div class="radio"><label>',
									'value'     => h($encuesta['Encuesta']['respuesta']),
									'options'   => $valores
								));
								break;
							case 'checkbox':
								/*
								echo $this->Form->select('done', $valores, array(
									'multiple' => 'checkbox'
								));
								*/
								break;
							default:
								?>
								<div id="div-<?php echo $encuesta['Pregunta']['id'] ?>" class="input-group">
									<input
										id='respuesta-<?php echo $encuesta['Pregunta']['id'] ?>'
										name='respuesta'
										type='<?php echo $tipo ?>'
										class="form-control"
										value='<?php echo h($encuesta['Encuesta']['respuesta']) ?>'
									/>
									<span class="input-group-btn">
										<button
											id="button-<?php echo $encuesta['Pregunta']['id'] ?>"
											class="btn btn-default"
											type="submit"
										>Guardar</button>
									</span>
								</div>
						<?php } ?>

						<span
							id="span-<?php echo $encuesta['Pregunta']['id'] ?>"
							class="form-control-feedback"
						></span>
					</div>
				</fieldset>
			</form>
		<?php endforeach; ?>
	</div>
</div>

<script>
	$(document).ready(function(){
		$("input:radio, select").change(function(){
			$(this).parents('form:first').submit();
		});
	});
</script>
