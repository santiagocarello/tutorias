
<?php $this->Html->script('encuesta', array('inline' => false)) ?>
<script>
<<<<<<< HEAD
    // wait for the DOM to be loaded
    $(document).ready(function() {
      //var form = null;
			var options = {
		        target:        '#output1',   // target element(s) to be updated with server response
		        //beforeSubmit:  function(arr, $form, options) {
            //  form = $form;
            //  return true;
            //},  // pre-submit callback
		        success:       showResponse  // post-submit callback

		        // other available options:
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
      if (responseText === "success") {
        $('input[name=respuesta]', $form).css({backgroundColor: "green"});
      }
	    // for normal html responses, the first argument to the success callback
	    // is the XMLHttpRequest object's responseText property

	    // if the ajaxForm method was passed an Options Object with the dataType
	    // property set to 'xml' then the first argument to the success callback
	    // is the XMLHttpRequest object's responseXML property

	    // if the ajaxForm method was passed an Options Object with the dataType
	    // property set to 'json' then the first argument to the success callback
	    // is the json data object returned by the server

/*	    alert('status: ' + statusText + '\n\nresponseText: \n' + responseText +
	        '\n\nThe output div should have already been updated with the responseText.');
*/	}

</script>
<?php if($authUser['role'] === 'admin'): ?>
    <div class="col-lg-12">
        <div class="text-right">
            <?php echo $this->Html->link(__('Regenerar encuesta'), array('action' => 'regenerate'), array('class' => 'btn btn-default')); ?>
        </div>
    </div>
<?php endif; ?>
=======
	// wait for the DOM to be loaded
	$(document).ready(function() {
	  //var form = null;
			var options = {
				target:        '#output1',   // target element(s) to be updated with server response
				//beforeSubmit:  function(arr, $form, options) {
			//  form = $form;
			//  return true;
			//},  // pre-submit callback
				success:       showResponse  // post-submit callback

				// other available options:
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
		}
	}

</script>


>>>>>>> a8a1353119121093a3f798564108edaa2ff75536
<div class="encuestas ">
	<h2>
		<?php echo __('Encuesta de '); ?>
			<a href="/tutorias/estudiantes/edit/<?php echo $encuestas[0]['Estudiante']['id']; ?>"><?php echo $encuestas[0]['Estudiante']['nombre']; ?></a>
	</h2>

	<div>
		<span id="output1"></span>

		<?php foreach ($encuestas as $encuesta): ?>
			<form
				id="form-<?php echo $encuesta['Pregunta']['id'] ?>"
				action="/tutorias/encuestas/save/<?php echo $encuestas[0]['Estudiante']['id']; ?>"
				method='post'
			>
				<fieldset>
					<legend>
						<?php echo h($encuesta['Pregunta']['pregunta']); ?>
					</legend>

					<input
						type='hidden'
						name='encuestaId'
						id='encuestaId'
						value='<?php echo h($encuesta['Encuesta']['id']); ?>'
					/>

					<div class="form-group">
						<?php
						$tipo = h($encuesta['Pregunta']['tipo']);
						if($tipo == 'select') {
							echo $this->Form->input('respuesta', array(
								'type'    => $tipo,
								'options' => explode(',', $encuesta['Pregunta']['valores']),
								'empty'   => false,
								'value'	  => $encuesta['Encuesta']['respuesta'],
								'class'   => 'form-control'
							));
						} else if($tipo == 'radio') {
							echo $this->Form->radio('respuesta', explode(',', $encuesta['Pregunta']['valores']), [
								'type'   => $tipo,
								'value'	 => $encuesta['Encuesta']['respuesta'],
								'legend' => false
							]);
						} else if($tipo == 'checkbox') {
							foreach (explode(',', $encuesta['Pregunta']['valores']) as $val):
								echo $this->Form->input('respuesta', array(
									'type'  => $tipo,
									'value'	=> $val,
									'label' => $val
								));
							endforeach;
						?>

						<button
							class="btn btn-default"
							type="submit"
						>Guardar</button>

						<?php
						} else {
						?>

						<!-- aca se muestra ayuda -->
						<I><?php echo h($encuesta['Pregunta']['ayuda']); ?></I>

						<div id="div-<?php echo $encuesta['Pregunta']['id'] ?>" class="form-group">
							<input
								id='respuesta-<?php echo $encuesta['Pregunta']['id'] ?>"'
								name='respuesta'
								type='<?php echo $tipo ?>'
								class="form-control"
								value='<?php echo h($encuesta['Encuesta']['respuesta']) ?>'
							/>

							<span
								id="span-<?php echo $encuesta['Pregunta']['id'] ?>"
								class="form-control-feedback"
							></span>
						</div>

						<span class="input-group-btn">
							<button
								id="button-<?php echo $encuesta['Pregunta']['id'] ?>"
								class="btn btn-default"
								type="submit"
								onclick="validar(this), <?php echo h($encuesta['Encuesta']['respuesta']) ?>"
							>Guardar</button>
						</span>

						<?php
						}
						?>
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
