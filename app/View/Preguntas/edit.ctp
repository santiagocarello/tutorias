<?php
$this->Html->css('pregunta', array('inline' => false));
$this->Html->script('autosize', array('inline' => false));
$this->Html->script('jquery.validate', array('inline' => false));
$this->Html->script('form-validate', array('inline' => false));
$this->Html->script('pregunta.form-app', array('inline' => false));
?>

<div class="row form-app">
  <div class="col-md-12 page-title">
    <h3>Editar pregunta</h3>
  </div>

  <?php
  echo $this->Form->create('Pregunta', array(
    'class' => 'form-horizontal form-validate',
    'data-pregunta' => $this->request->data['Pregunta']
  ));
  ?>

  <fieldset class="col-md-12">
    <div class="form-group">
      <label for="orden" class="control-label">Orden</label>
      <div class="control-input">
        <input
          name="data[Pregunta][orden]"
          id="orden"
          autocomplete="off"
          class="form-control"
          type="number"
          value="<?php echo h($this->request->data['Pregunta']['orden']); ?>"
          autofocus required
        ><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
      </div>
    </div>

    <div class="form-group">
      <label for="pregunta" class="control-label">Pregunta</label>
      <div class="control-input">
        <input
          name="data[Pregunta][pregunta]"
          id="pregunta"
          autocomplete="off"
          class="form-control"
          type="text"
          value="<?php echo h($this->request->data['Pregunta']['pregunta']); ?>"
          required
        ><span class="glyphicon form-control-feedback" aria-hidden="true"></span>
      </div>
    </div>

    <div class="form-group">
      <label for="ayuda" class="control-label">Ayuda</label>
      <div class="control-input">
        <textarea
          name="data[Pregunta][ayuda]"
          id="ayuda"
          autocomplete="off"
          class="form-control"
          rows="3"
        ><?php echo h($this->request->data['Pregunta']['ayuda']); ?></textarea>
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
      </div>
    </div>

    <div class="form-group">
      <label for="carrera" class="control-label">Visible en</label>
      <div class="control-input">
        <?php
        echo $this->Form->input('carrera_id', array(
          'id' => 'carrera',
          'label' => false,
          'class' => 'form-control'
        ));
        ?>
      </div>
    </div>

    <div class="form-group">
      <label for="tipo" class="control-label">Tipo</label>
      <div class="control-input">
        <?php
        echo $this->Form->input('tipo', array(
          'id' => 'tipo',
          'label' => false,
          'class' => 'form-control'
        ));
        ?>
      </div>
    </div>

    <div class="form-group div-opciones">
      <label class="control-label">Opciones</label>
      <div class="control-input">
        <div class="opciones">
          <?php foreach ($opciones as $key => $opcion) { ?>
            <div class="opcion">
              <input
                name="data[Pregunta][valores][<?php echo $key; ?>]"
                autocomplete="off"
                class="form-control"
                type="text"
                value="<?php echo h($opcion); ?>"
              ><a href="#" tabindex="-1" class="eliminar btn" title="Eliminar opción">&times;</a>
            </div>
          <?php } ?>
        </div>
        <a class="agregar-opcion" href="#">Agregar opción</a>
      </div>
    </div>

    <div class="btn-toolbar">
      <button class="btn btn-success" type="submit">Guardar</button>
      <?php
      echo $this->Html->link(
        'Cancelar',
        array('action' => 'index'),
        array('id' => 'btn-cancelar', 'class' => 'btn btn-default')
      );
      ?>
    </div>
  </fieldset>

  <?php echo $this->Form->end(); ?>
</div>
