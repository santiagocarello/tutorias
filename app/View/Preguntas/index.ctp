<?php
$this->Html->css('index', array('inline' => false));
$this->Html->css('pregunta/index', array('inline' => false));
$this->Html->css('lib/bootstrap-toggle.min', array('inline' => false));
$this->Html->script('lib/bootstrap-toggle.min', array('inline' => false));
$this->Html->script('pregunta/index', array('inline' => false));
?>

<div class="row">
  <div class="col-md-12 page-title">
    <h2>Preguntas</h2>
  </div>

  <div class="col-md-12 text-right">
    <?php
    echo $this->Html->link(
      'Agregar pregunta',
      array('action' => 'add'),
      array('class' => 'btn btn-add btn-default')
    );
    ?>
  </div>

  <div class="col-md-12">
    <table class="table">
      <thead>
        <tr>
          <th class="tx-orden"><?php echo $this->Paginator->sort('orden'); ?></th>
          <th><?php echo $this->Paginator->sort('pregunta'); ?></th>
          <th class="tx-tipo"><?php echo $this->Paginator->sort('tipo'); ?></th>
          <th><?php echo $this->Paginator->sort('valores'); ?></th>
          <th class="tx-visible"><?php echo $this->Paginator->sort('Carrera.descripcion', 'Visible en'); ?></th>
          <th class="tx-activo"><?php echo $this->Paginator->sort('activo', 'Activa'); ?></th>
          <th class="tx-actions"></th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($preguntas as $pregunta) { ?>
          <tr>
            <td class="tx-orden no-wrap"><?php echo h($pregunta['Pregunta']['orden']); ?></td>
            <td><?php echo h($pregunta['Pregunta']['pregunta']); ?></td>
            <td class="tx-tipo no-wrap"><?php echo h(Pregunta::tipos($pregunta['Pregunta']['tipo'])); ?></td>
            <td><?php echo h($pregunta['Pregunta']['valores']); ?></td>
            <td class="tx-visible no-wrap"><?php echo h($pregunta['Carrera']['descripcion']); ?></td>

            <td class="tx-activo no-wrap">
              <?php
              echo $this->Form->checkbox('activo', array(
                'data-id' => $pregunta['Pregunta']['id'],
                'data-toggle' => 'toggle',
                'data-size' => 'small',
                'checked' => $pregunta['Pregunta']['activo'],
                'class' => 'checkbox-toggle',
                'label' => false
              ));
              ?>
            </td>

            <td class="tx-actions">
              <?php
              echo $this->Html->link(
                'Editar',
                array('action' => 'edit', $pregunta['Pregunta']['id']),
                array('class' => 'btn btn-default btn-sm')
              );
              ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <p class="paginator">
      <?php
      echo $this->Paginator->counter(array(
        'format' => 'Mostrando {:current} de {:count} resultados'
      ));
      ?>
    </p>

    <div class="paging text-center">
      <?php
      if ($this->Paginator->hasPrev() || $this->Paginator->hasNext()) {
        echo $this->Paginator->prev('«', array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next('»', array(), null, array('class' => 'next disabled'));
      }
      ?>
    </div>
  </div>
</div>
